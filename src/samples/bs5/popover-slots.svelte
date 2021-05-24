<script lang="ts">
  import { Button, Popover } from 'sveltestrap5';
</script>

<Button id="btn">Click me</Button>
<Popover placement="right" target="btn">
  <div slot="title">
    <i>Hello</i> <b>World!</b>
  </div>
  This Popover has HTML in the title passed as a slot.
</Popover>
