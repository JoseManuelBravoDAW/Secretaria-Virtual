<?php
if(!isset($_SESSION['logeado'])){
    header('Location: index.php?page=login');
}
?>
<h1>Bienvenido <?php echo $_SESSION['logeado']['Nombre']?></h1>