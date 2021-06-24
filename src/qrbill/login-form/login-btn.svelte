<script lang="ts">
import { Button, FormGroup } from 'sveltestrap5'

export let tabindex = -1

let input_ok   = ''
let disabled   = false
let error      = ''
let response   = null
let welcome    = ''

</script>

<FormGroup class = "form-floating">
  <Button
    color        = success
    {disabled}
    outline
    size         = lg
    tabindex     = {tabindex}
    type         = submit>
    Connexion
  </Button>
</FormGroup>
