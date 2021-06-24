<script lang="ts">
// We call CREDITOR  the object whose data has been collected from the QR code
// We call SUPPLIERS the list of suppliers provided by the backend
// We want to bind a CREDITOR to a SUPPLIER
//
// SUPPLIER's name = CREDITOR's name (official, fixed, and used for subsequent billing/payments)
// SUPPLIER's label = convenience label for on-screen selection (with or without addition suffix keywords)

import { onMount } from 'svelte';
import { FormGroup, Input, Label } from 'sveltestrap5'
import { qrbill } from '../../store/qrbills'

export let suppliers            // Parent component shall provide the list of suppliers
export let tabindex = -1        // Parent component shall give us our tab position in the form

let selected    = null          // id of the selected supplier (i.e. supplier.id)
let disabled    = false         // Toggle used to disable input on new supplier
let input_ok    = ''            // Input class used for validation purposes
let filtered                    // List of applicable suppliers for this QRbill

function bind_supplier (supplier = null) {

    // CASE MYSQL 5.7
    // TODO if supplier hasmanyaccounts disable account dropdown and send 0 as the account id
    // CASE MYSQL 8 (for next release)
    // TODO if supplier hasmanyaccounts automatically set split-account views
    // TODO allow split accounting to be done in same tab (user configurable option)

    // Reactive call if no supplier; assign selected supplier
    if (supplier == null) {

        // Make sure the filtered list of suppliers exists
        if (filtered == null) { console .log ('No suppliers... this should not happen!'); return }

        // Assign the currently selected (or default) supplier
        supplier = filtered .filter (supplier => supplier.id === selected)

    }

    console.log('Before update -- supplier', supplier)

    if (supplier.id == 0) {
console .log ('Creating new supplier')
        $qrbill .payment  .account       = 0
        $qrbill .payment  .delay         = 30
        $qrbill .payment  .vatcode       = '0'

        $qrbill .creditor .update = true
        $qrbill .creditor .id            = 0
        $qrbill .creditor .contact       = 0
        $qrbill .creditor .organisation  = 0
        $qrbill .creditor .multiaccounts = 0
        $qrbill .creditor .label         = $qrbill .creditor. name
        $qrbill .creditor .suffix        = ''
    }
    else {
console .log ('Using existing supplier')
        $qrbill .payment  .account       = supplier .account_id
        $qrbill .payment  .delay         = supplier .delay
        $qrbill .payment  .vatcode       = supplier .vat_id

        $qrbill .creditor .update = false
        $qrbill .creditor .id            = supplier .id
        $qrbill .creditor .contact       = supplier .contact_id
        $qrbill .creditor .organisation  = supplier .organisation_id
        $qrbill .creditor .multiaccounts = supplier .hasmanyaccounts
        $qrbill .creditor .label         = supplier .supplier_name
        $qrbill .creditor .suffix        = supplier .supplier_suffix
    }



    update_duedate ();
    console.log('After update - creditor', $qrbill.creditor)

}

function filter_suppliers () {

    // Default select entry when no existing suppliers have been found
    let new_supplier = { id: 0, supplier_label: 'Nouveau fournisseur' }

    // Handle case where database is empty (null result returned by API)
    if (!suppliers) return [ new_supplier ]

    // Filter out all suppliers that don't have the same IBAN as that of the QR bill under scrutiny
    const same_iban = suppliers .filter (supplier => supplier.iban == $qrbill.creditor.iban)

    // If we didn't find any, then the user will have to create one
    if (same_iban .length == 0) { disabled = true; bind_supplier (new_supplier); return [ new_supplier ] }

    // Otherwise see if we have reference IDs that match this QR bill's reference
    disabled = false; const same_ref  = same_iban .filter (supplier => {
        if (!supplier .reference_id) return false
        let a = supplier .reference_id, b; switch ($qrbill .payment. reftype) {
            case 'QRR'  : b = $qrbill .payment .reference .replace (/^0/g, '')
            case 'SCOR' : b = $qrbill .payment .reference .replace (/^RF\d\d/, '')
            default     : return false
        }

        if (b.length < a.length) return false
        return (b. substr (0, a.length) === a)
    })

    // We're done, return the appropriate result set
    new_supplier = { id: 0, supplier_label: 'Créer une nouvelle entrée pour ce fournisseur' }
    if (same_ref .length > 0) { bind_supplier (same_ref [0]); return [ ...same_ref,  new_supplier ] }
    else                      { bind_supplier (same_iban[0]); return [ ...same_iban, new_supplier ] }

}

$: console.log ('Refresh: selected =', selected)
$: if (selected != null) {
    let subset = filtered .filter (supplier => supplier.id === selected)
    if (subset != null) bind_supplier (subset[0])
}
$: disabled = (selected == 0)


// TODO This function is replicated in several locations... consolidate that!!!
function update_duedate () {

    // Collect the bill's date and reformat it's string representation to our canonical format
    const date  = new Date ($qrbill .payment. date)
    const cdate = date .toLocaleDateString ('fr-CA', {year: 'numeric', month: '2-digit', day: '2-digit'});

    // Collect the delay to apply to the bill's date
    const delay = $qrbill .payment .delay

    // Calculate the duedate and format its string representation to our canonical format
    date .setDate (date .getDate() + delay)
    const duedate = date .toLocaleDateString ('fr-CA', {year: 'numeric', month: '2-digit', day: '2-digit'});

    // We're done... update the current bill's dates
    $qrbill .payment .date    = cdate
    $qrbill .payment .duedate = duedate

}

// $: filtered     = filter_suppliers()    // Make filtered list reactive
onMount (() => {
    filtered = filter_suppliers ()
    selected = filtered[0].id
})

</script>

<FormGroup class="form-floating input-group">
  <Input
    bind:value={selected}
    class="{input_ok}"
    {disabled}
    id="payment-assign-supplier"
    tabindex={disabled ? -1 : tabindex}
    type="select">
    {#if filtered}
      {#each filtered as supplier}
        <option
          selected={selected === supplier.id}
          value={supplier.id}>
          {supplier.supplier_label}
        </option>
      {/each}
    {/if}
  </Input>
  <Label
    for="payment-assign-supplier"
    class={disabled ? 'form-control-plaintext' : ''}>
    Fournisseur
  </Label>
  <div class="invalid-feedback"></div>
</FormGroup>
