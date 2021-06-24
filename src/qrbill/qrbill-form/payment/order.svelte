<script lang="ts">
import { FormGroup, Input, Label } from 'sveltestrap5';
import { qrbill } from '../../store/qrbills'
import Orders    from '../options/orders.svelte';

export let disabled = false
export let tabindex = -1

let input_ok = ''

</script>

{#if !$qrbill.payment.splitorders}
  <FormGroup class="form-floating">
    <Input
      bind:value={$qrbill.payment.order}
      class="{input_ok}"
      {disabled}
      id="payment-order"
      tabindex={disabled ? -1 : tabindex}
      type="select">
      <Orders />
    </Input>
    <Label
      for="payment-order"
      class={disabled ? 'form-control-plaintext' : ''}>
      Mandat
    </Label>
    <div class="invalid-feedback"></div>
  </FormGroup>
{/if}

