<script lang="ts">
import { FormGroup, Input, Label } from 'sveltestrap5';
import { qrbill } from '../../store/qrbills'
import VATRates from '../options/vatrates.svelte';

export let disabled = false
export let tabindex = -1

let input_ok = ''

</script>

<FormGroup class="form-floating">
  <Input
    id="payment-currency"
    {disabled}
    class="{input_ok}"
    bind:value={$qrbill.payment.currency}
    placeholder="Devise"
    tabindex={disabled ? -1 : tabindex}
    type="select">
    <option>CHF</option>
    <option>EUR</option>
  </Input>
  <Label
    for="payment-currency"
    class={disabled ? 'form-control-plaintext' : ''}>
    Devise
  </Label>
  <div class="invalid-feedback">
    Monnaie du paiement, code monétaire alphabétique à trois positions selon ISO 4217 — Seuls CHF et EUR sont admis.
  </div>
</FormGroup>
