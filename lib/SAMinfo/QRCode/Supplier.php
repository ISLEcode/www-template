<?php
namespace SAMinfo\QRCode;

class Supplier {

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

        $out = [];
        $run = $this ->db ->stmt_init ();

        $sql = "SELECT NoEntreprise AS id, TYPE AS type, ENT_RaisonSociale AS name, ENT_Adresse AS street,
                ENT_NoImmeuble AS building, ENT_Npa AS zipcode, ENT_Localite AS location, ENT_NoCanton as region_id,
                ENT_NoPays as country_id, ENT_NoTel AS phone, ENT_NoFax AS fax, ENT_Email AS email, ENT_Site as website
                FROM entreprise
                WHERE ENT_RaisonSociale <> '' AND ENT_Deleted = 0;";

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
