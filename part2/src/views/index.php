    <div>
        <h1>読書ログ</h1>
    </div>
    <div>
        <a href="new.php" class="btn btn-primary mt-4">読書ログを登録する</a>
    </div>
    <main>
        <?php if (count($book_logs) > 0) : ?>
            <?php foreach ($book_logs as $book_log) : ?>
                <section class="card shadow-sm mt-4">
                    <div class="card-body">
                        <h2 class="card-title  h4"><?php echo escape($book_log['title']); ?></h2>
                        <div class="small">
                            <?php echo escape($book_log['author']); ?>&nbsp;/
                            <?php echo escape($book_log['status']); ?>&nbsp;/
                            <?php echo escape($book_log['rating']); ?>点
                        </div>
                        <div class="mt-2">
                            <?php echo nl2br(escape($book_log['review']), false); ?>
                        </div>
                    </div>
                </section>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="mt-4">読書ログがありません。</div>
        <?php endif; ?>
    </main>
