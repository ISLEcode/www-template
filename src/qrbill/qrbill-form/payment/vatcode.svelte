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
    bind:value={$qrbill.payment.vatcode}
    class="{input_ok}"
    {disabled}
    id="payment-vatcode"
    tabindex={disabled ? -1 : tabindex}
    type="select">
    <VATRates />
  </Input>
  <Label
    for="payment-vatcode"
    class={disabled ? 'form-control-plaintext' : ''}>
    TVA
  </Label>
  <div class="invalid-feedback"></div>
</FormGroup>
