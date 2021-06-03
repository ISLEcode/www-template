<script lang="ts">
const get_vatrates = async () => {
    const response = await fetch('http://localhost/sandbox/sam/mobile/tmp/rest-2/docs/api/index.php/vatrates');
    const data = await response.json();

    if (response.ok) return data;
    throw new Error(data);
}

let promise = get_vatrates ();
</script>

{#await promise}
  <p>Loading...</p>
{:then data}
  {#each data as vat (vat.id)}
    <option value="{vat.id}">{vat.name} ({vat.rate}%)</option>
  {/each}
{:catch error}
  <p>{error}</p>
{/await}

