<?php namespace SAM\API\ERP;

use \SAM\API\Entity;

class Currency extends \SAM\API\Entity {

    public function __construct ($db, $verb = null) {

        parent::__construct ($db, $verb);

        $this->map = [ 'getall' => "SELECT
            NoMonnaie           AS id,
            MON_LibelleCourt    AS alpha3,
            MON_LibelleLong     AS label
            FROM monnaie
            WHERE MON_LibelleCourt = 'CHF' OR MON_LibelleCourt = 'EUR';" ];

    }

}

// __END__
