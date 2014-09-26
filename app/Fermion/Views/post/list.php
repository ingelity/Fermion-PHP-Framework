<div class="search well light col-md-8">
   <h1>All the latest news on bab.la.</h1> 
   <h4>Search for the topic of your interest.</h4>

   <div class="searchBox">
		<input type="text" id="search" class="form-control" placeholder="type search keywords here" 
			data-url="<?php echo SITE_URL ?>/post-search" 
			data-csrf="<?php echo \Fermion\App::get('config')['csrf'] ?>">
		<img src="<?php echo SITE_URL ?>/img/keyboard.png" id="keyboardInputImg">
		<button type="button" class="btn btn-primary" id="searchBtn">Search</button>
	</div>
</div>

<div class="col-md-8">
	<a class="btn btn-default" href="<?php echo SITE_URL; ?>/post-new">Create News</a>
</div>

<div class="page-header">
  <h2 class="col-md-8 posts-list-headline">Latest news <small>click on any to read more</small></h2>
</div>

<ul id="postsList" class="col-md-12" 
	data-count-url="<?php echo SITE_URL ?>/post-count" 
	data-load-url="<?php echo SITE_URL ?>/post-load">
	
	<?php \Fermion\App::get('response')->render('partials/posts', false, ['posts' => $posts]) ?>
</ul>