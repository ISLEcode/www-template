<script lang="ts">
import { FormGroup, Input, Label } from 'sveltestrap5'
import { qrbill } from '../../store/qrbills'

function update_delay () {
    const a = new Date ($qrbill .payment. date)
    const b = new Date ($qrbill .payment. duedate)
    const c = 1000 * 60 * 60 * 24;

    const utc1 = Date .UTC (a .getFullYear(), a .getMonth(), a .getDate());
    const utc2 = Date .UTC (b .getFullYear(), b .getMonth(), b .getDate());

    $qrbill .payment .delay = Math .floor ((utc2 - utc1) / c);
}

export let readonly = false
export let tabindex = -1

let input_ok = ''

</script>

<FormGroup class="form-floating">
  <Input
    bind:value={$qrbill.payment.duedate}
    class="{input_ok}"
    id="payment-duedate"
    on:change={update_delay}
    on:input={update_delay}
    placeholder="Echéance pour le paiment de ce BV"
    {readonly}
    tabindex={readonly ? -1 : tabindex}
    type="date"
  />
  <Label
    for="payment-duedate"
    class={readonly ? 'form-control-plaintext' : ''}>
    Echéance
  </Label>
  <div class="invalid-feedback"></div>
</FormGroup>
