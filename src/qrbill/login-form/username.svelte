<script lang="ts">
import { FormGroup, Input, Label } from 'sveltestrap5';
import rc from '../prefs'

export let tabindex = -1
export let validity = ''

let focused = false;
</script>

<FormGroup class = "form-floating">
  <Input
    bind:value   = {$rc.user.name}
    class        = {validity}
    id           = "name"
    on:blur      = {() => (focused  = false)}
    on:change    = {() => (validity = '')}
    on:focus     = {() => (focused  = true)}
    placeholder  = "Votre nom d'utilisateur"
    required
    tabindex     = {tabindex}
    type         = "text"
  />
  <Label for     = "name">Nom</Label>
</FormGroup>

