
export const qrbill2ary = (qrbill: any, prefs: any): any => {

    return {

        bill_kind           : 'QRR',
        bill_id             : qrbill .payment .billid           || '',
        bill_subject        : qrbill .payment .moreinfo         || '',
        bill_reference      : qrbill .payment .reference        || '',
        bill_order          : qrbill .payment .order            || 0,
        bill_account        : qrbill .payment .account          || 0,
        bill_amount         : qrbill .payment .amount           || 0,
        bill_currency       : qrbill .payment .currency         || 'CHF',
        bill_vatcode        : qrbill .payment .vatcode          || '0',
        bill_date           : qrbill .payment .date    .replace (/\D/g, ''),
        bill_delay          : qrbill .payment .delay            || 1,
        bill_duedata        : qrbill .payment .duedate .replace (/\D/g, ''),
        bill_rawdata        : qrbill.data,

        creditor_id         : qrbill .creditor .organisation || 0,
        creditor_update     : qrbill .creditor .update ? 1 : 0,
        creditor_name       : qrbill .creditor .name    || '',
        creditor_label      : qrbill .creditor .label   || '',
        creditor_suffix     : qrbill .creditor .suffix  || '',
        creditor_contact    : qrbill .creditor .contact || 0,
        creditor_iban       : qrbill .creditor .iban,
        creditor_ledger     : qrbill .creditor .id || 0,
        creditor_addr1      : qrbill .creditor .addrtype == 'S'
                            ? qrbill .creditor .addr1 + ', ' + qrbill .creditor .addr2
                            : qrbill .creditor .addr1,
        creditor_addr2      : qrbill .creditor .addrtype == 'S'
                            ? ''
                            : qrbill .creditor .addr2,
        creditor_postcode   : qrbill .creditor .postcode,
        creditor_location   : qrbill .creditor .location,
        creditor_country    : qrbill .creditor .country,

    }

}

export const qrbill2sql = (qrbill: any, prefs: any): string => {

    const sql = qrbill2ary (qrbill, prefs);

    return `SELECT f_ins_qrbill(
    '${sql.bill_kind}',
    '${sql.bill_id}',
    '${sql.bill_subject}',
    '${sql.bill_reference}',
    '${sql.bill_order}',
    '${sql.bill_account}',
    ${sql.bill_amount},
    '${sql.bill_currency}',
    '${sql.bill_vatcode}',
    ${sql.bill_date},
    ${sql.bill_delay},
    ${sql.bill_duedata},
    '${sql.bill_rawdata}',

    ${sql.creditor_id},
    ${sql.creditor_update},
    '${sql.creditor_name}',
    '${sql.creditor_label}',
    '${sql.creditor_suffix}',
    ${sql.creditor_contact},
    '${sql.creditor_iban}',
    ${sql.creditor_ledger},
    '${sql.creditor_addr1}',
    '${sql.creditor_addr2}',
    '${sql.creditor_postcode}',
    '${sql.creditor_location}',
    '${sql.creditor_country}'
    );`

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

    // By default (i.e. for a new creditor) the label is set to the name
    creditor .label = creditor .name

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

    if (prefs.auto_reference && payment.moreinfo)
        payment .billid = payment.moreinfo

    payment .date      = new Date () .toJSON () .slice (0, 10)
    payment .delay     = 30
    payment .vatcode   = '0'

    // TODO This is a blunt copy of `update_duedate` in `payment.svelte`... avoid redundant code!
    let date = new Date (payment. date)
    let duedate = new Date ();
    duedate .setDate (date .getDate() + payment .delay)
    payment .duedate = duedate .toLocaleDateString ('fr-CA', {year: 'numeric', month: '2-digit', day: '2-digit'});

}

// Automatic CREDITOR match if
// 1. Same IBAN and only 1 result
// 2. Same IBAN and many results
//      a) match first non-zero digits of creditor's QRR reference with supplier's reference_id (show list)
//      b) otherwise display all
// 3. Un-matched IBAN then new supplier

//! @fn     match_suppliers
//! @brief  Enumerate all suppliers matching a given IBAN and reference
//! @param  suppliers   The list of suppliers considered as input
//! @param  iban        The IBAN identification against which suppliers should be checked
//! @param  reference   A reference ID use to uniquely identify a given supplier
//! @return An array with the records of all matched suppliers
//! @note   If both the IBAN and the reference are matched we return a singleton result set
//!         (i.e. no subsequent checking is done to look for additional matching records)
//!         -> Redo logic

export const match_suppliers = (suppliers, iban, reference) => {

    // Make sure we have something to process
    let rs = [{ id: 0, ĺabel: 'Nouveau fournisseur' } ];

    return rs

    /*
    // Make sure we have suppliers to process
    if (!suppliers .length) return rs

    // Make sure we have a filter to apply
    if (!iban) return [ rs, ...suppliers ]; // IMPOSSIBLE CASE

    // Strip leading zeros from reference and keep track of resulting string length
    let refid  = reference .replace ('^/0\+/', '')
    let length = refid.length

    // TODO
    // Apply the filter -- single match if both iban and reference match
    suppliers .forEach ((item, input) => {

        // Ignore all non-matched IBANs
        if (!(input.iban && input.iban.length > 0 && iabn && iban.length > 0 && input .iban == iban)) continue

        // If we match both the IBAN and the reference, we have a unique result (don't match any futher)
        // if (input.reference_id.length && reference.length && reference .indexOf (input .reference_id) == 0) return [ input, rs ];

        // Append matched IBAN to result set
        rs .push (input)

    })

    // We're done, return result set
    return rs
    */

}
