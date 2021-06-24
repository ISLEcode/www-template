<script lang="ts">
import { FormGroup, Input, Label } from 'sveltestrap5';
import { qrbill } from '../../store/qrbills'

export let disabled = false;
export let tabindex = -1

let input_ok = ''

// Disable this switch if we are creating a new supplier
$: disabled = ($qrbill .creditor .id == 0)

</script>

<FormGroup>
  <Input
    aria-label="Checkbox to update creditor's details in SAMinfo"
    bind:checked={$qrbill.creditor.update}
    class="form-check form-switch"
    id="payment-creditor-update"
    {disabled}
    tabindex={tabindex}
    type="checkbox"
  />
  <Label
    for="payment-creditor-update"
    class={disabled ? 'form-control-plaintext' : ''}>
    Mise à jour
  </Label>
  <div class="invalid-feedback"></div>
</FormGroup>
