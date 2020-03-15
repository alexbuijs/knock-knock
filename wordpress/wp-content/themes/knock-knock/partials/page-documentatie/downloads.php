<div class="card">
  <div class="card-header bg-transparent">
    <h5>
      Bijlagen
    </h5>
  </div>

  <div class="card-body mb-3">
    <ul class='list-unstyled'>
      <?php if (!have_rows('downloads')): ?>
        <div class="text-muted">
          Geen bestanden
        </div>
      <?php else: ?>
        <?php while (have_rows('downloads')) : the_row(); ?>
          <?php $bestand = get_sub_field('bestand'); if ($bestand): ?>
            <li class='d-flex'>
              <div class='mr-1'>
                <i class="far fa-fw fa-file text-muted"></i>
              </div>
              <a href="<?php echo $bestand['url']; ?>"><?php the_sub_field('omschrijving'); ?></a>
            </li>
          <?php endif; ?>
        <?php endwhile; ?>
      <?php endif; ?>
    </ul>
  </div>
</div>
