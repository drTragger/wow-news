<?php unset($_SESSION['id']) ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title><?= $this->page ?></title>
</head>
<body>
<header>
    <h1><a href="/">WoW News</a></h1>
    <?php if (isset($_SESSION['login'])): ?>
        <div class="user">
            <p class="greeting">Hello, <?= ucfirst($_SESSION['login']) ?></p>
            <a href="?action=logout" class="logout">logout</a>
        </div>
    <?php endif; ?>
</header>
<main>
    <?php if (isset($_SESSION['message'])): ?>
        <p class="message"><?= $_SESSION['message'] ?></p>
    <?php unset($_SESSION['message']) ?>
    <?php unset($_SESSION['username']) ?>
    <?php endif; ?>
    <?php include_once 'views' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . $this->page . '.php' ?>
</main>
<footer>

</footer>
</body>
</html>