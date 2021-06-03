<script lang="ts">
import { Button, Icon, Modal, ModalBody, ModalFooter, ModalHeader } from 'sveltestrap5';
let open = false;
const toggle = () => (open = !open);
</script>

<Button color="danger" on:click={toggle}>Open Modal</Button>
<Modal isOpen={open} {toggle}>
  <ModalHeader {toggle}>
    <Icon name="code-slash" style="font-size: 6rem;" />
    Données brutes du QR code
  </ModalHeader>
  <ModalBody>
    <FormGroup>
      <Label for="qrdata">Donées brutes</Label>
      <Input id="qrdata" type="textarea" name="text" readonly="readonly" rows="34" wrap="soft" />
    </FormGroup>
  </ModalBody>
  <ModalFooter>
    <Button color="primary" on:click={toggle}>Do Something</Button>
    <Button color="secondary" on:click={toggle}>Cancel</Button>
  </ModalFooter>
</Modal>
