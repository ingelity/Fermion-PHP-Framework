<?php if(empty($post)): ?>
	<h2>Create a news</h2>
<?php else: ?>
	<h2>Edit the news</h2>
<?php endif; ?>

<form action="<?php echo empty($post['id']) ? SITE_URL.'/post-save' : SITE_URL.'/post-update/'.$post['id'] ?>" method="post"> 
	<input type="hidden" name="csrf" value="<?php echo \Fermion\App::get('config')['csrf'] ?>">
	
	<div class="row form-group">
		<div class="col-md-3">
			<label>Title</label>
			<input type="text" name="title" class="form-control" value="<?php if(!empty($post['title'])) echo $post['title'] ?>" required>
		</div>
	</div>
	
	<div class="row form-group">
		<div class="col-md-3">
			<label>Author</label>
			<input type="author" name="author" class="form-control" value="<?php if(!empty($post['author'])) echo $post['author'] ?>" required>
		</div>
	</div>
	
	<div class="row form-group">
		<div class="col-md-3">
			<label>Date</label>
			<input type="text" name="date" id="date" class="form-control" value="<?php if(!empty($post['date'])) echo $post['date'] ?>" required>
		</div>
	</div>
	
	<div class="row form-group">
		<div class="col-md-6">
			<label>Content</label>
			<textarea class="form-control" name="content" rows="9" required><?php if(!empty($post['content'])) echo $post['content'] ?></textarea>
		</div>
	</div>
	
	<div class="row form-group">
		<div class="col-md-2">
			<button type="submit" class="btn btn-primary col-xs-12">Preview</button>
		</div>
	</div>
</form>