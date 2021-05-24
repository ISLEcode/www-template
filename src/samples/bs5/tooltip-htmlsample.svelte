<script lang="ts">
  import { Button, Tooltip } from 'sveltestrap5';
</script>

<div>
  <Button id="btn-right-html">HTML right</Button>
  <Tooltip target="btn-right-html" placement="right">
    <strong>Hello</strong> <i>World</i>!
  </Tooltip>
</div>