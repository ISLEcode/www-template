<?php namespace SAM\API;

use \SAM\Database\MySQL;
use \SAM\Protocol\HTTP;
use \SAM\Protocol\HTTPStatusCode;

abstract class Entity {

    private $db;
    private $verb;
    protected $map;
    protected $token;       // The JWT token as-is
    protected $session;     // The decoded JWT token

    public function __construct ($db, $verb = null) {

        if (isset ($db)) $this->db = $db; else foreach (getallheaders() as $key => $value) {

            if ($key <> 'Authorization') continue;

            $this ->token   = substr ($value, 7);
            $this ->session = JWT::decode ($this ->token, 'sam-jwt', array('HS256'));

            setenv ('DB_DATABASE', $this ->session ->data ->dbname);
            $this->db   = (new MySQL (true)) ->connect ();

        }

        // TODO assert that we have a DB connection

        if (empty ($verb)) $verb = $_SERVER['REQUEST_METHOD'];
        $this->verb = $verb;

    }

    // $sql = post_prepare ($template, $input)
    // $out = post_respond ($result)

    public function enact () {
        switch ($this->verb) {
            case 'GET':  $this ->getall ();
            case 'POST': $this ->on_post ();
            default:     $this ->respond (405, 'Invalid request');
        }
    }

    private function on_post () {

        // Make sure we have declared our two custom POST handling methods
        if (!method_exists ($this, 'post_prepare')) $this ->respond (501, 'post_prepare not found!');
        if (!method_exists ($this, 'post_respond')) $this ->respond (501, 'post_respond not found!');

        // Collect the JSON-encoded POST data
        $input = (array) json_decode (file_get_contents ('php://input'), TRUE);

        // Make sure we have an SQL statement associated to this `create` request
        // if (!array_key_exists ('create', $this ->map))  $this ->respond (405);
        // if (strlen (trim ($this ->map['create'])) == 0) $this ->respond (405);

        // Construct the actual SQL statement that we will be submitting
        $sql = $this -> post_prepare ($this ->map['create'], $input);

        // Enact the query and collect its response
        $set = $this ->db ->query ($sql);
        $out = $set ->fetch_row();

error_log (json_encode(['app' => 'SAMmobile', 'api' => 'QRBill.POST', 'sql' => $sql, 'set' => $set, 'output' => $out ], true));

        // We're done... respond to caller
        $this ->db ->close();
        $this ->respond (200, 'QRBill created successfully', null, $out);

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
        $label  = \SAM\Protocol\HTTP::getlabel ($code);
        header ("$prefix $code $label");

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
            header('Access-Control-Allow-Headers: token, Content-Type');
            header('Access-Control-Max-Age: 1728000');
            header('Content-Length: 0');
            header('Content-Type: text/plain');
            die();
        }

        // TODO This should not be hardcoded
        // header ('Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE');
        // header ('Access-Control-Max-Age: 3600');
        // header ('Access-Control-Allow-Headers: *');

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');


        // Output all provided headers
        if (!empty ($headers)) foreach ($headers as $header) header ($header);

        // All our responses return some JSON-encoded data
        header ('Content-Type: application/json; charset=UTF-8');

        // Prepend result set with the standardised status and informational fields
        if (strlen (trim ($message)) == 0) $message = $label;
        $data = [ 'code' => $code, 'message' => $message, 'status' => $code > 199 && $code < 300 ? 'ok' : 'error' ];
        if (!empty ($body)) $data['body'] = $body;

        // We're done dump the JSON data and exit
        echo json_encode ($data); exit ();

    }

}

// __END__
