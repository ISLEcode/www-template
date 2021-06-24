<script lang="ts">
import { FormGroup, Input, Label } from 'sveltestrap5';
import { qrbill } from '../../store/qrbills'

export let readonly = false
export let tabindex = -1

let input_ok = ''

</script>

<FormGroup class="form-floating">
  <Input
    id="payment-creditor-suffix"
    class="{input_ok}"
    bind:value={$qrbill.creditor.suffix}
    placeholder="Libellé"
    {readonly}
    tabindex={readonly ? -1 : tabindex}
    type="text"
    />
  <Label
    for="payment-creditor-suffix"
    class={readonly ? 'form-control-plaintext' : ''}>
    Mot(s) clé
  </Label>
  <div class="invalid-feedback"></div>
</FormGroup>

