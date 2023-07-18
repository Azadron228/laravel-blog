<script>
  let image;
  let title;
  let content;
  let user_id;

  async function handleSubmit() {
    const postData = {
      image,
      title,
      content,
      user_id
    };

    try {
      const response = await fetch('127.0.0.1:8000/posts', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(postData)
      });

      if (response.ok) {
        // Reset form fields after successful submission
        image = null;
        title = '';
        content = '';
        user_id = '';
      } else {
        throw new Error('Failed to create post');
      }
    } catch (error) {
      console.error('Error creating post:', error);
    }
  }
</script>

<main>
  <h1>Create Post</h1>

  <form on:submit|preventDefault={handleSubmit}>
    <div>
      <label for="image">Image:</label>
      <input type="file" id="image" bind:this={image} required accept="image/*">
    </div>

    <div>
      <label for="title">Title:</label>
      <input type="text" id="title" bind:value={title} required>
    </div>

    <div>
      <label for="content">Content:</label>
      <textarea id="content" bind:value={content} required></textarea>
    </div>

    <div>
      <label for="user_id">User ID:</label>
      <input type="text" id="user_id" bind:value={user_id} required>
    </div>

    <button type="submit">Create Post</button>
  </form>
</main>

<style>
  form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    max-width: 400px;
  }
</style>

