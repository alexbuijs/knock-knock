<div class="card">
    <div class="card-header bg-transparent">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="font-weight-bold">
                Andere huizen
            </h5>
        </div>
    </div>
    <div class="card-body mb-2">
        <ul class="list-group">
            <?php foreach(fetch()->houses([get_the_ID()]) as $house) : setup_postdata($house); ?>

                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <h5 class="font-weight-bold"><a href="<?= get_the_permalink($house->ID) ?>"><?= $house->post_title ?></a></h5>
                    </div>
                </li>

            <?php endforeach; ?>
        </ul>
    </div>
</div>
