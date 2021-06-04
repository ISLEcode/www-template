<script lang="ts">
import { Icon, Collapse, Navbar, NavbarToggler, NavbarBrand, Nav, NavItem, NavLink } from 'sveltestrap5';
import { Dropdown, DropdownToggle, DropdownMenu, DropdownItem, Input } from 'sveltestrap5';
import { qrbill } from '../store/qrbills';
// import { user } from './store.ts';

let isOpen = false;
let user = 'pmamin';
const toggle = () => (isOpen = !isOpen);
function handleUpdate(event) { isOpen = event.detail.isOpen; }

// let user;
// if you uncomment next line, NavBar does NOT disappear after logout
//const unUser = User.subscribe(v => user = v);

</script>
<Navbar color="light" light expand="md">
  <NavbarBrand href="/">
    <a class="navbar-brand" href="qrbill.html">
      <img src="zip/app/img/saminfo-logo.png" alt="SAMinfo logo" height="32">
    </a>
    </NavbarBrand>
  <NavbarToggler on:click={() => (isOpen = !isOpen)} />
  <Collapse {isOpen} navbar expand="md" on:update={handleUpdate}>
    <Nav class="ms-auto" navbar>
      <NavItem>
        <NavLink href="https://isle-cloud.ch/saminfo">ERP</NavLink>
      </NavItem>
      <Dropdown nav inNavbar>
        <DropdownToggle nav caret><Icon name="person-fill"/> {user}</DropdownToggle>
        <DropdownMenu end>
          <DropdownItem>
            <Input type="checkbox" bind:checked={$qrbill.ux.show_devtab} label="Mode expert"/>
          </DropdownItem>
          <DropdownItem divider />
          <DropdownItem>Se déconnecter</DropdownItem>
        </DropdownMenu>
      </Dropdown>
    </Nav>
  </Collapse>
</Navbar>
