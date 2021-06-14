<?php
namespace SAMinfo\QRCode;

class Location {

    private $db;
    private $verb;

    public function __construct ($db, $verb) {

        $this->db   = $db;
        $this->verb = $verb; // Request method


        /*
        $thid ->db ->query ('CREATE TABLE IF NOT EXISTS language (
            Code text NOT NULL,
            Speakers int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');
        */


    }

    public function enact () {
        switch ($this->verb) {
            case 'GET':    $response = $this->enact_getall ();   break;
            default:       $response = $this->reply_notfound (); break;
        }

        header($response['httpd-status']);
        header('Content-Type: application/json');
        if ($response['body']) echo $response['body'];
        die ();
    }

    private function enact_getall () {

        $dbhost = getenv ('DB_HOST');
        $dbport = getenv ('DB_PORT');
        $userid = getenv ('DB_USERNAME');
        $userpw = getenv ('DB_PASSWORD');

        $db = new \mysqli ($dbhost, $userid, $userpw, 'gp_config');

        if ($db ->connect_errno) {
            printf ('Connect failed: %s<br />', $db ->connect_error);
            exit ();
        }

        $run = $db ->stmt_init ();
        $sql = 'SELECT swiss_municipality_id AS id, zip_code AS zipcode, municipality AS location, canton AS region
                FROM _swissmunicipality;';


        if (!$run ->prepare ($sql)) $this ->reply_badinput ();
        $run -> execute ();
        $set = $run ->get_result ();
        $run ->free_result ();
        $out = $set ->fetch_all (MYSQLI_ASSOC);

        $db ->close ();

        $response['httpd-status'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode ($out);

        return $response;
    }

    private function reply_ok ($msg) {
        $response['httpd-status'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode ([ 'status' => 'ok', 'message' => $msg ]);
        return $response;
    }

    private function reply_badinput () {
        $response['httpd-status'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode ([ 'status' => 'error', 'message' => 'Invalid input' ]);
        return $response;
    }

    private function reply_notfound () {
        $response['httpd-status'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = json_encode ([ 'status' => 'error', 'message' => 'Invalid request' ]);
        return $response;
    }
}
