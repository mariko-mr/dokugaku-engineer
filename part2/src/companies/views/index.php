    <div>
        <h1 class="h2 text-dark mt-4">会社情報の一覧</h1>
    </div>
    <div><a href="new.php">会社情報を登録する</a></div>
    <main>

        <?php if (count($companies) > 0) : ?>

            <?php foreach ($companies as $company) : ?>
                <section>
                    <h2><?php echo escape($company['name']); ?></h2>
                    <div>創業&nbsp;:&nbsp;
                        <?php echo escape($company['establishment_date']); ?>
                        &nbsp;|&nbsp;代表&nbsp;:&nbsp;
                        <?php echo escape($company['founder']); ?>
                    </div>
                </section>
            <?php endforeach; ?>

        <?php else : ?>
            <p>会社情報が登録されていません。</p>
        <?php endif; ?>

    </main>
