import { writable } from 'svelte/store'

const store = () => {

    const state = {

        scanning:  false,
        online:    false,
        dirty:     false,
        backend:    'https://dusaasp1.isle.plus/qrcode/api/index.php',

        bills:      [],
        countries:  [],
        ledger:     [],
        locations:  [],
        orders:     [],
        suppliers:  [],
        vatcodes:   [],

        prefs: {                            // User interface and extra functionality
            auto_hidesupplier:  false,      // Only show supplier label/suffix for new entries
            auto_location:      true,       // Autodetermine postcode/location from address2 if postcode/location are missing
            auto_reference:     false,      // Automatically assign QRcode free-form bill information when available
            edit_amount:        true,       // Allow user to edit the billed amout (independently of `edit_qrdata`)
            edit_qrdata:        false,      // In developer mode, allow editing the QRcode data
            editable:           false,      // Make QRcode data editable (excepte amout, currency and iban)
            maintenance:        null,       // Toggles mainteance mode if set; value is the HTML message to display
            show_creditor:      false,      // Toggle visibility of creditor tab
            show_debtor:        false,      // Toggle visibility of debtor tab
            show_devtab:        true,       // Enable development mode
            show_json:          true,       // Show data that will be sent out to the API
            show_qrdata:        false,      // In developer mode, show the raw QRcode data
            show_splits:        false,      // Allow bill amount to be split over several accounts/orders
            show_sqlcmd:        false,      // In developer mode, show the SQL update statement
            show_sqlmap:        true,       // With `show_json`, show SQL table mappings
            use_samples:        false,      // Use predefined QRbill data strings (and skip scanning phase)
            use_ucrediban:      false,      // QRcode doesn't provision IBAN field for ultimate creditor, allow one
            use_ucreditor:      false       // Indicate whether ucreditor functionality is in use
        },

        user: {
            name:       null,                      // User's mnemonic name
            password:   null,
            token:      null,                      // User's authentication token
            database:   null,
            superuser:  false
        }
    }

    const { subscribe, set, update } = writable (state)

    const methods = {
        save () {
            console.log('*: rc -> save ()', state)
            window. localStorage .setItem ('sam-qrcode', JSON .stringify (state))
        },

        load () {
            console.log('*: rc -> load ()', state)
            update (state => JSON .parse (localStorage .getItem ('sam-qrcode')) || [])
        },

        sync () {
            // Content-Type: application/json
            // Authorization: Bearer state.user.profile

            let options = { headers: { 'Authorization': 'Bearer ' + state.user.token }}

            fetch  (`${state.backend}/ledger-accounts`, options)
            .then  ((response) => { return response .ok ? response .json() : Promise .reject (response) })
            .then  ((data)     => { update (a => { var b = Object .assign ({}, a); b .ledger = data .body; return b })})

            .then  (()         => { return fetch  (`${state.backend}/orders`, options) })
            .then  ((response) => { return response .ok ? response .json() : Promise .reject (response) })
            .then  ((data)     => { update (a => { var b = Object .assign ({}, a); b .orders = data .body; return b })})

            .then  (()         => { return fetch  (`${state.backend}/suppliers`, options) })
            .then  ((response) => { return response .ok ? response .json() : Promise .reject (response) })
            .then  ((data)     => { update (a => { var b = Object .assign ({}, a); b .suppliers = data .body; return b })})

            .then  (()         => { return fetch  (`${state.backend}/vatrates`, options) })
            .then  ((response) => { return response .ok ? response .json() : Promise .reject (response) })
            .then  ((data)     => {
                update (a => { var b = Object .assign ({}, a); b .vatcodes = data .body;
                    window. localStorage .setItem ('sam-qrcode', JSON .stringify (b))
                    return b
                })
            })

            .catch ((error)    => { })

        }
    }

    return { subscribe, set, update, ...methods }

}

export default store()
