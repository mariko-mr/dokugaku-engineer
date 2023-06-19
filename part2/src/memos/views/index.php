<main class="pt-5 pb-5">
<div>
    <a href="new.php" class="btn btn-dark">メモを入力する</a>
</div>

    <?php foreach ($memos as $memo) : ?>
        <section class="card mt-4 shadow-sm">
            <div class="card-body">
                <time class="text-muted" datetime="<?php echo $memo['created_time']; ?>">
                    <?php echo escape($memo['created_time']); ?>
                </time>
                <div>
                    <?php echo escape($memo['memo']); ?>
                </div>
            </div>
        </section>
    <?php endforeach; ?>

</main>
