<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//dd($filter);
?>
<div class="single-page-header bg-site">
	<div class="container">		
		<h1 class="text-center"><?php D($cms->title); ?></h1>
	</div>
</div>
<section class="section">
	<div class="container">
    	<?php D(html_entity_decode($cms->content)); ?>
    </div>
</section>