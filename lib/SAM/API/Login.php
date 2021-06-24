<?php namespace SAM\API;

use \SAM\Database\MySQL;
use \SAM\API\Login\JWT;
use \SAM\Protocol\HTTP;
use \SAM\Protocol\HTTPStatusCode;

class Login {

    private $db;
    private $verb;
    protected $map;

    public function __construct ($verb = null) {

        $this->db   = (new MySQL (true)) ->connect ();

        if (empty ($verb)) $verb = $_SERVER['REQUEST_METHOD'];
        $this->verb = $verb;

    }

    // $sql = post_prepare ($template, $input)
    // $out = post_respond ($result)

    //! @brief CORS-compliance method.
    //! @note  It currently allows any GET, POST, or OPTIONS requests from any origin. This should be tuned in production.
    //! @see   https://developer.mozilla.org/en/HTTP_access_control
    //! @see   https://fetch.spec.whatwg.org/#http-cors-protocol

    public function cors () {

        // TODO Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one you want to allow, and if so:
        $origin = isset ($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : $_SERVER['HTTP_REFERER'];

        if (isset ($origin)) {
            header ("Access-Control-Allow-Origin: {$origin}");
            header ('Access-Control-Allow-Credentials: true');
            header ('Access-Control-Max-Age: 86400'); // 1 day
        }
        else header ('Access-Control-Allow-Origin: *');

    }

    public function enact () {

        switch ($this->verb) {
            case 'GET'     : $this ->on_post ();
            case 'OPTIONS' : $this ->preflight ();
            case 'POST'    : $this ->on_post ();
            default        : $this ->respond (405, "Invalid request ({$this->verb})", null, $this->verb);
        }
    }

    private function preflight () {
        $this ->cors ();
        // Access-Control headers are received during OPTIONS requests
        // may also be using PUT, PATCH, HEAD etc
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        header('Content-Length: 0');
        header('Content-Type: text/plain');
        exit(0);

    }

    private function on_post () {

        // Collect the JSON-encoded GET/POST data
        // $input = isset ($_REQUEST) ? $_REQUEST : (array) json_decode (file_get_contents ('php://input'), TRUE);
        $input = $this ->verb == 'GET' ? $_REQUEST : (array) json_decode (file_get_contents ('php://input'), TRUE);

        if (sizeof ($input) == 0) $this ->respond (406, 'No input', null, $input);
        $uid = $input['uid']; if (strlen ($uid) == 0) $this ->respond (407);
        $upw = $input['upw']; if (strlen ($upw) == 0) $this ->respond (408);
        $md5 = md5 ($upw);

        $sql = "SELECT
            user_id         AS id,
            role_id         AS role,
            bdebugapp       AS debug,
            database_name   AS account,
            complete_name   AS label,
            bExpertModeApp  AS superuser
        FROM _user
        WHERE username = '$uid' AND password = '$md5';";

        // Enact the query and collect its response
        $set = $this ->db ->query ($sql);
        $out = $set ->fetch_row();

        if (!is_countable ($out) || sizeof ($out) == 0) $this ->respond (401, null, null, $out);

        \SAM\API\Login\JWT::$leeway = 120; // 2mn

        $secret = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
        $issued = new \DateTimeImmutable("now", new \DateTimeZone('Europe/Zurich'));
        $token  = array(
            'iss'           => 'ISLE Suisse SA',
            'aud'           => 'https://dupaasp1.isle.plus/qrcode',
            'iat'           => $issued ->getTimestamp(), // Issued at claim
            'nbf'           => $issued ->getTimestamp(), // Not before claim
            'exp'           => $issued ->modify('+7 days') ->getTimestamp (),
            'data'          => array(
                'id'        => $out[0],
                'role'      => $out[1],
                'debug'     => $out[2],
                'dbname'    => $out[3],
                'username'  => $uid,
                'fullname'  => $out[4],
                'superuser' => $out[5] && $out[5] == 1 ? 1 : 0,
                'ipaddress' => $_SERVER['REMOTE_ADDR']));

        $jwt = JWT::encode ($token, 'sam-jwt');
        $this ->respond (200, 'Successful login', null, array('token' => $jwt, 'data' => $token['data']));

        // We're done... respond to caller
        $this ->db ->close();
        $this ->respond (200, 'Login', null, $input);

    }

    private function getall () {

        if (!array_key_exists ('getall', $this->map))  $this ->respond (405);
        if (strlen (trim ($this->map['getall'])) == 0) $this ->respond (405);
        $sql = $this ->map['getall'];

        // Make sure we can prepare an SQL statement for execution
        $run = $this ->db ->stmt_init ();
        if (!$run ->prepare ($sql)) $this ->respond (550);

        $run -> execute ();
        $set = $run ->get_result ();
        $run ->free_result ();
        $out = $set ->fetch_all (MYSQLI_ASSOC);

        $this ->db ->close();
        $this ->respond (200, null, null, $out);

    }

    public function respond ($code, $message = '', $headers = [], $body = []) {

        // Output the mandatory HTTP status header
        $prefix = \SAM\Protocol\HTTP::getprefix ();
        header ("$prefix 200 OK");
        $this ->cors();

        // TODO This should not be hardcoded
        // header ('Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE');
        // header ('Access-Control-Max-Age: 3600');
        // header ('Access-Control-Allow-Headers: *');
        // header('Access-Control-Allow-Origin: *');

        // Output all provided headers
        if (!empty ($headers)) foreach ($headers as $header) header ($header);

        // All our responses return some JSON-encoded data
        header ('Content-Type: application/json; charset=UTF-8');

        // Prepend result set with the standardised status and informational fields
        if (strlen (trim ($message)) == 0) $message = \SAM\Protocol\HTTP::getlabel ($code);
        $data = [ 'code' => $code, 'message' => $message, 'status' => $code > 199 && $code < 300 ? 'ok' : 'error' ];
        if (!empty ($body)) $data['body'] = $body;

        // We're done dump the JSON data and exit
        echo json_encode ($data); exit ();

    }

}

// __END__
