<script>
	import { onMount } from 'svelte';
	import { Card } from 'flowbite-svelte';
	let hCard = false;

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
  
<div>{result}</div>
<div class="grid grid-cols-2 gap-4 container mx-auto">
	{#if data}
		{#each data as post (post.id)}
			<Card
				img="https://flowbite-svelte.com/images/image-1.webp"
				href="/"
				horizontal
				reverse={hCard}
			>
				<h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
					{post.title}
				</h5>
				<p class="mb-3 font-normal text-gray-700 dark:text-gray-400 leading-tight">
					{post.content}
				</p>
				<h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
					{post.author_id}
				</h5>
			</Card>
		{/each}
	{:else if error}
		<p>{error}</p>
	{:else}
		<p>Loading...</p>
	{/if}
</div>
