<script lang="ts">
import { FormGroup, Input, Label } from 'sveltestrap5';
import { qrbill } from '../../store/qrbills'

export let readonly = false
export let tabindex = -1

let input_ok = ''

function update_duedate () {
    let date = new Date ($qrbill .payment. date)
    let duedate = new Date ();
    duedate .setDate (date .getDate() + $qrbill .payment .delay)
    // $qrbill .payment .duedate = duedate .getFullYear() + '-' + (duedate .getMonth() + 1) + '-' + duedate .getDate()
    $qrbill .payment .duedate = duedate .toLocaleDateString ('fr-CA', {year: 'numeric', month: '2-digit', day: '2-digit'});

}

</script>

<FormGroup class="form-floating">
  <Input
    bind:value={$qrbill.payment.amount}
    class="{input_ok}"
    id="payment-amount"
    placeholder="0.00"
    {readonly}
    tabindex={readonly ? -1 : tabindex}
    type="number"
  />
  <Label
    for="payment-amount"
    class={readonly ? 'form-control-plaintext' : ''}>
    Montant
  </Label>
  <div class="invalid-feedback"><em>Montant du paiement</em> —
      L'élément est à indiquer sans zéros de tête y compris séparateur décimal et deux décimales.
    — Décimal, 12 positions au maximum admises, y compris séparateur décimal.
    — Seul le point («.») est admis comme séparateur décimal.
  </div>
</FormGroup>
