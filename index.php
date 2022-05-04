<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- <link rel="icon" type="image/ico" href="./img/favicon.ico"> -->
    <title>Sistema de Visitas</title>

</head>

    <body class="d-flex flex-column">

        <div id="contenido">        

        <div class="alert alert-success d-flex justify-content-center" role="alert">REGISTRO DE VISITAS</div>
        
        <p class=" text-dark fs-2 d-flex justify-content-center">Datos Personales</p>
        <p class=" text-secondary fs-4 d-flex justify-content-center">Campos obligatorios (*)</p>

        <div class="col-12 d-flex justify-content-center">
                
        <form autocomplete="off" action="ingresar.php" method="post">
            
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="tipoDocumento">Tipo de visita (*)</label>
              </div>
              <select class="custom-select" id="tipoVisita" name="tipoVisita" required >
                <option value="">Seleccione</option>
                <option value="Técnica">Técnica</option>
                <option value="Turística">Turística</option>
              </select>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="tipoDocumento">Tipo Documento (*)</label>
              </div>
              <select class="custom-select" id="tipoDocumento" name="tipoDocumento" required >
                <option value="">Seleccione</option>
                <option value="Cedula">Cedula de Identidad</option>
                <option value="Pasaporte">Pasaporte</option>
              </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="nacionalidad">Nacionalidad(*)</span>
                </div>
                <input type="text" class="form-control" placeholder="Nacionalidad" aria-label="nacionalidad" aria-describedby="nacionalidad"  id="nacionalidad" name ="nacionalidad" required>
            </div>
            
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" for="documento">Nro. Documento (*)</span>
                </div>
                <input type="text" class="form-control" placeholder="Documento" aria-label="documento" aria-describedby="documento"  id="documento" name ="documento" required>
            </div>
            
          
            
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                <label class="input-group-text" for="nombre">Nombre/s (*)</label>
                </div>
                <input type="text" class="form-control" placeholder="Nombre/s" aria-label="nombre" aria-describedby="nombre"  id="nombre" name ="nombre" required>
            </div>
            
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                <label class="input-group-text" for="apellido">Apellido/s (*)</label>
                </div>
                <input type="text" class="form-control" placeholder="Apellido/s" aria-label="apellido" aria-describedby="apellido"  id="apellido" name ="apellido" required>
            </div>
            
            <!--<div class="input-group mb-3">-->
            <!--    <div class="input-group-prepend">-->
            <!--    <span class="input-group-text" id="celular">Celular (*)</span>-->
            <!--    </div>-->
            <!--    <input type="tel" class="form-control" placeholder="Celular" aria-label="celular" aria-describedby="celular"  id="celular" name ="celular" required>-->
            <!--</div>-->
            
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="email">Email</span>
                </div>
                <input type="email" class="form-control" placeholder="Email" aria-label="email" aria-describedby="email"  id="email" name ="email">
            </div>
            
            <button type="submit" class="btn btn-primary" id="generarQR" >Registrarse y generar codigo QR</button>
            <button type="reset" class="btn btn-danger" id="limpiarQR" >Cancelar</button>
            
        </form>

        </div>
        
        </div>

    </body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/js/brands.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/js/fontawesome.min.js"></script>
    
    <script type="text/javascript">
    $("#documento").change(function() {
        tipoDocumento = $('#tipoDocumento').val();
        if (tipoDocumento === 'Cedula') {
            numberval = $('#documento').val();
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: "http://192.168.164.146:8088/sii/rest/identificaciones",
                data: JSON.stringify({
                    pregunta: numberval,
                    consulta: 1
                }),
                contentType: "application/json",
                success: function(data) {
                    $('#nombre').val(data["SDTRespuesta"]["nombre"]);
                    $("#apellido").val(data["SDTRespuesta"]["apellido"]);
                    $("#tipoDocumento").val("Cedula");
                    $("#nacionalidad").val("Paraguayo");
                },
                error: function() {
                    alert('Ocurrio un error!');
                }
            });
        }
    });
</script>

</body>