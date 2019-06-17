<?php

function validarRegistracion($datos) {
  $errores = [];

  if (strlen($datos["name"]) < 3) {
    $errores["name"] = "- Ingresa un nombre de más de 3 caracteres";
  }

  if ($datos["birthday"] == "") {
    $errores["birthday"] = "- Ingresa tu fecha de nacimiento";
  }
  else if (validateAge($datos["birthday"]) == false) {
    $errores["birthday"] = "- Debes ser mayor de 18 años";
  }

  if ($datos["email"] == "") {
    $errores["email"] = "- Ingresa tu email";
  }
  else if (filter_var($datos["email"], FILTER_VALIDATE_EMAIL) == false) {
    $errores["email"] = "- Tu email no es válido";
  }
  

  return $errores;
}

function armarUsuario($datos) {
  return [
    "id" => proximoId(),
    "name" => ucfirst($datos["name"]),
    "email" => $datos["email"],
    "birthday" => $datos["birthday"],
      ];
}

function proximoId() {
  $usuarios = traerTodosLosUsuarios();

  
  if (empty($usuarios)) {
    return 1;
  }

  
  $ultimoUsuario = end($usuarios);

  
  return $ultimoUsuario["id"] + 1;
}

function traerTodosLosUsuarios() {
  $archivo = file_get_contents("usuarios.json");

  if ($archivo == "") {
    return [];
  }

  $usuarios = json_decode($archivo, true);

  return $usuarios;
}

function registrar($usuario) {
  $usuarios = traerTodosLosUsuarios();

  $usuarios[] = $usuario;

  $usuariosJSON = json_encode($usuarios);

  file_put_contents("usuarios.json", $usuariosJSON);
}

function validateAge($birthday, $age = 18)
{
    
    if(is_string($birthday)) {
        $birthday = strtotime($birthday);
    }

   
    if(time() - $birthday < $age * 31536000)  {
        return false;
    }

    return true;
}

?>