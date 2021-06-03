import { writable } from "svelte/store";
import { lstore   } from './lstore';

export const qrbill = writable ({
    validated:          false,          // Toggle by user once the payment has been validated
    accounts:           [],             // Break bill down into multiple accounts
    creditor:           {               // The creditor's record
        iban:           null,
        name:           null,
        addrtype:       'S',            // Address kind
        addr1:          null,
        addr2:          null,
        postcode:       null,
        location:       null,
        country:        null,
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
        delay:          null,
        duedate:        null,
        extra1:         null,
        extra2:         null,
        moreinfo:       null,
        order:          null,
        reference:      null,
        reftype:        null,
        splitaccounts:  false,
        splitorders:    false,
        supplier:       null,
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
    },
    ux:                 {               // User interface and extra functionality
        editable:       true,           // Make QRcode data editable (excepte amout, currency and iban)
        show_devtab:    true,           // Enable development mode
        show_debtor:    false,          // Toggle visibility of debtor tab
        show_qrdata:    false,          // In developer mode, show the raw QRcode data
        edit_qrdata:    false,          // In developer mode, allow editing the QRcode data
        use_ucreditor:  false,          // Indicate whether ucreditor functionality is in use
        use_ucrediban:  false,          // QRBill doesn't provision IBAN for ultimate creditor
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
