<?php get_header();?>

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ornare augue eu congue dictum. Suspendisse potenti. Aliquam erat volutpat. Vivamus semper risus vitae ultricies vehicula. Ut sollicitudin molestie purus, et fermentum tellus viverra a. Morbi vel ligula a augue gravida lobortis. Aenean iaculis purus ac feugiat pulvinar. Mauris commodo tellus vel nunc porta bibendum. Donec nisi eros, efficitur ut tempor quis, porttitor ut ligula. Aliquam erat volutpat.</p>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card">
            <div class="card-header bg-transparent">
                <h5><i class="fas fa-fw fa-calendar-alt"></i>Agenda</h5>
            </div>
            <div class="card-body">
                <p>Morbi lobortis luctus quam ut condimentum. Cras a risus augue. Aenean fringilla viverra lacus, sit amet convallis augue hendrerit eu. Sed vitae mollis dolor. Fusce nec eleifend metus, id fermentum nunc. Aenean vitae efficitur justo, sit amet pharetra urna. Duis rutrum libero quis dolor eleifend, ut dignissim risus ultrices. Vivamus nulla nisi, dignissim eu risus eget, tincidunt tempus leo. Cras ut ante id diam dignissim ornare. Sed facilisis elit purus, eget tristique ipsum facilisis viverra. Aenean nisi augue, facilisis eget elit at, euismod pharetra lorem. Maecenas sagittis nunc ut est ornare, non ullamcorper ex posuere. Curabitur sit amet tellus viverra, elementum elit nec, ullamcorper libero. Mauris posuere neque eu ipsum fringilla, ut dapibus nunc aliquet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed pharetra elementum pellentesque.</p>
            </div>
            <div class="card-footer bg-transparent">
                <button class="btn btn-primary">Bekijk alle agenda-items</button>
            </div>
        </div>
    </div>
</div>

    <?php if (have_posts()): ?>

    <?php while (have_posts()):
    the_post();

    get_template_part('content', get_post_format());
endwhile;?>

	    <?php endif;?>

<?php get_footer();?>
