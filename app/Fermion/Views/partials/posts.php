<?php foreach($posts as $post): ?>
	<div class="panel panel-default post col-md-5" onclick="location.href='/post/<?php echo $post['slug'] ?>'">
		<div class="panel-body">
	
			<h5 class="text-uppercase">
				<strong><?php echo \Fermion\App::get('helper')->excerpt(strip_tags($post['title']), 35) ?></strong>
			</h5>
			
			<div class="teaser">
				<?php echo \Fermion\App::get('helper')->excerpt(strip_tags($post['content']), 165) ?>
			</div>
			
			<p class="details col-xs-12">
				<span class="col-xs-6"><strong><em><small>written by </small><?php echo $post['author'] ?></em></strong></span>
				<span class="date col-xs-5"><strong><?php echo date('j F Y', strtotime($post['date'])) ?></strong></span>
			</p>
		</div>
	</div>
	
<?php endforeach; ?>