    <div>
        <h1>読書ログ</h1>
    </div>
    <div>
        <a href="new.php">読書ログを登録する</a>
    </div>
    <main>
        <?php if (count($book_logs) > 0) : ?>
            <?php foreach ($book_logs as $book_log) : ?>
                <section>
                    <h2><?php echo escape($book_log['title']); ?></h2>
                    <div>
                        <?php echo escape($book_log['author']); ?>&nbsp;/
                        <?php echo escape($book_log['status']); ?>&nbsp;/
                        <?php echo escape($book_log['rating']); ?>点
                    </div>
                    <div>
                        <?php echo nl2br(escape($book_log['review']), false); ?>
                    </div>
                </section>
            <?php endforeach; ?>
        <?php else : ?>
            <div>読書ログがありません。</div>
        <?php endif; ?>
    </main>
