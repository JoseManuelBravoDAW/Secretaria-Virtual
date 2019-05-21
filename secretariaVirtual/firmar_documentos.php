<h1>tus documentos</h1>
<?php

if(isset($_POST['firmar'])){
    $_SESSION['documentoAFirmar'] = $_POST['idDocumento'];
    header("Location: index.php?page=firmar");
}

require_once('clases/Secretaria.php');
$secretaria = Secretaria::singleton_secretaria();
$documentos = $secretaria->getDocumentos();
if(empty($documentos)){
    echo "<p>Aún no has subido ningún documento</p>";
}else{
?>



    <table>
        <tr>
            <th>Documentos</th>
            <th>Estado</th>
            <th>Fecha</th>
            <th>Acción</th>
        </tr>
        <?php
            foreach($documentos as $key){
                
                echo "<tr>";
                echo "<td>" . $key['fichero'] . "</td>";
                echo "<td>" . $key['estado'] . "</td>";
                if($key['estado'] == 'Pendiente'){
                    echo "<td></td>";
                }else{
                    echo "<td>" . $key['fechaFirma'] . "</td>";
                }
                
                
                if($key['estado'] == 'Pendiente'){
                    echo "<td>";
                    echo "<form action='index.php?page=firmar_documentos' method='post' style='width:100px'>";
                    echo "<input type='hidden' name='idDocumento' value='" . $key['id'] . "'>";
                    echo "<input type='submit' name='firmar' value='Firmar'>";
                    echo "</form>";
                    echo "</td>";
                }else{
                    echo "<td></td>";
                }
            }
        ?>
    </table>

<?php
}
?>