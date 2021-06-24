<?php namespace SAM\API\ERP;

use \SAM\API\Entity;

class QRBill extends \SAM\API\Entity {

    public function __construct ($db, $verb = null) {

        parent::__construct ($db, $verb);
        $this->map = [ 'create' => '' ];

    }

    public function post_prepare ($template, $input) {
    //! @fn     post_prepare
    //! @brief  Validate POSTed data and prepare the SQL statement to enact
    //! @param  $template   SQL template statement
    //! @param  $input      The POST data supplied by the caller
    //! @return Returns the SQL statement that shall be executed
    //! @see    https://github.com/PATinfo/sam-procsql/blob/master/functions/f_ins_qrbill.sql
    //! @note   Use `SELECT specific_name, routine_type FROM information_schema.routines` to check if function is loaded
    //!
    //! IMPORTANT We do no backend data validation and assume that all inputs have been made SQL safe by the frontend.
    //! This could be a source of SQL injection and should be further mitigated subsequently.


        // TODO BUG Due date should be calculated before submitting qrbill
        if (!isset ($input['bill_duedate']) || $input['bill_duedate'] == '') $input['bill_duedate'] = $input['bill_date'];

        // QRcode data
        $sql  = "'" . $input['bill_kind']         . "',"; # VARCHAR(100)    -> qrr_typeqrcode
        $sql .= "'" . $input['bill_id']           . "',"; # VARCHAR(100)    -> qrr_nodocument
        $sql .= "'" . $input['bill_subject']      . "',"; # VARCHAR(100)    -> qrr_motif
        $sql .= "'" . $input['bill_reference']    . "',"; # VARCHAR(100)    -> qrr_reference
        $sql .= "'" . $input['bill_order']        . "',"; # VARCHAR(100)    -> qrr_noprojet
        $sql .=       $input['bill_account']      .  ","; # BIGINT          -> qrr_nocompte
        $sql .=       $input['bill_amount']       .  ","; # DECIMAL(10,2)   -> qrr_montantoriginal
        $sql .= "'" . $input['bill_currency']     . "',"; # VARCHAR(100)    -> qrr_codemonnaie
        $sql .= "'" . $input['bill_vatcode']      . "',"; # VARCHAR(100)    -> qrr_nocategorietva
        $sql .=       $input['bill_date']         .  ","; # DATE            -> qrr_date
        $sql .=       $input['bill_delay']        .  ","; # BIGINT          -> qrr_delai
        $sql .=       $input['bill_duedate']      .  ","; # DATE            -> qrr_dateecheance
        $sql .= "'" . $input['bill_rawdata']      . "',"; # VARCHAR(100)    -> qrr_data

        // Creditor data (i.e. supplier)
        $sql .=       $input['creditor_id']       .  ","; # BIGINT          -> fournisseur_id
        $sql .=       $input['creditor_update']   .  ","; # BOOLEAN         -> fournisseur_maj
        $sql .= "'" . $input['creditor_name']     . "',"; # VARCHAR(100)    -> fournisseur_nom
        $sql .= "'" . $input['creditor_label']    . "',"; # VARCHAR(100)    -> fournisseur_label
        $sql .= "'" . $input['creditor_suffix']   . "',"; # VARCHAR(100)    -> fournisseur_motcle
        $sql .=       $input['creditor_contact']  .  ","; # BIGINT          -> fournisseur_contact
        $sql .= "'" . $input['creditor_iban']     . "',"; # VARCHAR(100)    -> fournisseur_iban
        $sql .=       $input['creditor_ledger']   .  ","; # BIGINT          -> fournisseur_donneesbancaire
        $sql .= "'" . $input['creditor_addr1']    . "',"; # VARCHAR(100)    -> fournisseur_addr1
        $sql .= "'" . $input['creditor_addr2']    . "',"; # VARCHAR(100)    -> fournisseur_addr2
        $sql .= "'" . $input['creditor_postcode'] . "',"; # VARCHAR(100)    -> fournisseur_npa
        $sql .= "'" . $input['creditor_location'] . "',"; # VARCHAR(100)    -> fournisseur_lieu
        $sql .= "'" . $input['creditor_country']  . "'";  # VARCHAR(100)    -> fournisseur_pays

        return "SELECT f_ins_qrbill($sql);";

    }

    public function post_respond ($sql, $result) {
    //! @fn     post_respond
    //! @brief  Pre-process the MySQL engine result before sending it back to the caller
    //! @param  $result The outcome of enacting the SQL statement prepared by `post_prepare`
    //! @return Returns the raw data which should be converted to JSON and sent back to the caller

        $out = '';
        $out = $result;
        return $out;

    }

}

// __END__
