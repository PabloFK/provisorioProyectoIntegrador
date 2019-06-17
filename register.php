<!DOCTYPE html>
<?php 
        $nombre = "Registro";
        include ("html/head.php");
        require_once("funciones.php");

$nombreDefault = "";
$emailDefault = "";
$fechaDefault = "";
?>

    <body class="text-light">
        <div class="container">
            <div class="row">
                <div class="col text-right">
                    <a class="text-light" href="index.php">Volver a Pagina Inicio</a>
                </div>
            </div>
        </div>
        <?php
      
            if ($_POST) {

             
                $errores = validarRegistracion($_POST);
              
                
                if (empty($errores)) {
                
                  $usuario = armarUsuario($_POST);
                  registrar($usuario);
                  
                }
              
                foreach ($errores as $error) {
                  echo $error . "<br>";
                }
              
                $nombreDefault = $_POST["name"];
                $emailDefault = $_POST["email"];
                $fechaDefault = $_POST["birthday"];
              }
              
      ?>
              <!-- Formulario -->
       
        <div class="container mt-5">
        <div class="card bg-black"style="max-width: 760px;">
            <div class="row no-gutters">
                <div class="col-md-6">
                    <img src="images/Bienvenida.jpg" class="card-img" alt="...">
                </div>
                <div class="col-md-6 m-auto">
                    <form action="register.php" class="text-light form ml-4 mr-4" method="post">
                        
                        <div class="form-group">
                            <label for="nombre">NOMBRE: </label>
                            <input type="text" name="name" class="form-control" placeholder="Ingrese su Nombre" value="<?=$nombreDefault?>">
                        </div>
                        <div class="form-group">
                            <label for="email">EMAIL: </label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Ingrese su email" value="<?=$emailDefault?>">
                        </div>
                        <div class="form-group">
                            <label for="nombre">FEC. NACIMIENTO: </label>
                            <input type="date" name="birthday" class="form-control" value="<?=$fechaDefault?>">
                        </div>
                        
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-secondary active">ENTRAR</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

        <?php include ("html/Script-B.php") ?> 

    </body>
</html>