<?php
require_once('clases/Admin.php');
?>
<h1>validar usuarios</h1>

<?php
$admin = Admin::singleton_admin();

if(isset($_POST['validar'])){
    if(!empty($_POST['arrayDeUsuarios'])){
        $admin->validarUsuarios($_POST['arrayDeUsuarios']);
    }
}

$usuarios = $admin->getUsuariosAValidar();
if(empty($usuarios)){
    echo "<p>No hay usuarios pendientes de validación</p>";

}else{
?>
<form action="index.php?page=validar_usuarios" method="post">

    <table>
        <tr>
            <th>Nombre</th>
            <td><label for="todos">Seleccionar todos </label><input type="checkbox" name="todos" id="todos"></td>
        </tr>
        <?php
foreach ($usuarios as $key) {
    echo "<tr>";
    echo "<td>" . $key['nombre'] . "</td>";
    echo "<td> <input type='checkbox' name='arrayDeUsuarios[]' value='" . $key['usuario'] . "'></td>";
    echo "</tr>";
}
?>
    </table>
    <input type="submit" name="validar" value="Validar">
</form>
<?php
}
?>