<script lang="ts">
const get_orders = async () => {
    const response = await fetch('http://localhost/sandbox/sam/mobile/tmp/rest-2/docs/api/index.php/orders');
    const data = await response.json();

    if (response.ok) return data;
    throw new Error(data);
}

let promise = get_orders ();
</script>

{#await promise}
  <p>Loading...</p>
{:then data}
  {#each data as order (order.id)}
    <option value="{order.id}">{order.label}</option>
  {/each}
{:catch error}
  <p>{error}</p>
{/await}

