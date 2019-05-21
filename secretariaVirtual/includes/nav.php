<?php

if(!isset($_SESSION['logeado'])){

    ?>
    <nav>
        <ul>
            <a href="index.php?page=login" class="boton"><li>Inicio</li></a>
            <a href="index.php?page=registro" class="boton"><li>Registro</li></a>
        </ul>
    </nav>
    <?php
}else{
    
    if($_SESSION['logeado']['Usuario'] == "admin"){
        ?>
        <nav>
            <ul>
                <a href="index.php?page=generar_claves" class="boton"><li>Claves</li></a>
                <a href="index.php?page=validar_usuarios" class="boton"><li>Validar Usuarios</li></a>
                <a href="logout.php" class="boton"><li>Salir</li></a>
            </ul>
        </nav>
        <?php
    }else{
        ?>
        <nav>
            <ul>
                <a href="index.php?page=subir_documento" class="boton"><li>Subir Documentos</li></a>
                <a href="index.php?page=firmar_documentos" class="boton"><li>Firmar Documentos</li></a>
                <a href="logout.php" class="boton"><li>Salir</li></a>
            </ul>
        </nav>
        <?php
    }

}


?>