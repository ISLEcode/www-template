<?php namespace SAM\API\ERP;

use \SAM\API\Entity;

class VATRate extends \SAM\API\Entity {

    public function __construct ($db, $verb = null) {

        parent::__construct ($db, $verb);

        // THIS IS A TEST
        $this->map = [ 'getall' => "SELECT
  '0' as id,
  'Pas de TVA' as label,
  1 as isdefault
UNION
SELECT
  CodeCategorieTVA as id,
  CTV_LibelleLong as label,
  0 as isdefault
FROM categorietva
     INNER JOIN gestiontva ON CodeCategorieTVA = GTV_CodeCategorieTVA
WHERE CONVERT(DATE_FORMAT(SYSDATE(), '%Y%m%d'), DECIMAL) BETWEEN GTV_DateDebut
AND CASE WHEN ifnull(GTV_DateFin,0) = 0 THEN 99991231 ELSE GTV_DateFin END;"];

    }

}

// __END__
