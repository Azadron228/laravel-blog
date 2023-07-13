<script>
  import { onMount } from 'svelte';
  import { writeFile } from 'fs/promises';

  let file;

  function handleFileChange(event) {
    file = event.target.files[0];
  }

  async function handleSubmit() {
    try {
      const formData = new FormData();
      formData.append('avatar', file);

      const response = await fetch('http://127.0.0.1:8000/users/update-avatar', {
        method: 'POST',
        body: formData,
      });

      if (response.ok) {
        console.log('Avatar uploaded successfully');
      } else {
        console.error('Error uploading avatar');
      }
    } catch (error) {
      console.error('Error uploading avatar', error);
    }
  }

  onMount(() => {
    // Optional: Perform any initializations or API calls on component mount
  });
</script>

<div>
  <h1>Set Avatar</h1>
  <input type="file" accept="image/*" on:change={handleFileChange} />
  <button on:click={handleSubmit}>Upload Avatar</button>
</div>

