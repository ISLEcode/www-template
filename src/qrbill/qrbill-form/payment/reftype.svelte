<script lang="ts">
import { FormGroup, Input, Label } from 'sveltestrap5';
import { qrbill } from '../../store/qrbills'

export let disabled = false
export let tabindex = -1

let input_ok = ''

</script>

<FormGroup class="form-floating">
  <Input
    bind:value={$qrbill.payment.reftype}
    class="{input_ok}"
    id="payment-reftype"
    placeholder="Type de référence"
    {disabled}
    tabindex={disabled ? -1 : tabindex}
    type="select">
    <option value="QRR">Référence QR</option>
    <option value="SCOR">Référence bénéficiaire</option>
    <option value="NON">Sans référence</option>
  </Input>
  <Label
    for="payment-reftype"
    class={disabled ? 'form-control-plaintext' : ''}>
    Type de référence
  </Label>
  <div class="invalid-feedback">
    Les codes suivants sont admis: QRR (référence QR),  SCOR (référence bénéficiaire, ISO 11649), et NON (sans référence).
    — Quatre caractères au maximum
    — En cas d'utilisation d'un QR-IBAN, doit contenir le code QRR
    — En cas d'utilisation de l'IBAN, il est possible d'indiquer soit le code SCOR, soit le code NON.
  </div>
</FormGroup>
