     <!-- Footer
      ================================================== -->
    <footer class="footer">
        <p><?php the_field('footer_text', 'option'); ?></p>
    </footer>

</div><!-- /container -->

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php bloginfo('template_directory');?>/js/google-code-prettify/prettify.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/jquery.tablesorter.min.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/bootstrap-transition.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/bootstrap-alert.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/bootstrap-modal.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/bootstrap-dropdown.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/bootstrap-scrollspy.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/bootstrap-tab.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/bootstrap-tooltip.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/bootstrap-popover.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/bootstrap-button.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/bootstrap-collapse.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/bootstrap-carousel.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/bootstrap-typeahead.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/jquery.ui.datepicker.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/jquery.ui.datepicker-nl.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/jquery.ui.slider.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/datetimepicker.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/application.js"></script>

<?php if (get_field('google_analytics_code', 'option')) : ?>
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', '<?php the_field('google_analytics_code', 'option'); ?>']);
        _gaq.push(['_trackPageview']);
        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>

    <?php endif; ?>

    <?php wp_footer(); ?>

  </body>
</html>
