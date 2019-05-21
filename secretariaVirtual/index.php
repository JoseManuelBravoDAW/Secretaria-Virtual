<?php

    ob_start();

    session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/logo_gcap.jpg" type="image/x-icon">
    <title>Secretaría Virtual</title>
    <script src="js/main.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

    <header>
        <h1>Secretaría Virtual</h1>
        <h2>IES Gran Capitán</h2>
    </header>
    
    <?php
    include('includes/nav.php');
    ?>

    <main>
    <?php
    include('includes/main.php');
    ?>
    </main>

    <footer><p>© José Manuel Bravo Martínez</p></footer>
    
</body>
</html>

<?php
	ob_end_flush();
?>