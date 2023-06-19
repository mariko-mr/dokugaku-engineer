<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="stylesheets/css/style.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">

</head>

<body>
    <header class="header shadow-sm">
        <h1 class="h3 p-3"><a href="new.php" class="text-dark text-decoration-none">わたしのメモ帳</a></h1>
    </header>

    <div class="container">
        <?php include $content; ?>
    </div>
</body>
</html>
