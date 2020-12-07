<h2><?= $title; ?></h2>
<ul class="list-group">
	<?php foreach($categories as $category): ?>
		<li class="list-group-item d-flex justify-content-between align-items-center">
		    <div class="div">
		    	<a href="<?php echo site_url('/categories/posts/' . $category['id']); ?>">
			    	<?php echo $category['name']; ?>
		    	</a>
		    	<?php if($this->session->userdata('user_id') == $category['user_id']) : ?>
		    		<form class="cat-delete" action="categories/delete/<?php echo $category['id']; ?>" method="POST">
		    			<input type="submit" class="btn btn-link text-danger" value="[X]">
		    		</form>
		    	<?php endif; ?>
		    </div>
		    <span class="badge badge-primary badge-pill">
		    	<?php echo $category['count']; ?>
		    </span>
		  </li>
	<?php endforeach; ?>
</ul>