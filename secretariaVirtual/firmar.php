<?php
require_once('clases/Secretaria.php');
$secretaria = Secretaria::singleton_secretaria();
$documento = $secretaria->getDocumento($_SESSION['documentoAFirmar']);
if(isset($_POST['firmar'])){
    if($secretaria->firmarDocumento($_POST['fila'], $_POST['columna'], $_POST['clave'])){
        header("Location: index.php?page=firma_correcta");
    }else{
        echo "<p class='error'>Clave incorrecta</p>";
    }
    
}

?>
<h1>Firmar <?php echo $documento[0]['fichero']?></h1>
<?php
$numero1 = rand(1,8);
$numero2 = rand(1,8);
switch ($numero1) {
    case 1:
        $letra = 'a';
        break;
    case 2:
        $letra = 'b';
        break;
    case 3:
        $letra = 'c';
        break;
    case 4:
        $letra = 'd';
        break;
    case 5:
        $letra = 'e';
        break;
    case 6:
        $letra = 'f';
        break;
    case 7:
        $letra = 'g';
        break;
    case 8:
        $letra = 'h';
        break;
}
echo "<p>Introduce la clave " . $letra . "-" . $numero2 . "</p>";
?>
<form action="index.php?page=firmar" method="post">
    <input type="text" name="clave" id="clave" placeholder="clave" required><br>
    <input type='hidden' name='fila' value='<?php echo $letra?>'>
    <input type='hidden' name='columna' value='<?php echo $numero2?>'>
    <input type="submit" name="firmar" value="Firmar">
</form>
