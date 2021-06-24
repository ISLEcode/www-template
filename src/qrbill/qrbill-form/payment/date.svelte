<script lang="ts">
import { FormGroup, Input, Label } from 'sveltestrap5';
import { qrbill } from '../../store/qrbills'

export let readonly = false
export let tabindex = -1

let input_ok = ''

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

</script>

<FormGroup class="form-floating">
  <Input
    bind:value={$qrbill.payment.date}
    class="{input_ok}"
    id="payment-date"
    on:change={update_duedate}
    placeholder="Date du BV"
    {readonly}
    tabindex={readonly ? -1 : tabindex}
    type="date"
  />
  <Label
    for="payment-date"
    class={readonly ? 'form-control-plaintext' : ''}>
    Date du BV
  </Label>
  <div class="invalid-feedback"></div>
</FormGroup>
