<script lang="ts">
import rc from '../../prefs'
</script>

<option value="0" selected></option>
{#each $rc.ledger as account (account.id)}
  <option value="{account.id}">{account.label}</option>
{/each}

