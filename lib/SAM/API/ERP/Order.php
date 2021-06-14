<?php namespace SAM\API\ERP;

use \SAM\API\Entity;

class Order extends \SAM\API\Entity {

    public function __construct ($db, $verb = null) {

        parent::__construct ($db, $verb);

        $this->map = [ 'getall' => "SELECT
  NoProjet as id,
  CASE WHEN ifnull(ENT_RaisonSociale,'') = ''
  THEN
    CASE WHEN ifnull(PRO_DateFin,0) = 0
    THEN CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(CNT_Prenom, ' '), CNT_Nom), ' - '), PRO_LibelleCourt), ' ('), DATE_FORMAT(STR_TO_DATE(PRO_DateDebut, '%Y%m%d'), '%d.%m.%Y')), ')')
    ELSE CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(CNT_Prenom, ' '), CNT_Nom), ' - '), PRO_LibelleCourt), ' ('), DATE_FORMAT(STR_TO_DATE(PRO_DateDebut, '%Y%m%d'), '%d.%m.%Y')), ' - '), DATE_FORMAT(STR_TO_DATE(PRO_DateFin, '%Y%m%d'), '%d.%m.%Y')), ')')
    END
  ELSE
    CASE WHEN ifnull(PRO_DateFin,0) = 0
    THEN CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(ENT_RaisonSociale, ' - '), PRO_LibelleCourt), ' ('), DATE_FORMAT(STR_TO_DATE(PRO_DateDebut, '%Y%m%d'), '%d.%m.%Y')), ')')
    ELSE CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(ENT_RaisonSociale, ' - '), PRO_LibelleCourt), ' ('), DATE_FORMAT(STR_TO_DATE(PRO_DateDebut, '%Y%m%d'), '%d.%m.%Y')), ' - '), DATE_FORMAT(STR_TO_DATE(PRO_DateFin, '%Y%m%d'), '%d.%m.%Y')), ')')
    END
  END as label,
  0 as isdefault
FROM projet
     INNER JOIN gestionprojet ON NoProjet = GPR_NoProjet
     INNER JOIN contact ON NoContact = GPR_NoContact
     INNER JOIN entreprise ON NoEntreprise = GPR_NoEntreprise
WHERE CASE WHEN ifnulL(PRO_DateFin,0) = 0 THEN 99991231 ELSE PRO_Datefin END >= CONVERT(DATE_FORMAT(DATE_ADD(SYSDATE(), INTERVAL -3 MONTH), '%Y%m%d'), DECIMAL)
  AND ifnull(PRO_Deleted, 0) = 0
UNION
SELECT
  0 as id,
  '' as project,
  1 as isdefault;" ];

    }

}

// __END__
