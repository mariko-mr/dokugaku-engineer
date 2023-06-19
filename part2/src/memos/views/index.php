<main>

    <?php foreach ($memos as $memo) : ?>
        <section>
            <time datetime="<?php echo $memo['created_time']; ?>">
                <?php echo escape($memo['created_time']); ?>
            </time>
            <div>
                <?php echo escape($memo['memo']); ?>
            </div>
        </section>
    <?php endforeach; ?>

</main>

<div>
    <a href="new.php">メモを入力する</a>
</div>
