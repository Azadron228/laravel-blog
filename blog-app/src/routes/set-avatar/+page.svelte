<script>
  import { onMount } from 'svelte';

  let avatarFile;

  async function handleSubmit(event) {
    event.preventDefault();

    const formData = new FormData();
    formData.append('avatar', avatarFile);

    try {
      const response = await fetch('http://192.168.217.219:8000/set-avatar', {
        method: 'POST',
        body: formData,
      });

      if (response.ok) {
        console.log('Avatar uploaded successfully!');
      } else {
        console.error('Avatar upload failed.');
      }
    } catch (error) {
      console.error('An error occurred:', error);
    }
  }

  onMount(() => {
    // You can perform additional setup tasks here if needed
  });
</script>

<main>
  <h1>Upload Avatar</h1>

  <form on:submit={handleSubmit}>
    <input type="file" bind:this={avatarFile} accept="image/*" required />
    <button type="submit">Upload</button>
  </form>
</main>

<style>
  /* Add your custom styles here */
</style>

