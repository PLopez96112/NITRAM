<?php
// carga del modelo y los controladores
require_once __DIR__ . '/../app/Config.php';
require_once __DIR__ . '/../app/Model.php';
require_once __DIR__ . '/../app/Controller.php';
session_start();


// enrutamiento
$map = array(

    
    'iniciar' => array('controller' =>'Controller', 'action' => 'iniciar'),
    'error' => array('controller' =>'Controller', 'action' => 'error'),
    'salir' => array('controller' =>'Controller', 'action' => 'salir'),  
    'ModificarTicket' => array('controller' =>'Controller', 'action' => 'ModificarTicket'),
    'NuevoUsuario' => array('controller' =>'Controller', 'action' => 'NuevoUsuario'),
    'NuevoGrupo' => array('controller' =>'Controller', 'action' => 'NuevoGrupo'),
    'BuscarUsuario' => array('controller' =>'Controller', 'action' => 'BuscarUsuario'),
    'BuscarTicket' => array('controller' =>'Controller', 'action' => 'BuscarTicket'),
    'ListaTickets' => array('controller' =>'Controller', 'action' => 'ListaTickets'),
    'ModificarUsuario' => array('controller' =>'Controller', 'action' => 'ModificarUsuario'),
    'NuevoTicket' => array('controller' =>'Controller', 'action' => 'NuevoTicket'),    
    'dashboard_C' => array('controller' =>'Controller', 'action' => 'dashboard_C'),
    'dashboard_U' => array('controller' =>'Controller', 'action' => 'dashboard_U'),
    'dashboard_SU' => array('controller' =>'Controller', 'action' => 'dashboard_SU'),
    'NuevaPass' => array('controller' =>'Controller', 'action' => 'NuevaPass'),
    'solicitar' => array('controller' =>'Controller', 'action' => 'solicitar')
    
    

);
// Parseo de la ruta
if (isset($_GET['ctl'])) {
    if (isset($map[$_GET['ctl']])) {
        $ruta = $_GET['ctl'];
    } else {

        //Si el valor puesto en ctl en la URL no existe en el array de mapeo envía una cabecera de error
        header('Status: 404 Not Found');
        echo '<html><body><h1>Error 404: No existe la ruta <i>' .
            $_GET['ctl'] .'</p></body></html>';
            exit;
    }
} else {
    $ruta = 'iniciar';
}
$controlador = $map[$ruta];
/* 
Comprobamos si el metodo correspondiente a la acción relacionada con el valor de ctl existe, si es así ejecutamos el método correspondiente.
En aso de no existir cabecera de error.
En caso de estar utilizando sesiones y permisos en las diferentes acciones comprobariaos tambien si el usuario tiene permiso suficiente para ejecutar esa acción
*/

if (method_exists($controlador['controller'],$controlador['action'])) {
    call_user_func(array(new $controlador['controller'],
        $controlador['action']));
} else {
    header('Status: 404 Not Found');
    echo '<html><body><h1>Error 404: El controlador <i>' .
        $controlador['controller'] .
        '->' .
        $controlador['action'] .
        '</i> no existe</h1></body></html>';
}
?>