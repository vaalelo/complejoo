<?php

error_reporting(0);

if ($_POST) {

 $tipoDocumento = $_POST['tipoDocumento'];
 $tipoVisita = $_POST['tipoVisita'];
 $documento = $_POST['documento'];
 $nombre = $_POST['nombre'];
 $apellido = $_POST['apellido'];
 $celular = "";//$_POST['celular'];
 $email = $_POST['email'];
 $nacionalidad = $_POST['nacionalidad'];

 require('conexion.php');
 setlocale(LC_TIME, 'es_ES.UTF-8');

$query = "INSERT INTO solicitudes (tipo_documento, nacionalidad, tipo_visita, documento, nombre, apellido, celular, email, fecha) VALUES ('$tipoDocumento', '$nacionalidad', '$tipoVisita', '$documento','$nombre','$apellido','$celular','$email', now())";

mysqli_set_charset($mysqli, 'utf8');

if ($mysqli->query($query) === TRUE) {

$ultimo_id = $mysqli->insert_id;     

$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;

$PNG_WEB_DIR = 'temporal/';

include "./plugins/phpqrcode/qrlib.php";    

if (!file_exists($PNG_TEMP_DIR))
    mkdir($PNG_TEMP_DIR);

$filename = $PNG_TEMP_DIR.'test.png';

$matrixPointSize = 5;
$errorCorrectionLevel = 'L';

$ip="localhost";
$link = "$ip/vista.php?id=$ultimo_id&documento=$documento";

$filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
QRcode::png($link, $filename, $errorCorrectionLevel, $matrixPointSize, 2); 

    
?>    

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" media='all'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <link rel="icon" type="image/ico" href="#">
    <title class="oculto-impresion">Complejo Yacyreta</title>
    
</head>

    <body class="d-flex flex-column">

        <div id="contenido">

        <div class="alert alert-success d-flex justify-content-center mt-4" role="alert">REGISTRO DE VISITAS</div>

        <div class="col-12 d-flex justify-content-center">
            
            <div class="card" style="width: 18rem;">
          <!--  <img class="card-img-top" style="text-center;" src="<?php echo $PNG_WEB_DIR.basename($filename) ?>" alt="Card image cap"> -->
            <div class="card-body text-center">
              <h5 class="card-title"> <?php echo $tipoDocumento. " : " .  $documento; ?></h5>
              <p class="card-text"><?php echo  $nombre . " " . $apellido ; ?></p>
              <button class="btn btn-primary oculto-impresion" onclick="imprimirDiv()">Imprimir</button>
              <a href="./" class="btn btn-danger oculto-impresion">Volver</a>
            </div>
        </div>
            
                
        </div>
        
        </div>    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/js/brands.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/js/fontawesome.min.js"></script>
    
    <script>
    
    function imprimirDiv(){
        
    var mywindow = window.open('', 'PRINT', 'height=500,width=800');

    mywindow.document.write('<html><head>');
    mywindow.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" media="all">');
    mywindow.document.write('<style>@media print{.oculto-impresion, .oculto-impresion *{display: none !important;}}</style>');
    mywindow.document.write('</head><body>');
    mywindow.document.write(document.getElementById("contenido").innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close();
    mywindow.focus(); 

    mywindow.print();
    mywindow.close();

    return true;
    
        
    }

</script>

</body>      
    
 <?php   
    
 } else {
     echo "Error: ".$query ."<br>" . $mysqli->error; die();
 }
 
 $mysqli->close();
 

} else{

    echo "No envio datos";

}