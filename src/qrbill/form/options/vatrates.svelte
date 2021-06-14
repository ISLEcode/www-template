<script lang="ts">
import rc from '../../prefs'
</script>

{#each $rc.vatcodes as vat (vat.id)}
  <option value="{vat.id}">{vat.id}. {vat.label}</option>
{/each}

