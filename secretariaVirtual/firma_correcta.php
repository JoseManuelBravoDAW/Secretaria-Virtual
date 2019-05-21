<h1>¡Firma correcta!</h1>
<?php
require_once('clases/Secretaria.php');
$secretaria = Secretaria::singleton_secretaria();
$documento = $secretaria->getDocumento($_SESSION['documentoAFirmar']);
echo "<h3 style='color:black'>El documento " . $documento[0]['fichero'] . " ha sido firmado correctamente</h3>";
?>