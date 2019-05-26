<?php /* Template Name: Homepage */ ?>
<?php require_login(); ?>
<?php get_header(); ?>

<?php if ( have_posts() ) :  ?>

<div class="hero-unit-home">

  <?php while ( have_posts() ) : the_post(); the_content(); endwhile;  ?>

</div>

<?php endif; ?>

<!-- Example row of columns -->
<div class="row">

  <div class="span8">

    <div class="message span8">
      <div class="message-header">
        <h3>Recente gebeurtenisen</h3>
      </div>
      <div class="stream-body">

        <?php $posts = get_posts(array(
				'posts_per_page'	=> 25,
					'orderby'     => 'modified',
							'order' => 'DESC',
				'post_type'			=> 'any'
			)); if( $posts ): ?>

        <!-- hier -->

        <?php foreach( $posts as $post ): setup_postdata( $post ); ?>

        <?php if ( get_post_type( get_the_ID() ) == 'bewoners' ) { ?>
        <div class="stream-item">
          <div class="stream-item-body small">
            <i class="icon-user"></i> Het profiel van <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> is
            aangepast op <?php the_modified_date(''); ?> om <?php the_modified_date('H:i'); ?>
          </div>
        </div>
        <?php } ?>

        <?php if ( get_post_type( get_the_ID() ) == 'documentatie' ) { ?>
        <div class="stream-item">
          <div class="stream-item-body small">
            <i class="icon-file"></i> Het document <a href="<?php the_permalink(); ?>">
              <?php
									$title = get_the_title();
									echo mb_strimwidth($title, 0, 40, '...');
									?>
            </a> is aangepast op <?php the_modified_date('j F'); ?> om <?php the_modified_date('H:i'); ?>
          </div>
        </div>
        <?php } ?>

        <?php if ( get_post_type( get_the_ID() ) == 'berichten' ) { ?>

        <?php if ( get_the_modified_date() == get_the_date() ) {  /* Als het bericht nieuw is */  ?>
        <div class="stream-item">
          <div class="stream-item-body small">
            <i class="icon-bullhorn"></i> Het bericht <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> is
            geplaatst op <?php the_modified_date(''); ?> om <?php the_modified_date('H:i'); ?>
          </div>
        </div>
        <?php } else {  /* Als het bericht is aangepast */  ?>
        <div class="stream-item">
          <div class="stream-item-body small">
            <i class="icon-bullhorn"></i> Het bericht <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> is
            aangepast op <?php the_modified_date(''); ?> om <?php the_modified_date('H:i'); ?>
          </div>
        </div>
        <?php } ?>

        <?php } ?>

        <?php if ( get_post_type( get_the_ID() ) == 'agenda' ) { ?>

        <?php if ( get_the_modified_date('c') == get_the_date('c') ) {  /* Als het bericht nieuw is */  ?>
        <div class="stream-item">
          <div class="stream-item-body small">
            <i class="icon-calendar"></i> De activiteit <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> is
            aangemaakt op <?php the_modified_date(''); ?> om <?php the_modified_date('H:i'); ?>
          </div>
        </div>
        <?php } else {  /* Als het bericht is aangepast */  ?>
        <div class="stream-item">
          <div class="stream-item-body small">
            <i class="icon-calendar"></i> De activiteit <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> is
            aangepast op <?php the_modified_date(''); ?> om <?php the_modified_date('H:i'); ?>
          </div>
        </div>
        <?php } ?>

        <?php } ?>

        <?php endforeach; ?>

        <!-- hier -->

        <?php wp_reset_postdata(); ?>

        <?php endif; ?>

        <!-- End All Posts -->

      </div>
    </div>
  </div>

  <div class="span4">

    <?php /* Start Agenda */


// find date time now
$date_now = date('Y-m-d H:i:s');
$time_now = strtotime($date_now);


// find date time in 4 weeks
$time_next_week = strtotime('+4 week', $time_now);
$date_next_week = date('Y-m-d H:i:s', $time_next_week);


