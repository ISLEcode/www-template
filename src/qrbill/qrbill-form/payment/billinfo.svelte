<script lang="ts">
import { FormGroup, Input, Label } from 'sveltestrap5';
import { qrbill } from '../../store/qrbills'

export let readonly = false
export let tabindex = -1

let input_ok = ''

</script>

<FormGroup class="form-floating">
  <Input
    id="payment-billinfo"
    class="{input_ok}"
    type="textarea"
    bind:value={$qrbill.payment.billinfo}
    placeholder="//S1/10/10201409/11/190512/20/1400.000-53/30/106017086/31/180508/32/7.7/40/2:10;0:30"
    {readonly}
    tabindex={readonly ? -1 : tabindex}
  />
<Label
    for="payment-billinfo"
    class={readonly ? 'form-control-plaintext' : ''}>
    Donées normalisées de facturation
  </Label>
  <div class="invalid-feedback">
    Les informations structurelles de l'émetteur de factures contiennent des informations codées pour la comptabilisation
    automatisée du paiement. Les données ne sont pas transmises avec le paiement. — 140 caractères au maximum.
  </div>
</FormGroup>
