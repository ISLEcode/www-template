<script lang="ts">
import rc from '../../prefs'
</script>

<option value="" selected></option>
{#each $rc.orders as order (order.id)}
  <option value="{order.id}">{order.label}</option>
{/each}


