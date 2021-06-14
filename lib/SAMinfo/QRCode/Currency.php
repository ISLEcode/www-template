<?php
namespace SAMinfo\QRCode;

class Currency {

    private $db;
    private $verb;

    public function __construct ($db, $verb) {
        $this->db   = $db;
        $this->verb = $verb; // Request method
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

        $run = $this ->db ->stmt_init ();
        $sql = "SELECT NoMonnaie as id, MON_LibelleCourt as alpha3, MON_LibelleLong as label FROM monnaie
                WHERE MON_LibelleCourt = 'CHF' OR MON_LibelleCourt = 'EUR';";

        if (!$run ->prepare ($sql)) $this ->reply_badinput ();
        $run -> execute ();
        $set = $run ->get_result ();
        $run ->free_result ();
        $out = $set ->fetch_all (MYSQLI_ASSOC);

        $this ->db ->close();

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