// query events
$posts = get_posts(array(
	'posts_per_page'	=> 100,
	'post_type'			=> 'agenda',
	'meta_query' 		=> array(
		'relation'		=> 'AND',
		array(
			'key'			=> 'type',
			'compare'		=> '!=',
			'value'			=> 'pr-prive'
		),
		array(
			'key'			=> 'start',
			'compare'		=> 'BETWEEN',
			'value'			=> array( $date_now, $date_next_week ),
			'type'			=> 'DATETIME'
		)
	),
	'order'				=> 'ASC',
	'orderby'			=> 'meta_value',
	'meta_key'			=> 'start',
	'meta_type'			=> 'DATETIME'
));

	if( $posts ): ?>

    <div class="message span4">
      <div class="message-header">
        <h3>Agenda</h3>
      </div>
      <div class="message-body">
        <ul class="overview">

          <?php foreach( $posts as $post ): setup_postdata( $post ); ?>

          <li>
            <i class="icon-calendar"></i>
            <b><?php the_title() ?>
              <?php if ( get_field('type') == "Reservering 't Klophuis - Openbaar"): ?>
              - <?php the_author_firstname( $post->post_author ); ?>
              <?php endif ?>
            </b><br />

            <?php
									$datestart = get_field('start', false, false);
									$datestartday = date_i18n("j F", strtotime($datestart));
									$datestarttime = date_i18n("H:i", strtotime($datestart));

									$dateend = get_field('einde', false, false);
									$dateendday = date_i18n("j F", strtotime($dateend));
									$dateendtime = date_i18n("H:i", strtotime($dateend));
									?>

            <?php echo $datestartday; ?> van <?php echo $datestarttime; ?> tot <?php echo $dateendtime; ?><br>

          </li>

          <?php endforeach; ?>

        </ul>
      </div>
      <div class="message-footer">
        <a href="/agenda">Bekijk alle agenda items</a>
      </div>
    </div>

    <?php wp_reset_postdata(); ?>

    <?php endif;    /* Einde Agenda */  ?>

    <?php /* Start Nieuwe bewoners */
		$args = array(
		'number' => 5,
				'order'     => 'DESC',
				'meta_key' => 'bewoner_sinds',
				'orderby'   => 'meta_value', //or 'meta_value_num'
			'meta_query' => array(
				'relation' => 'AND',
					array(
						'key'     => 'status_in_expressionengine',
						'value'   => 'Ingeschreven',
						'compare' => '='
					)
			)
			);
		$wp_user_query = new WP_User_Query( $args );

		// Get the results
		$authors = $wp_user_query->get_results();

		// Check for results
		if ( ! empty( $authors ) ) { ?>

    <div class="message span4">
      <div class="message-header">
        <h3>Nieuwe bewoners</h3>
      </div>
      <div class="message-body">

        <?php // loop through each author
				foreach ( $authors as $author ) {
						// get all the user's data
						$author_info = get_userdata( $author->ID ); ?>

        <div class="float-member-home first">

          <div class="member-image">
            <img src="<?php echo get_field('resident_profile_image', $author_info)['sizes']['thumbnail']; ?>" width="40"
              height="40" alt="" />
          </div>
          <div class="member-details">
            <?php echo $author_info->first_name; ?> <?php echo $author_info->last_name; ?><br />
            <div class="member-details-meta"><?php the_field( 'bewoner_sinds', $author_info ); ?> -
              <span><?php the_field( 'resident_unit', $author_info ); ?></span></div>
          </div>
        </div>

        <?php } ?>

      </div>
      <div class="message-footer">
        <a href="/bewoners">Bekijk alle bewoners</a>
      </div>
    </div>

    <?php } else {
			echo 'Geen bewoners gevonden';
	}
	/* Einde Nieuwe bewoners */  ?>

    <div>

    </div>

  </div>
</div>

<?php get_footer(); ?>