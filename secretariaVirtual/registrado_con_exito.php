<?php
if(isset($_SESSION['logeado'])){
    header('Location: index.php?page=bienvenido');

}
?>


<h3>Registrado con éxito</h3>
<p>Tu cuenta ha sido creada y está pendiente de aprobación.</p>
<p>Una vez haya sido aprobada, vuelve al <a href="index.php?page=login">formulario de entrada</a> para empezar.</p>
