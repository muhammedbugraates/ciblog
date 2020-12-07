<h2><?= $title ?></h2>
<?php foreach($posts as $post): ?>
	<h3><?php echo $post['title']; ?></h3>
	<div class="row mb-4">
		<div class="col-md-3">
			<img class="post-thumb" src="<?php echo site_url() ?>assets/images/posts/<?php echo $post['post_image']; ?>">
		</div>
		<div class="col-md-9">
			<small class="text-muted">Posted on: <?php echo $post['created_at']; ?> in <strong><?php echo $post['name']; ?></strong></small>
			<?php echo word_limiter($post['body'], 60); ?><br><br>
			<p><a class="btn btn-secondary" href="<?php echo site_url('/posts/' . $post['slug']); ?>">Read More</a></p>
		</div>
	</div>
<?php endforeach; ?>
<div class="pagination-container">
		<?php echo $this->pagination->create_links(); ?>
</div>

