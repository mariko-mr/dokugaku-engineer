    <div>
        <h1 class="h2 text-dark mt-4">会社情報の一覧</h1>
    </div>
    <div><a href="new.php" class="btn btn-primary mt-4">会社情報を登録する</a></div>
    <main>

        <?php if (count($companies) > 0) : ?>

            <?php foreach ($companies as $company) : ?>
                <section class="card shadow-sm mt-4">
                    <div class="card-body">
                        <h2 class="card-title h4"><?php echo escape($company['name']); ?></h2>
                        <div>創業&nbsp;:&nbsp;
                            <?php echo escape($company['establishment_date']); ?>
                            &nbsp;|&nbsp;代表&nbsp;:&nbsp;
                            <?php echo escape($company['founder']); ?>
                        </div>
                    </div>
                </section>
            <?php endforeach; ?>

        <?php else : ?>
            <p class="mt-4">会社情報が登録されていません。</p>
        <?php endif; ?>

    </main>
