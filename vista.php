<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" media="all">

<?php



if (($_GET['id']) and ($_GET['documento'])) {

 $id = $_GET['id'];

 $documento = $_GET['documento'];

    require('conexion.php');

    setlocale(LC_TIME, 'es_ES.UTF-8');

    $query = "SELECT * FROM solicitudes where id = $id";

    $res = $mysqli->query($query);

    $resultado = $res->fetch_assoc();    

    $date = date_create($resultado['fecha'] );

    $fecha = date_format($date,"d-m-Y H:i:s");

    if ($documento == $resultado['documento'] ){        

        echo '  <div class="alert alert-success d-flex justify-content-center mt-4" role="alert">Acceso permitido</div>

                <div class="col-12 d-flex justify-content-center">

                <div class="card mt-5" style="width: 18rem;">

                <div class="card-body">

                <h5 class="card-title">'.$resultado['documento'].'</h5>

                <h6 class="card-subtitle mb-2 text-muted">'. $resultado['nombre'] . " " . $resultado['apellido'] .'</h6>

                <h6 class="card-subtitle mb-2 text-muted">'. $resultado['tipo_documento'] .'</h6>

                <p class="card-text">'. $fecha .'</p>

              </div>

              </div>

            </div>';        

    } else {      

        echo '<div class="alert alert-danger d-flex justify-content-center mt-4" role="alert">Acceso Restringido</div><p class="text-center">Los datos no coinciden</p>';

    }

} else{

    echo '<div class="alert alert-danger d-flex justify-content-center mt-4" role="alert">No envio datos o estan incompletos</div>';

}

?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>