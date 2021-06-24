<script lang="ts">
import { FormGroup, Input, Label } from 'sveltestrap5';
import { qrbill } from '../../store/qrbills'

export let readonly = false
export let tabindex = -1

let input_ok = ''

</script>

<FormGroup class="form-floating">
  <Input
    id="payment-reference"
    class="{input_ok}"
    type="text"
    bind:value={$qrbill.payment.reference}
    placeholder=""
    {readonly}
    tabindex={readonly ? -1 : tabindex}
  />
  <Label
    for="payment-reference"
    class={readonly ? 'form-control-plaintext' : ''}>
    Numéro de référence
  </Label>
  <div class="invalid-feedback">
    Référence de paiement structurée — La référence est soit une référence QR, soit une référence bénéficiaire (ISO 11649)
    — 27 caractères alphanumériques au maximum
    — Doit être rempli en cas d'utilisation d'un QR-IBAN
    — Référence QR: calcul du chiffre de contrôle selon modulo 10 récursif (27e position de la référence).
    — Référence bénéficiaire (ISO 11649): jusqu'à 25 caractères alphanumériques.
    — L'élément ne doit pas être rempli pour le type de référence NON."
  </div>
</FormGroup>
