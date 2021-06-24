<script lang="ts">
import { FormGroup, Input, Label } from 'sveltestrap5';
import { qrbill } from '../../store/qrbills'

export let readonly = false
export let tabindex = -1

let input_ok = ''

</script>

<FormGroup class="form-floating">
  <Input
    bind:value={$qrbill.payment.extra2}
    class="{input_ok}"
    id="payment-extra2"
    placeholder="Name AV2: XY;XYService;54321"
    {readonly}
    tabindex={readonly ? -1 : tabindex}
    type="text"
  />
  <Label
    for="payment-extra2"
    class={readonly ? 'form-control-plaintext' : ''}>
    Complément #2
  </Label>
  <div class="invalid-feedback">
    Informations complémentaire — 100 caractères au maximum.
  </div>
</FormGroup>
