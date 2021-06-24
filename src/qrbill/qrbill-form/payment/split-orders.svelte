<script lang="ts">
import { FormGroup, Input, Label } from 'sveltestrap5';
import { qrbill } from '../../store/qrbills'

export let visible = false
export let tabindex = -1

let input_ok = ''

</script>

{#if visible}
  <FormGroup class="form-floating">
    <Input
      bind:checked={$qrbill.payment.splitorders}
      id="payment-multiple-orders"
      label="Ventiler par mandats"
      tabindex={tabindex}
      type="checkbox"
    />
  </FormGroup>
{/if}
