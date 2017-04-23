<?php get_header(); ?>
	
	<div class="jumbotron">
      <div class="container">
        <h1>Berichten</h1>
      </div>
    </div>

<div class="container">
	
  <div class="row">
    <div class="col-8">
	
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post();

			get_template_part( 'content', get_post_format() );

		endwhile; ?>
		
		<nav>
			<ul class="pager">
				<li><?php next_posts_link( 'Vorige' ); ?>- Vori</li>
				<li><?php previous_posts_link( 'Volgende' ); ?>- Volg</li>
			</ul>
		</nav>
		
		<?php endif; ?>

    </div>
    <div class="col">

<?php get_sidebar(); ?>

    </div>
  </div>
</div>

<?php get_footer(); ?>