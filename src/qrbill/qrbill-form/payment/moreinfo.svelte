<script lang="ts">
import { FormGroup, Input, Label } from 'sveltestrap5';
import { qrbill } from '../../store/qrbills'

export let readonly = false
export let tabindex = -1

let input_ok = ''

</script>

<FormGroup class="form-floating">
  <Input
    bind:value={$qrbill.payment.moreinfo}
    class="{input_ok}"
    id="payment-moreinfo"
    placeholder="Instructions du 03.04.2021"
    tabindex={readonly ? -1 : tabindex}
    type="textarea"
    {readonly}
  />
  <Label
    for="payment-moreinfo"
    class={readonly ? 'form-control-plaintext' : ''}>
    Informations supplémentaires
  </Label>
  <div class="invalid-feedback">
    Les informations non structurées peuvent être utilisées pour l'indication d'un motif de paiement ou pour des informations
    textuelles complémentaires au sujet de paiements avec référence structurée. — 140 caractères au maximum
  </div>
</FormGroup>

