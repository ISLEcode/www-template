<script lang="ts">
import { FormGroup, Input, Label } from 'sveltestrap5';
import rc from '../prefs'

export let tabindex = -1
export let readonly = true

let focused = false;
let input_ok = ''

</script>

<FormGroup class = "form-floating">
  <Input
    bind:value   = {$rc.user.database}
    id           = "database"
    on:blur      = {() => (focused = false)}
    on:focus     = {() => (focused = true)}
    placeholder  = "Votre compte SAMinfo"
    {readonly}
    required
    tabindex={readonly ? -1 : tabindex}
    type         = "text"
  />
  <Label
    for          = "database"
    class        = {readonly ? 'form-control-plaintext' : ''}>
    Compte
  </Label>
  <div class     = "invalid-feedback">Required</div>
</FormGroup>

