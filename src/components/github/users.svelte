<script lang="ts">
import { Styles, Col, Row } from 'sveltestrap5';

async function getUsers() {
    const res = await fetch('https://api.github.com/users');
    const users = await res.json();

    console.log ('the users', users);

    if (res.ok) return users;
    throw new Error (users);

}

$: allUsersPromise = getUsers();
</script>

<section>
  {#await allUsersPromise then users}
    {#each users as user}
      <Row>
        <Col>
          <img class="rounded-full w-12" src={user.avatar_url} alt="avatar" />
          <p class="my-auto font-semibold ml-2">{user.login}</p>
        </Col>
      </Row>
    {/each}
  {/await}
</section>
