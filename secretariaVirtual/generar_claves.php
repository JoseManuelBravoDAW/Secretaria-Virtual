<?php
require_once('clases/Admin.php');
?>
<h1>generar claves</h1>
<?php
$admin = Admin::singleton_admin();

if(isset($_POST['generar'])){
    if(!empty($_POST['arrayDeUsuarios'])){
        $admin->generarClaves($_POST['arrayDeUsuarios']);
        echo "<p class='mensaje'>Las claves han sido generadas con éxito</p>";
    }
}

$usuarios = $admin->getUsuariosValidados();
if(empty($usuarios)){
    echo "<p>No hay ningun usuario activo</p>";

}else{
?>
<form action="index.php?page=generar_claves" method="post">
    <table>
    <tr>
        <th>Nombre</th>
        <td><label for="todos">Seleccionar todos </label><input type="checkbox" name="todos" id="todos"></td>
    </tr>
    <?php
    foreach ($usuarios as $key) {
        echo "<tr>";
        echo "<td>" . $key['nombre'] . "</td>";
        echo "<td> <input type='checkbox' name='arrayDeUsuarios[]' value='" . $key['id'] . "'></td>";
        echo "</tr>";
    }
    ?>
    </table>
    <input type="submit" name="generar" value="Generar">
</form>
<?php
}
?>