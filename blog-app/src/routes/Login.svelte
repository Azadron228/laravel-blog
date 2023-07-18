<script>
  import { onMount } from 'svelte';

  let email = '';
  let password = '';

  async function login() {
    const response = await fetch('/api/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ email, password })
    });

    if (response.ok) {
      // Redirect to the dashboard or any other page
      // You can use the `navigate` function from 'svelte-routing'
      // to redirect to another page in your SvelteKit app.
      // Example: import { navigate } from 'svelte-routing';
      // navigate('/dashboard');
    } else {
      // Handle login error
      const data = await response.json();
      console.log(data.message); // Display error message
    }
  }

  onMount(() => {
    // Perform any necessary initialization
  });
</script>

<main>
  <h1>Login</h1>

  <form on:submit|preventDefault={login}>
    <label>
      Email:
      <input type="email" bind:value={email} required />
    </label>

    <label>
      Password:
      <input type="password" bind:value={password} required />
    </label>

    <button type="submit">Log in</button>
  </form>
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

  form {
    display: flex;
    flex-direction: column;
  }

  label {
    margin-bottom: 1rem;
  }

  input {
    padding: 0.5rem;
    font-size: 1rem;
  }

  button {
    padding: 0.5rem 1rem;
    font-size: 1rem;
    background-color: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
  }
</style>
