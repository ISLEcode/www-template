<script lang="ts">
const get_accounts = async () => {
    const response = await fetch('http://localhost/sandbox/sam/mobile/tmp/rest-2/docs/api/index.php/ledger-accounts');
    const data = await response.json();

    if (response.ok) return data;
    throw new Error(data);
}

let promise = get_accounts ();
</script>

{#await promise}
  <p>Loading...</p>
{:then data}
  {#each data as account (account.id)}
    <option value="{account.id}">{account.label}</option>
  {/each}
{:catch error}
  <p>{error}</p>
{/await}

