<script>
  import { onMount } from 'svelte';
  import { session } from '$app/stores';

  let user = null;

  onMount(async () => {
    try {
      const response = await fetch('http://127.0.0.1:8000/profile', {
        headers: {
          'Authorization': `Bearer ${$session.token}`
        }
      });

      if (response.ok) {
        const data = await response.json();
        user = data.user;
      } else {
        console.error('Failed to fetch user data');
      }
    } catch (error) {
      console.error('Error:', error);
    }
  });
</script>

<main>
  {#if user}
    <h1>Profile</h1>

    <p>
      <strong>Name:</strong> {name}
    </p>

    <p>
      <strong>Email:</strong> {email}
    </p>
  {:else}
    <p>Loading...</p>
  {/if}
</main>

<style>
  main {
    max-width: 400px;
    margin: 0 auto;
    padding: 2rem;
  }

  h1 {
    text-align: center;
    margin-bottom: 2rem;
  }

  p {
    margin-bottom: 1rem;
  }
</style>
