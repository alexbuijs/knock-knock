
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

   <?php wp_head(); ?>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php bloginfo('template_directory');?>/asset/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php bloginfo('template_directory');?>/asset/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php bloginfo('template_directory');?>/asset/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo('template_directory');?>/asset/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php bloginfo('template_directory');?>/asset/ico/apple-touch-icon-57-precomposed.png">

    <script src="<?php bloginfo('template_directory');?>/js/jquery.js"></script>

  </head>

  <body data-spy="scroll" data-target=".subnav" data-offset="50">

	<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?> 

		<div id="topNav">
			<div>
				<ul>
					<li><a href="/">Klovaart Website</a> - <a href="/intranet/">Klovaart Intranet</a></li>
				</ul>
				<p id="userNav"><a href="<?php echo get_edit_post_link( $id, $context ); ?> ">Bewerken</a></p>
			</div>
		</div>


	<?php } ?>

  <!-- Navbar
    ================================================== -->
    <div class="navbar navbar-fixed-top first" style=" z-index: 20;">
      <div class="navbar-inner">
        <div class="container">
			<a class="brand" href="<?php bloginfo( 'wpurl' );?>"><?php echo get_bloginfo( 'name' ); ?></a>

			<?php if ( is_user_logged_in() ) { ?>

            <ul class="nav pull-right">
			  <li class="dropdown">
			    <a href="#"
			          class="dropdown-toggle"
			          data-toggle="dropdown">
			          <?php echo get_option('say_hello'); ?>
			 
					<?php $current_user = wp_get_current_user();
				    	echo $current_user->display_name;
					?>
			          <b class="caret"></b>
			    </a>
			    <ul class="dropdown-menu">
				<?php /*
	                <li><a href="/">Nog niet beschikbaar</a></li>
	                <li><a href="/">Profiel bewerken</a></li>
	                <li><a href="/">Wachtwoord aanpassen</a></li>
	                <li class="divider"></li> */
				?>
	                <li><a href="<?php echo wp_logout_url(); ?>">Uitloggen</a></li>
			    </ul>
			  </li>
            </ul>

			<?php } ?>

        </div>
      </div>
    </div>


	  <!-- Navbar
    ================================================== -->
    <div class="navbar navbar-fixed-top second" style="top: -5px; z-index: 10;">
      <div class="navbar-inner">
        <div class="container">

            <ul class="nav">

				<?php if ( is_user_logged_in() ) { ?>

					<?php wp_list_pages( '&title_li=' ); ?>

					<li class="dropdown">
					  <a href="#"
					        class="dropdown-toggle"
					        data-toggle="dropdown">
					        Bewoners
					        <b class="caret"></b>
					  </a>
					  <ul class="dropdown-menu">
							<li><a href="/bewoners/per-huis">Per huis</a></li>
							<li><a href="/bewoners/">Fotopagina</a></li>
							<li><a href="/bewoners/contactgegevens">Contactgegevens</a></li>
							<li><a href="/bewoners/vraag-en-antwoord">Vraag en antwoord</a></li>
					  </ul>
					</li>

				<?php } else { ?>
					<li class="page_item page-item-6 current_page_item"><a href="">Je hebt hier niets te zoeken!</a></li>
				<?php } ?>

            </ul>

        </div>
      </div>
    </div>


    <div class="container page">