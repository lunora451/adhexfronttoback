<script>
  let { header, content } = $props();
</script>

<p>Hello, I'm other svelte</p>
<!-- {@render content?.()} -->
<h2>{@render header()}</h2>
<div>{@render content()}</div>
<!-- <img src={img} alt="ok" width="400" height="280" /> -->
<!-- <img src="/uploads/slider7.jpg" alt="ok" width="400" height="280" /> -->
