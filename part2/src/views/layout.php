<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="stylesheets/css/app.css">

    <title><?php echo $title; ?></title>
</head>

<body>
    <!-- header -->
    <header class="Small shadow">
        <nav class="navbar navbar-expand-lg navbar-light">
            <h1>
                <a class="text-decoration-none text-dark h2" href="index.php">読書ログ</a>
            </h1>
        </nav>
    </header>

    <div class="container">
        <div class="mt-5">
            <?php include $content; ?>
        </div>
    </div>
</body>

</html>
