<script lang="ts">
import { FormGroup, Input, Label } from 'sveltestrap5';
import { qrbill } from '../../store/qrbills'

export let readonly = false
export let tabindex = -1

let input_ok = ''

</script>

<FormGroup class="form-floating">
  <Input
    id="payment-creditor-label"
    class="{input_ok}"
    type="text"
    bind:value={$qrbill.creditor.label}
    placeholder="Libellé"
    {readonly}
    tabindex={readonly ? -1 : tabindex}
  />
  <Label
    for="payment-creditor-label"
    class={readonly ? 'form-control-plaintext' : ''}>
    Libellé fournisseur
  </Label>
  <div class="invalid-feedback"></div>
</FormGroup>
