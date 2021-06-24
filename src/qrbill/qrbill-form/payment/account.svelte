<script lang="ts">
import { FormGroup, Input, Label } from 'sveltestrap5';
import { qrbill } from '../../store/qrbills'
import LedgerAccount from '../options/ledger-accounts.svelte';

export let disabled = false
export let tabindex = -1

$: disabled = ($qrbill.creditor.multiaccounts == 1)

let input_ok = ''

</script>

{#if !$qrbill.payment.splitaccounts}
  <FormGroup class="form-floating">
    <Input
      bind:value={$qrbill.payment.account}
      class="{input_ok}"
      {disabled}
      id="payment-account"
      tabindex={disabled ? -1 : tabindex}
      type="select">
      <LedgerAccount />
    </Input>
    <Label
      for="payment-account"
      class={disabled ? 'form-control-plaintext' : ''}>
      Compte
    </Label>
    <div class="invalid-feedback"></div>
  </FormGroup>
{/if}
