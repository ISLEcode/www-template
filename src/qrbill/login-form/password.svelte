<script lang="ts">
import { FormGroup, Input, Label } from 'sveltestrap5';
import rc from '../prefs'

export let tabindex = -1
export let validity = ''

let focused = false;

</script>

<FormGroup class = "form-floating">
  <Input
    bind:value   = {$rc.user.password}
    class        = {validity}
    id           = "password"
    on:blur      = {() => (focused  = false)}
    on:change    = {() => (validity = '')}
    on:focus     = {() => (focused  = true)}
    placeholder  = "Votre mot de passe"
    required
    tabindex     = {tabindex}
    type         = "password"
  />
  <Label for     = "password">Mot de passe</Label>
  <div class     = "invalid-feedback">Veuillez vérifier votre nom et mot de passe</div>
  <div class     = "valid-feedback">Authentification réussie<br>Bienvenu {$rc.user.fullname} (<tt>{$rc.user.name}</tt></div>
</FormGroup>

