<?php namespace SAM\API\ERP;

use \SAM\API\Entity;

class LedgerAccount extends \SAM\API\Entity {

    public function __construct ($db, $verb = null) {

        parent::__construct ($db, $verb);

        $this->map = ['getall' => "SELECT
            PCO_NoCompte                                            AS id,
            CONCAT(CONCAT(PCO_NoCompte, ' - '), PCO_CompteLibelle)  AS label,
            0                                                       AS isdefault
        FROM exercicecomptable
        INNER JOIN plancomptable ON PCO_NoExercice = ECO_NoExercice
            WHERE CONVERT(DATE_FORMAT(SYSDATE(), '%Y%m%d'), DECIMAL) BETWEEN ECO_DateDebut AND ECO_DateFin
            AND PCO_BCompteGroupe = 0
        UNION SELECT
            0 as id,
            '' as account,
            1 as isdefault;"];

    }

}

// __END__
