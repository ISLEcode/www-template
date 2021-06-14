<?php
namespace SAMinfo\QRCode;

class CLists {

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

        $out = [];
        $run = $this ->db ->stmt_init ();

        $sql = "SELECT NoProjet          AS id,
                 PRO_LibelleCourt        AS label,
                 PRO_DateDebut           AS start_date,
                 PRO_DateFin             AS end_date,
                 PRO_BForfait            AS fixed_price,
                 PRO_BTVAIncluse         AS vat_included,
                 PRO_BDecompteCalendrier AS countdown,
                 PRO_NoDelaiLivraison    AS schedule,
                 PRO_NoConditionPaiement AS payment,
                 PRO_GestionComptable    AS accounting,
                 PRO_Compte              AS account,
                 PRO_Commentaire         AS comment
                FROM projet
                WHERE PRO_Deleted = 1 AND PRO_LibelleCourt <> '' AND PRO_NonFacturable = 0
                AND CURDATE() BETWEEN PRO_DateDebut AND CASE WHEN IFNULL(PRO_DateFin,0) = 0 THEN 99991231 ELSE PRO_DateDebut END";

        if (!$run ->prepare ($sql)) $this ->reply_badinput ();
        $run -> execute ();
        $set = $run ->get_result ();
        $run ->free_result ();
        $out['orders'] = $set ->fetch_all (MYSQLI_ASSOC);

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
