
export const qrbill2ary = (qrbill: any, prefs: any): any => {

    let bill_account    = qrbill .payment .account          || 0
    let bill_amount     = qrbill .payment .amount           || 0
    let bill_currency   = qrbill .payment .currency         || 'CHF'
    let bill_date       = qrbill .payment .date    .replace (/\D/g, '')
    let bill_delay      = qrbill .payment .delay            || 1
    let bill_duedate    = qrbill .payment .duedate .replace (/\D/g, '')
    let bill_billid     = qrbill .payment .billid           || ''
    let bill_moreinfo   = qrbill .payment .moreinfo         || ''
    let bill_order      = qrbill .payment .order            || 0
    let bill_reference  = qrbill .payment .reference        || ''
    let bill_vatcode    = qrbill .payment .vatcode          || '0'

    let who_id          = qrbill .creditor .id         || 0
    let who_update      = qrbill .payment .updatesupplier   || 0
    let who_suffix      = qrbill .creditor .suffix         || ''

    return {
        qrr_typeqrcode      : 'QRR',
        qrr_code            : '',
        qrr_codemonnaie     : bill_currency,
        qrr_date            : bill_date,
        qrr_dateecheance    : bill_duedate,
        qrr_delai           : bill_delay,
        qrr_montantoriginal : bill_amount,
        qrr_motif           : bill_moreinfo,
        qrr_nocategorietva  : bill_vatcode,
        qrr_nocompte        : bill_account,
        qrr_nodocument      : bill_billid,
        qrr_noprojet        : bill_order,
        qrr_reference       : bill_reference,
        fournisseur_addr1   : qrbill.creditor.addr1,
        fournisseur_addr2   : qrbill.creditor.addr2,
        fournisseur_iban    : qrbill.creditor.iban,
        fournisseur_id      : who_id,
        fournisseur_lieu    : qrbill.creditor.location,
        fournisseur_maj     : who_update,
        fournisseur_motcle  : who_suffix,
        fournisseur_nom     : qrbill.creditor.name,
        fournisseur_npa     : qrbill.creditor.postcode,
        qrr_data            : qrbill.data,
    }

}

export const qrbill2sql = (qrbill: any, prefs: any): string => {

    let bill_account    = qrbill .payment .account          || 0
    let bill_amount     = qrbill .payment .amount           || 0
    let bill_date       = qrbill .payment .date    .replace (/\D/g, '')
    let bill_delay      = qrbill .payment .delay            || 1
    let bill_duedate    = qrbill .payment .duedate .replace (/\D/g, '')
    let bill_id         = qrbill .payment .billid           || ''
    let bill_order      = qrbill .payment .order            || 0
    let bill_reference  = qrbill .payment .reference        || ''
    let bill_vatcode    = qrbill .payment .vatcode          || '0'

    let who_id          = qrbill .creditor .id         || 0
    let who_update      = qrbill .payment .updatesupplier   || 0
    let who_suffix      = qrbill .creditor .suffix         || ''

    return `SELECT '' INTO v_qrr_code;
    SELECT  ${bill_date} INTO v_qrr_date;
    SELECT  ${bill_duedate} INTO v_qrr_dateecheance;
    SELECT  ${bill_delay} INTO v_qrr_delai;
    SELECT  ${bill_amount} INTO v_qrr_montantoriginal;
    SELECT '${bill_vatcode}' INTO v_qrr_nocategorietva;
    SELECT  ${bill_account} INTO v_qrr_nocompte;
    SELECT '${bill_id}' INTO v_qrr_nodocument;
    SELECT '${bill_order}' INTO v_qrr_noprojet;
    SELECT '${bill_reference}' INTO v_qrr_reference;
    SELECT 'QRR' INTO v_qrr_typeqrcode;

    SELECT '${who_id}' INTO v_fournisseur_id;
    SELECT '${qrbill.creditor.iban}' INTO v_fournisseur_iban;
    SELECT '${qrbill.creditor.addr1}' INTO v_fournisseur_addr1;
    SELECT '${qrbill.creditor.addr2}' INTO v_fournisseur_addr2;
    SELECT '${qrbill.creditor.location}' INTO v_fournisseur_lieu;
    SELECT '${qrbill.creditor.name}' INTO v_fournisseur_nom;
    SELECT '${qrbill.creditor.postcode}' INTO v_fournisseur_npa;

    SELECT '${who_suffix}' INTO v_fournisseur_motcle;
    SELECT  ${who_update} INTO v_fournisseur_maj;`

    // Not displayed because not currently used
    // SELECT '${qrbill.payment.currency}' INTO v_qrr_codemonnaie;
    // SELECT '${qrbill.payment.moreinfo}' INTO v_qrr_motif;

    // Not displayed to preserve on-screen estate
    // SELECT '${qrbill.data}' INTO v_qrr_data;

}

