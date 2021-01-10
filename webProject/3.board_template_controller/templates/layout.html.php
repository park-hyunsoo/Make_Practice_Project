<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?=$title?></title>
        <link href="css/reset.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    </head>
    <body>
        <?php include  __DIR__ . '/../templates/header.html.php'; ?>
        <section><?=$output?></section>
        <?php include  __DIR__ . '/../templates/footer.html.php'; ?>
    </body>
</html>