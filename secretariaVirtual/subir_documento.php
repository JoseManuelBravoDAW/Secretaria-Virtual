<h1>subir documentos</h1>

<?php
if(isset($_POST['subir'])){
    require_once('clases/Secretaria.php');
    $secretaria = Secretaria::singleton_secretaria();
    $secretaria->subirDocumento($_POST['descripcion']);
    echo "<p class='mensaje'>El documento ha sido subido con éxito</p>";
}
?>

<form action="index.php?page=subir_documento" method="post" enctype="multipart/form-data">
    <label for="documento" id="labelDocumento">Elegir archivo</label>
    <input type="file" name="documento" id="documento" required> <br>
    <textarea name="descripcion" id="descripcion" cols="30" rows="10" placeholder="Descripción" required></textarea> <br>
    <input type="submit" name="subir" value="Subir">
</form>