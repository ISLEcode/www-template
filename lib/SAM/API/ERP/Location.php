<?php namespace SAM\API\ERP;

use \SAM\API\Entity;

class Location extends \SAM\API\Entity {

    public function __construct ($db, $verb = null) {

        $dbhost = getenv ('DB_HOST');
        $dbport = getenv ('DB_PORT');
        $userid = getenv ('DB_USERNAME');
        $userpw = getenv ('DB_PASSWORD');

        $db = new \mysqli ($dbhost, $userid, $userpw, 'gp_config');

        parent::__construct ($db, $verb);

        $this->map = [ 'getall' => 'SELECT
            swiss_municipality_id   AS id,
            zip_code                AS zipcode,
            municipality            AS location,
            canton                  AS region
            FROM _swissmunicipality;'
        ];

    }

}

// __END__
