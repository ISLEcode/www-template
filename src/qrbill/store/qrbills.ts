import { writable } from "svelte/store";
import { lstore   } from './lstore';

export const qrbill = writable ({
    validated:          false,          // Toggle by user once the payment has been validated
    accounts:           [],             // Break bill down into multiple accounts
    creditor:           {               // The creditor's record
        // QRR Data:
        iban:           null,
        name:           null,           // The creditor's name (from the QRcode)
        addrtype:       'S',            // Address kind
        addr1:          null,           // Street or address line 1
        addr2:          null,           // Street number or address line 1
        postcode:       null,           // ZIP code
        location:       null,           // City or geographic location
        country:        null,           // Country alpha-2 code present in QRcode, not handled by SAMinfo
        // Complementary data:
        contact:        0,              // Useless data passed through as is (why?)
        id:             0,              // Supplier ID (or `+` if new supplier)
        label:          '',             // The creditor's designation label (as it should be stored in SAMinfo)
        ledger:         0,              // The credito's banking details (binds to the unique creditor ID)
        multiaccounts:  0,              // TODO Cf. hasmanyaccounts
        organisation:   0,              // Creditor's unique organisation ID within SAMinfo
        suffix:         '',             // Suffix to append to the creditor's designation label (optional)
        update:         false           // Indicates that payment details should be updated for this supplier on the backend
    },
    data:               null,           // Raw QR code data
    debtor:             {               // The debtor's record (aka `suppliers` in SAMinfo)
        iban:           null,           //
        name:           null,
        addrtype:       'S',            // Address kind
        addr1:          null,
        addr2:          null,
        postcode:       null,
        location:       null,
        country:        null,
    },
    orders:             [],             // Break bill down into multiple orders (aka mandates in SAMinfo)
    payment:            {               // The actual bill details
        account:        null,
        amount:         null,
        billid:         null,
        billinfo:       null,
        currency:       null,
        date:           null,
        delay:          null,           // Delay in days
        duedate:        null,
        extra1:         null,
        extra2:         null,
        moreinfo:       null,
        order:          null,
        reference:      null,
        reftype:        null,
        splitaccounts:  false,
        splitorders:    false,
        vatcode:        null,
        vatless:        false           // Indicates whether amount is with or without VAT (TODO is this needed?)
    },
    subscribe:          null,           // Required by (Svelte) design
    tab:                'qr',           // Set active tab in UI
    ucreditor:          {               // The ultimate creditor's record, if any
        iscreditor:     true,           // When set ultimate creditor is the creditor
        iban:           null,
        name:           null,
        addrtype:       'S',            // Address kind
        addr1:          null,
        addr2:          null,
        postcode:       null,
        location:       null,
        country:        null,
    }

});

const default_qrbills = [];

function new_qrbill (id) { return { id: id, label: '' }}

export const qrbills = lstore ('qrbills', default_qrbills);

export function add_qrbill (id) { qrbills .update ((ary) => [new_qrbill (id), ...ary]) }

export function del_qrbill (id) { qrbills .update ((all) => all .filter ((qrbill) => qrbill.id !== id)) }

export function set_qrbill (id, label) {
   qrbills .update ((all) => all .map ((qrbill) => qrbill .id === id ? { ...qrbill, label: label } : { ...qrbill }))
}
