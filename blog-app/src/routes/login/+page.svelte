<script>
  let email = '';
  let password = '';

  async function handleSubmit() {
    const response = await fetch('http://127.0.0.1:8000/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ email, password })
    });

    if (response.ok) {
      // Redirect or show success message
      console.log('Login successful!');
    } else {
      // Show error message
      console.log('Login failed!');
    }
  }
</script>

<main>
  <h1>Login</h1>

  <form on:submit|preventDefault={handleSubmit}>
    <label>
      Email:
      <input type="email" bind:value={email} required />
    </label>

    <label>
      Password:
      <input type="password" bind:value={password} required />
    </label>

    <button type="submit">Login</button>
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
  }

  form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }

  input {
    padding: 0.5rem;
    font-size: 1rem;
  }

  button {
    padding: 0.5rem 1rem;
    font-size: 1rem;
  }
</style>

