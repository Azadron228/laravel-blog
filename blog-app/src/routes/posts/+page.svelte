<script>
	import { onMount } from 'svelte';
	// import './post.css';
	import './post.css';

	let data;
	let error;
	let title;
	let result;

	onMount(async () => {
		try {
			const response = await fetch('http://127.0.0.1:8000/posts');
			if (response.ok) {
				data = await response.json();
				result = JSON.stringify(data, null, 2); // Extract the title property from data
			} else {
				error = `Error: ${response.status}`;
			}
		} catch (err) {
			error = 'An error occurred while fetching the data.';
		}
	});
</script>

<div>
  {#if data}
    {#each data as post (post.id)}
      <div class="post">
        <h1 class="title">{post.title}</h1>
        <p class="content">{post.content}</p>
        <p class="author">Author: {post.author_name}</p>
      </div>
    {/each}
  {:else if error}
    <p>{error}</p>
  {:else}
    <p>Loading...</p>
  {/if}
</div>
