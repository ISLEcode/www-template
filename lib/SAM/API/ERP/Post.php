<?php
namespace SAMinfo\QRCode;

class Post {

    private $db;
    private $verb;
    private $id;

    public function __construct ($db, $verb, $id) {

        $this->db   = $db;
        $this->verb = $verb; // Request method
        $this->id   = $id;


        /*
        $thid ->db ->query ('CREATE TABLE IF NOT EXISTS language (
            Code text NOT NULL,
            Speakers int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');
        */


    }

    public function enact () {
        switch ($this->verb) {
            case 'GET':    $response = ($this->id)
                                     ? $this->enact_select ($this->id)
                                     : $this->enact_getall ();          break;
            case 'POST':   $response = $this->enact_create ();          break;
            case 'PUT':    $response = $this->enact_update ($this->id); break;
            case 'DELETE': $response = $this->enact_delete ($this->id); break;
            default:       $response = $this->reply_notfound ();        break;
        }

        header($response['status_code_header']);
        if ($response['body']) echo $response['body'];
    }

    private function enact_create () {

        $new = (array) json_decode (file_get_contents ('php://input'), TRUE);
        if (! $this->validate ($new)) return $this->reply_badinput ();

        /*
        $run = $this ->db ->stmt_init ();
        $sql = 'INSERT INTO post (title, body, author, author_picture) VALUES (?, ?, ?, ?);';

        if (!$run ->prepare ($sql)) $this ->reply_badinput ();

        $run ->bind_param ("ssss", $new['title'], $new['body'], $new['author'], $new['avatar-id']);
        $run ->execute();
        $rows = $run->affected_rows;
        $run ->close();
         */

        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        // $response['body'] = json_encode (array ('status' => 'ok', 'message' => 'Post Created'));
        $response['body'] = json_encode (array ('status' => 'ok', 'message' => $new));
        return $response;
    }

    private function enact_getall () {

        $run = $this ->db ->stmt_init ();
        $sql = 'SELECT * FROM post;';

        if (!$run ->prepare ($sql)) $this ->reply_badinput ();

        $run -> execute ();
        $set = $run ->get_result ();
        $run ->free_result ();

        $this ->db ->close();

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode ($set ->fetch_all (MYSQLI_ASSOC));

        return $response;
    }

    private function enact_select ($id) {
        return $this ->find_byid ($id, true);
    }

    private function enact_update ($id) {

        $new = (array) json_decode (file_get_contents ('php://input'), TRUE);
        if (! $this->validate ($new)) return $this->reply_badinput ();

        $run = $this ->db ->stmt_init ();
        $sql = 'UPDATE post SET title = ?, body = ?, author = ?, author_picture = ? WHERE id = ? ';

        if (!$run ->prepare ($sql)) $this ->reply_badinput ();

        $run ->bind_param ('ssssi', $new['title'], $new['body'], $new['author'], $new['avatar-id'], $id);
        $run ->execute();
        $rows = $run->affected_rows;
        $run ->close();

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode(array('message' => 'Post Updated!'));
        return $response;
    }

    private function cud ($run, $out = []) {
        $this ->db ->begin_transation ();

        try {

            $run ->execute();

            $out['rows'] = $run->affected_rows;

            $run ->close();

        }

        catch (mysqli_sql_exception $exception) {
            $mysqli->rollback();
            throw $exception;
        }

    }

    private function enact_delete ($id) {

        $run = $this ->db ->stmt_init ();
        $sql = 'DELETE FROM post WHERE id = ?;';

        $run ->bind_param ('i', $id);

        $run ->execute();
        $rows = $run->affected_rows;
        $run ->close();

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode(array('message' => 'Post Updated!'));
        return $response;
    }

    public function find_byid ($id, $respond = false) {

        $run = $this ->db ->stmt_init ();
        $sql  = 'SELECT * FROM post WHERE id = ?;';

        if (!$run ->prepare ($sql)) $this ->reply_badinput ();

        $run  ->bind_param ('i', $id);
        $run  ->execute();

        if (!$respond) {
            $rows = $run->affected_rows;
            $run  ->free_result ();
            $run  ->close();
            return $rows;
        }

        $set = $run ->get_result ();
        $run ->free_result ();
        $this ->db ->close();

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode ($set ->fetch_all (MYSQLI_ASSOC));

        return $response;
    }

    private function validate ($input) {
        if (!isset ($input['title'])) return false;
        if (!isset ($input['body' ])) return false;
        return true;
    }

    private function reply_ok ($msg) {
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode ([ 'status' => 'ok', 'message' => $msg ]);
        return $response;
    }

    private function reply_badinput () {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode ([ 'status' => 'error', 'message' => 'Invalid input' ]);
        return $response;
    }

    private function reply_notfound () {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = json_encode ([ 'status' => 'error', 'message' => 'Invalid request' ]);
        return $response;
    }
}

// __END__
