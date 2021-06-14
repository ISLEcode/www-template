import { writable } from "svelte/store";

export const prefs = writable ({    // User interface and extra functionality
    auto_location:  true,           // Autodetermine postcode/location from address2
    edit_qrdata:    false,          // In developer mode, allow editing the QRcode data
    editable:       false,          // Make QRcode data editable (excepte amout, currency and iban)
    show_debtor:    false,          // Toggle visibility of debtor tab
    show_devtab:    true,           // Enable development mode
    show_json:      true,           // Show data that will be sent out to the API
    show_qrdata:    false,          // In developer mode, show the raw QRcode data
    show_splits:    false,          // Allow bill amount to be split over several accounts/orders
    show_sqlmap:    true,           // With `show_json`, show SQL table mappings
    show_sqlcmd:    false,          // In developer mode, show the SQL update statement
    use_ucrediban:  false,          // QRcode doesn't provision IBAN field for ultimate creditor, allow one
    use_ucreditor:  false,          // Indicate whether ucreditor functionality is in use
});

