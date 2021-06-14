<?php namespace SAM\API\ERP;

use \SAM\API\Entity;

class Country extends \SAM\API\Entity {

    public function __construct ($db, $verb = null) {

        parent::__construct ($db, $verb);

        $this->map = [ 'getall' => 'SELECT NoPays AS id, PAY_Code as alpha2, PAY_NameFR as label FROM pays;' ];

    }

}

// __END__
