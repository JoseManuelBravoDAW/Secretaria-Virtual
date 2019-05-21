<?php
require_once('clases/Login.php');

if(isset($_SESSION['logeado'])){
    header('Location: index.php?page=bienvenido');

}

if(isset($_POST['entrar'])){
            
    $login = Login::singleton_login();
    $perfil = $login->loginUsuario($_POST['usuario'], $_POST['contrasenia']);
    
    switch ($perfil['Logeado']) {
        case true:
            if($perfil['Estado'] != 'activo'){
                echo "<p class='error'>Este usuario aun no ha sido validado por un administrador</p>";
            }else{
                $_SESSION['logeado'] = $perfil;
                header('Location: index.php?page=bienvenido');
            }
            break;
        default:
            echo "<p class='error'>Nombre de usuario o contraseña incorrectos</p>";
            break;
    }
}
?>
        <h3>Iniciar Sesión</h3>
        <form action="index.php?page=login" method="post">
            
            <input type="text" name="usuario" id="usuario" placeholder="Usuario" required> <br>

            
            <input type="password" name="contrasenia" id="contrasenia" placeholder="Contraseña" required>
            <br>
            <input type="submit" name="entrar" value="Entrar">
        </form>
