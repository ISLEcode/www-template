<script lang="ts">
import { countries } from '../../store/countries';
export let selected = 'CH';
</script>

{#each $countries as country (country.id)}
  <option id="{country.alpha2}" selected={country.alpha2 == selected}>{country.label}</option>
{/each}
