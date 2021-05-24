<script lang="ts">
  import { ListGroup, ListGroupItem } from 'sveltestrap5';
  const colors = [
    'primary',
    'secondary',
    'success',
    'danger',
    'warning',
    'info',
    'light',
    'dark'
  ];
</script>

<ListGroup>
  {#each colors as color}
    <ListGroupItem {color}>{color}</ListGroupItem>
  {/each}
</ListGroup>
