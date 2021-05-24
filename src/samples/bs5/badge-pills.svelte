<script lang="ts">
  import { Badge } from 'sveltestrap5';

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

{#each colors as color}
  <div>
    <Badge pill {color}>{color}</Badge>
  </div>
{/each}
