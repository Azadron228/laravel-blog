<script>
  import { onMount } from 'svelte';
  import '.[id]/post.css';
  let postId = 10; // Replace with the desired post ID
  let post;
  let error;
  let data;

  onMount(async () => {
    try {
      const response = await fetch(`http://127.0.0.1:8000/posts/${postId}`);
      if (response.ok) {
        data = await response.json();
        post = data.original;
      } else {
        error = `Error: ${response.status}`;
      }
    } catch (err) {
      error = 'An error occurred while fetching the data.';
    }
  });
</script>


<div>
  {#if post}
    <h1>{post.title}</h1>
    <p>{post.content}</p>
    <p>Author: {post.author_name}</p>
  {:else if error}
    <p>{error}</p>
  {:else}
    <p>Loading...</p>
  {/if}
</div>


