<?php namespace SAM\Database;

class MySQL {

    private $handle = null;

    public function __construct ($config = false) {

        $dbhost = getenv ('DB_HOST');
        $dbname = $config ? 'gp_config' : getenv ('DB_DATABASE');
        $dbport = getenv ('DB_PORT');
        $userid = getenv ('DB_USERNAME');
        $userpw = getenv ('DB_PASSWORD');

        $this ->handle = new \mysqli ($dbhost, $userid, $userpw, $dbname); // $dbport, $socket);

        if ($this ->handle ->connect_errno) {
            printf ('Connect failed: %s<br />', $this ->handle ->connect_error);
            exit ();
        }

    }

    public function connect () { return $this->handle; }

}

// __END__
