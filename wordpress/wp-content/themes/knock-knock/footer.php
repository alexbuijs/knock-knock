        <footer class="footer">
            <hr>
            <p class="text-muted"><?php the_field('footer_text', 'option');?></p>
        </footer>
    </div>

    <?php get_template_part('partials/analytics');?>

    <?php wp_footer();?>

    </body>
</html>
