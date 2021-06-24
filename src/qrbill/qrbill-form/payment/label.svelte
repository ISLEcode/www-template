<script lang="ts">
import { FormGroup, Input, Label } from 'sveltestrap5';
import { qrbill } from '../../store/qrbills'

export let readonly = false
export let tabindex = -1

let input_ok = ''

</script>

<FormGroup class="form-floating">
  <Input
    bind:value={$qrbill.payment.billid}
    class="{input_ok}"
    id="payment-id"
    placeholder="0123456789"
    {readonly}
    tabindex={readonly ? -1 : tabindex}
    type="text"
  />
  <Label
    for="payment-id"
    class={readonly ? 'form-control-plaintext' : ''}>
    Référence facture
  </Label>
  <div class="invalid-feedback"></div>
</FormGroup>