export const qrdata2array = (data: string, bill: any, prefs: any) => {

    let ary = data .replace (/\r/g, '') .split ("\n"), result

    const creditor = bill .creditor
    creditor .iban     = ary[ 3] // Mandatory
    creditor .addrtype = ary[ 4] // Mandatory
    creditor .name     = ary[ 5] // Mandatory
    creditor .addr1    = ary[ 6] // Optional
    creditor .addr2    = ary[ 7] // Optional
    creditor .postcode = ary[ 8] // Mandatory
    creditor .location = ary[ 9] // Mandatory
    creditor .country  = ary[10] || 'CH' // Mandatory

    if (prefs.auto_location && creditor.postcode == '' && creditor.location == '') {
        result = creditor .addr2 .match (/^(\d\d\d\d) (.*)/)
        if (result.length > 0) { creditor .postcode = result[1]; creditor .location = result[2]; creditor .addr2 = '' }
    }

    if (prefs.use_ucreditor) {

        const ucreditor = bill .ucreditor
        ucreditor .addrtype = ary[11] // For future use
        ucreditor .name     = ary[12] // For future use
        ucreditor .addr1    = ary[13] // For future use
        ucreditor .addr2    = ary[14] // For future use
        ucreditor .postcode = ary[15] // For future use
        ucreditor .location = ary[16] // For future use
        ucreditor .country  = ary[17] || 'CH' // For future use

        if (prefs.auto_location && ucreditor.postcode== '' && ucreditor.location == '') {
            result= ucreditor .addr2 .match (/^(\d\d\d\d) (.*)/)
            if (result.length > 0) { ucreditor .postcode= result[1]; ucreditor .location = result[2]; ucreditor .addr2 = '' }
        }

    }

    const debtor = bill .debtor
    debtor .addrtype = ary[20] // Mandatory
    debtor .name     = ary[21] // Mandatory
    debtor .addr1    = ary[22] // Optional
    debtor .addr2    = ary[23] // Optional
    debtor .postcode = ary[24] // Mandatory
    debtor .location = ary[25] // Mandatory
    debtor .country  = ary[26] || 'CH' // Mandatory

    if (prefs.auto_location && debtor.postcode == '' && debtor.location == '') {
        result = debtor .addr2 .match (/^(\d\d\d\d) (.*)/)
        if (result && result.length > 0) { debtor .postcode = result[1]; debtor .location = result[2]; debtor .addr2 = '' }
    }

    const payment = bill .payment
    payment .amount    = ary[18] // Optional
    payment .currency  = ary[19] || 'CHF' // Mandatory
    payment .reftype   = ary[27] // Mandatory
    payment .reference = ary[28] // Mandatory
    payment .moreinfo  = ary[29] // Optional
    payment .billinfo  = ary[31] // Optional
    payment .extra1    = ary[32] // Optional
    payment .extra2    = ary[33] // Optional

    if (prefs.auto_reference && payment.reftype == 'QRR' && payment.reference)
        payment .billid = payment.reference

    payment .date      = new Date () .toJSON () .slice (0, 10)
    payment .duedate   = payment .date
    payment .delay     = 1
    payment .vatcode   = '0'

}

