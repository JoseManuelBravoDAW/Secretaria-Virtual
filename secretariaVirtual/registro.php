<?php
require_once('clases/Login.php');

if(isset($_SESSION['logeado'])){
    header('Location: index.php?page=bienvenido');

}
?>
        <h3>Registro</h3>
        
        <?php
        if(isset($_POST['registrar'])){
            
            $login = Login::singleton_login();

            if($_POST['contrasenia'] == $_POST['confirmar_contrasenia']){
                
                $login->registroUsuario($_POST['nombre'], $_POST['email'], $_POST['usuario'], $_POST['contrasenia']);

                header('Location: index.php?page=registrado_con_exito');
            }else{
                echo "<p style='background:red; color:white; display:table; padding:5px;'>Las contraseñas no coinciden</p>";
            }
            
        }
        ?>
        
        <form action="registro.php" method="post">
            
            <input type="text" name="nombre" id="nombre" placeholder="Nombre" required> <br>

            <input type="email" name="email" id="email" placeholder="Email" required> <br>

            <input type="text" name="usuario" id="usuario" placeholder="Usuario" required> <br>

            <input type="password" name="contrasenia" id="contrasenia" placeholder="Contraseña" required> <br>

            <input type="password" name="confirmar_contrasenia" id="confirmar_contrasenia" placeholder="Confirmar contraseña" required> <br>

            <input type="submit" name="registrar" value="Registrar">
        </form>
    