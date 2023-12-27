<?php
//Aqui pondremos las funciones de validación de los campos

function validarDatos($n, $e, $p, $hc, $f, $g)
{
    return (is_string($n) &
        is_numeric($e) &
        is_numeric($p) &
        is_numeric($hc) &
        is_numeric($f) &
        is_numeric($g));
}
function sinTildes($frase): string
{
    $no_permitidas = array(
        "á",
        "é",
        "í",
        "ó",
        "ú",
        "Á",
        "É",
        "Í",
        "Ó",
        "Ú",
        "à",
        "è",
        "ì",
        "ò",
        "ù",
        "À",
        "È",
        "Ì",
        "Ò",
        "Ù"
    );
    $permitidas = array(
        "a",
        "e",
        "i",
        "o",
        "u",
        "A",
        "E",
        "I",
        "O",
        "U",
        "a",
        "e",
        "i",
        "o",
        "u",
        "A",
        "E",
        "I",
        "O",
        "U"
    );
    $texto = str_replace($no_permitidas, $permitidas, $frase);
    return $texto;
}
function sinEspacios($frase)
{
    $texto = trim(preg_replace('/ +/', ' ', $frase));
    return $texto;
}
function recoge(string $var)
{
    if (isset($_REQUEST[$var]) && (!is_array($_REQUEST[$var]))) {
        $tmp = sinEspacios($_REQUEST[$var]);
        $tmp = strip_tags($tmp);
    } else
        $tmp = "";

    return $tmp;
}
function recogeArray(string $var): array
{
    $array = [];
    if (isset($_REQUEST[$var]) && (is_array($_REQUEST[$var]))) {
        foreach ($_REQUEST[$var] as $valor)
            $array[] = strip_tags(sinEspacios($valor));
    }

    return $array;
}
function cTexto(string $text, string $campo, array &$errores, int $max = 30, int $min = 1, bool $espacios = TRUE, bool $case = TRUE): bool
{
    $case = ($case === TRUE) ? "i" : "";
    $espacios = ($espacios === TRUE) ? " " : "";
    if ((preg_match("/^[a-zñ$espacios]{" . $min . "," . $max . "}$/u$case", sinTildes($text)))) {
        return true;
    }
    $errores[$campo] = "Error en el campo $campo";
    return false;
}
function cNombre(string $text, string $campo, array &$errores, int $max = 50, int $min = 1): bool
 {
     
     if ((preg_match("/.{" . $min . "," . $max . "}$/u", $text))) {
         return true;
     }
     $errores[$campo] = "Nombre No valido";
     return false;
 }

 function cApellidos(string $text, string $campo, array &$errores, int $max = 100, int $min = 1): bool
 {
     
     if ((preg_match("/.{" . $min . "," . $max . "}$/u", $text))) {
         return true;
     }
     $errores[$campo] = "Apellidos No valido";
     return false;
 }
 
 function cPass(string $pass, string $campo, array &$errores, int $max = 20, int $min = 8): bool
 {
     
     if ((preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$@¿?¡!_-]).{" . $min . "," . $max . "}/", $pass))) {
         return true;
     }
     $errores[$campo] = "La contraseña no cumple con los criterios de seguridad";
     return false;
 }
 function cReppass(string $reppass, string $campo, string $pass, array &$errores): bool
 {
     
     if(strcmp($reppass,$pass)==0){
        return true;
     }
     $errores[$campo] = "Las Contraseñas no son iguales";
     return false;
 }

 function cEmail(string $mail, string $campo, array &$errores, int $max = 30, int $min = 6): bool
 {
     if (((filter_var($mail, FILTER_VALIDATE_EMAIL)))) {
         return true;
     }
     $errores[$campo] = "Correo no valido";
     return false;
 }
 function cTipo(string $tipo, string $campo, array &$errores): bool
 {
     IF($tipo == "C" || $tipo == "U"|| $tipo == "SU"){
        return true;
     }
     $errores[$campo] = "Tipo no valido";
     return false;
 }
 function tokenGen(string $mail){
    $split = explode("@", $mail);
    $root = $split[0];
    $token = $root.str_shuffle($root);
    return $token;
 }


function unixFechaAAAAMMDD($fecha,$campo,&$errores){

    $arrayfecha=explode("-",$fecha);
if (count($arrayfecha)==3){
    $fechavalida=checkdate($arrayfecha[1], $arrayfecha[2], $arrayfecha[0]);

    if( $fechavalida){

        return mktime(0,0,0,$arrayfecha[2],$arrayfecha[1],$arrayfecha[0]);

    }
}
        $errores[$campo]="Fecha no valida";
        return false;
    
}
function encriptar($password, $cost=10) {
    return password_hash($password, PASSWORD_DEFAULT, ['cost' => $cost]);
}

function comprobarhash($pass, $passBD) {
    // Primero comprobamos si se ha empleado una contraseña correcta:
    return password_verify($pass, $passBD) ;
}

?>
