<?php
include_once('libs/utils.php');
include_once('Config.php');
include_once("Mailer.php");
class Controller
{


    public function error()
    {
        require __DIR__ . '/templates/error.php';
    }



    public function salir()
    {
        session_unset();
        session_destroy();
        header('Location: index.php?ctl=iniciar');
    }
    public function iniciar()
    {

        try {
            $info = array(
                'email' => '',
                'error' => ''
            );

            if (isset($_POST['iniciar'])) {
                $email = recoge('email');
                $clave = recoge('password');
                $m = new Model();
                $usuario = $m->CompruebaUsuario($email);


                if (isset($usuario[0])) {
                    if ($usuario[0]["Estado"] == 0) {
                        if (comprobarhash($clave, $usuario[0]['Contraseña'])) {
                            $_SESSION["sesionIniciada"] = 1;
                            $_SESSION["correo"] = $email;
                            $_SESSION["ID"] = $usuario[0]["Id"];
                            $_SESSION["Tipo"] = $usuario[0]["Tipo"];

                            switch ($usuario[0]["Tipo"]) {
                                case "C":
                                    header('Location: index.php?ctl=dashboard_C');
                                    break;
                                case "U":
                                    header('Location: index.php?ctl=dashboard_U');
                                    break;
                                case "SU":
                                    header('Location: index.php?ctl=dashboard_SU');
                                    break;
                            }

                        } else {
                            $info['error'] = 'Usuario o contraseña incorrecto';
                        }
                    } else {
                        $info['error'] = 'Usuario inactivo';
                    }

                } else {
                    $info['error'] = 'Usuario o contraseña incorrecto';
                }
            }
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }

        require __DIR__ . '/templates/form_inicio.php';
    }
    public function NuevoUsuario()
    {
        $_SESSION["aviso"] = "";

        $info = array(
            'nombre' => '',
            'apellidos' => '',
            'email' => ''
        );

        $error = array();


        if (isset($_POST['enviar'])) {

            $nombre = recoge('nombre');
            $apellidos = recoge('apellidos');
            $email = recoge('email');
            $tipo = recoge('tipo');



            $info['nombre'] = $nombre;
            $info['apellidos'] = $apellidos;
            $info['email'] = $email;


            //validación de campos
            cNombre($nombre, "nombre", $error);
            cApellidos($apellidos, "apellidos", $error);
            cEmail($email, "email", $error);
            $m = new Model();
            if ($m->CompruebaUsuario($email)) {
                $error["email"] = "Correo ya utilizado";
            }

            cTipo($tipo, "tipo", $error);
            //inserción en BBDD
            if (empty($error)) {
                try {
                    $m = new Model();
                    if ($m->insertarUsuario($nombre, $apellidos, $email, $tipo)) {
                        $token = tokenGen($email);
                        $usuario = $m->DameUsuarioId($email);
                        $usuarioID = $usuario["Id"];
                        $caducidad = time() + 604800; //7 Dias
                        $m->insertarToken($token, $usuarioID, $caducidad);
                        enviar_pass($email, $token);


                    } else {
                        $_SESSION["aviso"] = 'No se ha podido completar el registro. Revisa el formulario y vuelve a intentarlo.';
                    }
                    $_SESSION["aviso"] = "Usuario Creado";
                    header('Location: index.php?ctl=dashboard_SU');
                } catch (Exception $e) {
                    error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
                    header('Location: index.php?ctl=error');
                } catch (Error $e) {
                    error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
                    header('Location: index.php?ctl=error');
                }
            }
        }
        require __DIR__ . '/templates/formNuevoUsuario.php';
    }


    public function NuevoGrupo()
    {
        $_SESSION["aviso"] = "";
        $info = array(
            'nombre' => ''
        );

        $error = array();


        if (isset($_POST['enviar'])) {

            $nombre = recoge('nombre');



            $info['nombre'] = $nombre;


            //validación de campos
            cNombre($nombre, "nombre", $error, 50);

            $m = new Model();

            //inserción en BBDD
            if (empty($error)) {
                try {
                    $m = new Model();
                    if ($m->insertarGrupo($nombre)) {

                    } else {
                        $_SESSION["aviso"] = 'No se ha podido completar el registro. Revisa el formulario y vuelve a intentarlo.';
                    }
                    $_SESSION["aviso"] = "Grupo Creado";
                    header('Location: index.php?ctl=dashboard_SU');
                } catch (Exception $e) {
                    error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
                    header('Location: index.php?ctl=error');
                } catch (Error $e) {
                    error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
                    header('Location: index.php?ctl=error');
                }
            }
        }
        require __DIR__ . '/templates/formNuevoGrupo.php';
    }

    public function BuscarUsuario()
    {
        $_SESSION["aviso"] = "";
        $info = array(
            'email' => ''
        );

        $error = array();


        if (isset($_POST['enviar'])) {

            $email = recoge('email');
            $info['email'] = $email;

            cEmail($email, "email", $error);

            //busqueda en BBDD
            if (empty($error)) {
                try {
                    $m = new Model();
                    if (!$usuario = $m->CompruebaUsuario($email)) {
                        $error["email"] = "usuario no existe";
                    } else {
                        $_SESSION["ID_UMOD"] = $usuario[0]["Id"];
                        $_SESSION["Correo_UMOD"] = $usuario[0]["Correo"];
                        $_SESSION["Nombre_UMOD"] = $usuario[0]["Nombre"];
                        $_SESSION["Apellidos_UMOD"] = $usuario[0]["Apellidos"];
                        $_SESSION["Tipo_UMOD"] = $usuario[0]["Tipo"];
                        $_SESSION["Grupo_UMOD"] = $usuario[0]["Grupo"];
                        $_SESSION["Estado_UMOD"] = $usuario[0]["Estado"];
                        header('Location: index.php?ctl=ModificarUsuario');
                    }

                } catch (Exception $e) {
                    error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
                    header('Location: index.php?ctl=error');
                } catch (Error $e) {
                    error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
                    header('Location: index.php?ctl=error');
                }
            }
        }
        require __DIR__ . '/templates/formBuscarUsuario.php';
    }
    public function ModificarUsuario()
    {
        $_SESSION["aviso"] = "";
        $m = new Model();
        $grupos = $m->Damegrupos();

        $info = array(
            'nombre' => $_SESSION["Nombre_UMOD"],
            'apellidos' => $_SESSION["Apellidos_UMOD"],
            'email' => $_SESSION["Correo_UMOD"],
            'tipo' => $_SESSION["Tipo_UMOD"],
            'grupo' => $_SESSION["Grupo_UMOD"],
            'estado' => $_SESSION["Estado_UMOD"],
            'grupos' => $grupos
        );

        $error = array();

        if (isset($_POST['enviar'])) {

            $nombre = recoge('nombre');
            $apellidos = recoge('apellidos');
            $email = recoge('email');
            $tipo = recoge('tipo');
            $grup = recoge('Grupo');
            $estado = recoge('Estado');


            $info = array(
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'email' => $email,
                'tipo' => $tipo,
                'grupo' => $grup,
                'estado' => $estado,
                'grupos' => $grupos
            );


            //validación de campos
            cNombre($nombre, "nombre", $error);
            cApellidos($apellidos, "apellidos", $error);
            cEmail($email, "email", $error);
            $m = new Model();
            if (!$_SESSION["Correo_UMOD"] == $email) {
                if ($m->CompruebaUsuario($email)) {
                    $error["email"] = "Correo ya utilizado";
                }

            }
            cTipo($tipo, "tipo", $error);
            if (!in_array($grup, $grupos[0])) {
                $error["Grupo"] = "Grupo incorrecto";
            }

            if (!($estado == 1 || $estado == 0)) {
                $error["Estado"] = "Estado incorrecto";
            }

            //inserción en BBDD
            if (empty($error)) {
                try {
                    $m = new Model();
                    if (!$m->ModificarUsuario($_SESSION["ID_UMOD"], $nombre, $apellidos, $email, $tipo, $grup, $estado)) {
                        $_SESSION["aviso"] = 'No se ha podido completar el registro. Revisa el formulario y vuelve a intentarlo.';
                    }

                    $_SESSION["aviso"] = "Usuario Modificado";
                    header('Location: index.php?ctl=dashboard_SU');
                } catch (Exception $e) {
                    error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
                    header('Location: index.php?ctl=error');
                } catch (Error $e) {
                    error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
                    header('Location: index.php?ctl=error');
                }
            }
        }
        require __DIR__ . '/templates/formModificarUsuario.php';
    }




    public function NuevoTicket()
    {
        $_SESSION["aviso"] = "";
        $m = new Model();
        $grupos = $m->Damegrupos();
        $usuarios = $m->DameUsuarios();
        $usuariosCU = $m->DameCU();
        $Estados = $m->DameEstados();



        $info = array(
            'grupos' => $grupos,
            'usuarios' => $usuarios,
            'usuariosCU' => $usuariosCU,
            'estados' => $Estados,
            'F_actual' => date('Y-m-d H:i:s')
        );

        $error = array();

        if (isset($_POST['enviar'])) {

            $tipo = recoge('tipo');
            $prioridad = recoge('prioridad');
            $F_apertura = $info['F_actual'];
            $solicitante = recoge('solicitante');
            $asignatario = recoge('asignatario');
            $Grupo = recoge('Grupo');
            $estado = 'EG';
            $resumen = recoge('resumen');
            $descripcion = recoge('descripcion');
            $F_modificacion = $info['F_actual'];


            $info = array(
                'tipo' => $tipo,
                'prioridad' => $prioridad,
                'solicitante' => $solicitante,
                'asignatario' => $asignatario,
                'Grupo' => $Grupo,
                'estado' => $estado,
                'resumen' => $resumen,
                'descripcion' => $descripcion,
                'grupos' => $grupos,
                'usuarios' => $usuarios,
                'usuariosCU' => $usuariosCU,
                'estados' => $Estados,
                'F_actual' => date('Y-m-d H:i:s')
            );


            //validación de campos
            $m = new Model();
            if (!($tipo == 'INC' || $tipo == 'SOL')) {
                $error["tipo"] = "tipo inexistente";
            }
            if (!$m->CompruebaUsuarioID($solicitante)) {
                $error["solicitante"] = "Solicitante inexistente";
            }
            if (!$m->CompruebaGrupoID($Grupo)) {
                $error["Grupo"] = "Grupo inexistente";
            }
            if (!($prioridad == 1 || $prioridad == 2 || $prioridad == 3 || $prioridad == 4)) {
                $error["prioridad"] = "Prioridad Incorrecta";
            }

            cTexto($resumen, 'resumen', $error, 500, 1);
            cTexto($descripcion, 'descripcion', $error, 2500, 1);

            //inserción en BBDD
            if (empty($error)) {
                try {
                    $m = new Model();

                    if (!$m->CrearTicket($tipo, $resumen, $descripcion, $estado, $F_modificacion, $F_apertura, $Grupo, $solicitante, $prioridad)) {
                        $_SESSION["aviso"] = 'No se ha podido completar el registro. Revisa el formulario y vuelve a intentarlo.';

                    } else {
                        $_SESSION["aviso"] = "Ticket Creado";
                        header('Location: index.php?ctl=dashboard_SU');
                    }
                } catch (Exception $e) {
                    error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
                    header('Location: index.php?ctl=error');
                } catch (Error $e) {
                    error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
                    header('Location: index.php?ctl=error');
                }
            }
        }
        require __DIR__ . '/templates/formNuevoTicket.php';
    }

    public function BuscarTicket()
    {
        $_SESSION["aviso"] = "";
        $m = new Model();
        $grupos = $m->Damegrupos();
        $usuarios = $m->DameUsuarios();
        $usuariosCU = $m->DameCU();
        $Estados = $m->DameEstados();
        $condicion = "";
        $error = array();


        $info = array(
            'grupos' => $grupos,
            'usuarios' => $usuarios,
            'usuariosCU' => $usuariosCU,
            'estados' => $Estados,
            'F_actual' => date('Y-m-d H:i:s')
        );


        if (isset($_POST['enviar'])) {

            $tipo = recoge('tipo');
            $prioridad = recoge('prioridad');
            $F_apertura = $info['F_actual'];
            $solicitante = recoge('solicitante');
            $asignatario = recoge('asignatario');
            $Grupo = recoge('Grupo');
            $estado = recoge('estado');
            $resumen = recoge('resumen');
            $descripcion = recoge('descripcion');
            $F_modificacion = $info['F_actual'];


            $info = array(
                'tipo' => $tipo,
                'prioridad' => $prioridad,
                'solicitante' => $solicitante,
                'asignatario' => $asignatario,
                'Grupo' => $Grupo,
                'estado' => $estado,
                'resumen' => $resumen,
                'descripcion' => $descripcion,
                'grupos' => $grupos,
                'usuarios' => $usuarios,
                'usuariosCU' => $usuariosCU,
                'estados' => $Estados,
                'F_actual' => date('Y-m-d H:i:s')
            );



            //validación de campos
            $m = new Model();
            if (($tipo == 'INC' || $tipo == 'SOL')) {
                $condicion = $condicion . "Tipo = '" . $tipo . "' AND ";
            }

            if ($m->CompruebaUsuarioID($solicitante)) {

                $condicion = $condicion . "Solicitante = '" . $solicitante . "' AND ";
            }
            if ($m->CompruebaUsuarioID($asignatario)) {

                $condicion = $condicion . "Asignatario = '" . $asignatario . "' AND ";
            }

            if ($m->CompruebaGrupoID($Grupo)) {
                $condicion = $condicion . "Grupo_resolutor = '" . $Grupo . "' AND ";
            }


            if ($m->CompruebaEstado($estado)) {
                $condicion = $condicion . "Estado = '" . $estado . "' AND ";
            }


            if ($prioridad == 1 || $prioridad == 2 || $prioridad == 3 || $prioridad == 4) {
                $condicion = $condicion . "Prioridad = '" . $prioridad . "' AND ";
            }


            cTexto($resumen, 'resumen', $error, 500, 1);
            cTexto($descripcion, 'descripcion', $error, 2500, 1);
            if (!isset($error['resumen'])) {
                $condicion = $condicion . "Resumen = '" . $resumen . "' AND ";
            }
            if (!isset($error['descripcion'])) {
                $condicion = $condicion . "Descripcion = '" . $descripcion . "' AND ";
            }

            //Consulta en BBDD


            $m = new Model();
            $_SESSION["tickets"] = $m->BuscarTickets($condicion);




            header('Location: index.php?ctl=ListaTickets');

        }
        require __DIR__ . '/templates/formBusucarTicket.php';
    }


    public function ListaTickets()
    {
        $_SESSION["aviso"] = "";
        if (isset($_SESSION["tickets"])) {
            $info['tickets'] = $_SESSION["tickets"];
            //$info['tickets'] = 'Hola';
        } else {
            $info['tickets'] = 'adios';
        }

        require __DIR__ . '/templates/listaTickets.php';
    }








    public function dashboard_C()
    {

        try {
            if (!isset($_SESSION["aviso"])) {
                $_SESSION["aviso"] = "Bienvenido estimado cliente";
            }

        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }

        require __DIR__ . '/templates/dashboard_C.php';
    }
    public function dashboard_U()
    {

        try {
            if (!isset($_SESSION["aviso"])) {
                $_SESSION["aviso"] = "Bienvenido estimado cliente";
            }



        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }

        require __DIR__ . '/templates/dashboard_U.php';
    }
    public function dashboard_SU()
    {

        try {
            if (!isset($_SESSION["aviso"])) {
                $_SESSION["aviso"] = "Bienvenido estimado Administrador";
            }

        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }

        require __DIR__ . '/templates/dashboard_SU.php';
    }

    public function NuevaPass()
    {
        $_SESSION["aviso"] = "";
        try {

            if (isset($_GET['Token'])) {

                $token = recoge('Token');
                $m = new Model();

                if ($token_info = $m->CompruebaToken($token)) {

                    $userID = $token_info[0]["Id_Usuario"];
                    $caducidad = $token_info[0]["Caducidad"];
                    $fecha = time();

                    if ($caducidad > $fecha) {
                        $_SESSION["ID"] = $userID;
                        header('Location: index.php?ctl=NuevaPass');
                    } else {
                        $_SESSION["aviso"] = "Tocken expirado";

                    }
                } else {
                    header('Location: index.php?ctl=error');
                }

            }
            if (isset($_POST['enviar'])) {

                $pass = recoge('pass');
                $repass = recoge('repass');
                $error = array();
                //validación de campos
                cPass($pass, "pass", $error);
                cReppass($repass, "repass", $pass, $error);

                if (empty($error)) {
                    try {
                        $m = new Model();
                        $m->CambiarPass($_SESSION["ID"], encriptar($pass));

                        header('Location: index.php?ctl=iniciar');


                    } catch (Exception $e) {
                        error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
                        header('Location: index.php?ctl=error');
                    } catch (Error $e) {
                        error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
                        header('Location: index.php?ctl=error');
                    }
                }
            }
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }
        require __DIR__ . '/templates/formNuevaPass.php';

    }

    public function solicitar()
    {
        $_SESSION["aviso"] = "";

        $error = array();
        if (isset($_POST['enviar'])) {

            $email = recoge('email');

            $info['email'] = $email;


            //validación de campos
            cEmail($email, "email", $error);
            $m = new Model();
            if (!$m->CompruebaUsuario($email)) {
                $error["email"] = "Correo no existe";
            }

            if (empty($error)) {
                try {
                    $m = new Model();

                    $token = tokenGen($email);
                    $usuario = $m->DameUsuarioId($email);
                    $usuarioID = $usuario["Id"];
                    $caducidad = time() + 604800; //7 Dias
                    $m->insertarToken($token, $usuarioID, $caducidad);
                    enviar_pass($email, $token);


                    header('Location: index.php?ctl=dashboard_SU');
                } catch (Exception $e) {
                    error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
                    header('Location: index.php?ctl=error');
                } catch (Error $e) {
                    error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
                    header('Location: index.php?ctl=error');
                }
            }
        }

        require __DIR__ . '/templates/formSolicitarPass.php';
    }
    public function ModificarTicket()
    {


        $_SESSION["aviso"] = "";

        if (isset($_GET['Id'])) {
            $Id_ticket = recoge('Id');
            $m = new Model();
            $infoTicket = $m->BuscarTicketId($Id_ticket);
            $_SESSION["infoTicket"] = $infoTicket;
            header('Location: index.php?ctl=ModificarTicket');
        }

        $m = new Model();
        $grupos = $m->Damegrupos();
        $usuarios = $m->DameUsuarios();
        $usuariosCU = $m->DameCU();
        $Estados = $m->DameEstados();



        $info = array(
            'infoTicket' => $_SESSION["infoTicket"],
            'grupos' => $grupos,
            'usuarios' => $usuarios,
            'usuariosCU' => $usuariosCU,
            'estados' => $Estados,
            'F_actual' => date('Y-m-d H:i:s')
        );

        $error = array();

        if (isset($_POST['enviar'])) {
            $tipo = recoge('tipo');
            $prioridad = recoge('prioridad');
            $solicitante = recoge('solicitante');
            $asignatario = recoge('asignatario');
            $Grupo = recoge('Grupo');
            $estado = recoge('estado');
            $resumen = recoge('resumen');
            $descripcion = recoge('descripcion');
            $F_modificacion = $info['F_actual'];


            $info = array(
                'tipo' => $tipo,
                'prioridad' => $prioridad,
                'solicitante' => $solicitante,
                'asignatario' => $asignatario,
                'Grupo' => $Grupo,
                'estado' => $estado,
                'resumen' => $resumen,
                'descripcion' => $descripcion,
                'grupos' => $grupos,
                'usuarios' => $usuarios,
                'usuariosCU' => $usuariosCU,
                'estados' => $Estados,
                'F_actual' => date('Y-m-d H:i:s')
            );


            //validación de campos
            $m = new Model();
            if (!($tipo == 'INC' || $tipo == 'SOL')) {
                $error["tipo"] = "tipo inexistente";
            }
            if (!$m->CompruebaUsuarioID($solicitante)) {
                $error["solicitante"] = "Solicitante inexistente";
            }
            if(!$asignatario==null){
                if (!$m->CompruebaTecnicoID($asignatario)) {
                    $error["asignatario"] = "Asignatario inexistente";
                }
            }
            

            if (!$m->CompruebaGrupoID($Grupo)) {
                $error["Grupo"] = "Grupo inexistente";
            }

            if (!($prioridad == 1 || $prioridad == 2 || $prioridad == 3 || $prioridad == 4)) {
                $error["prioridad"] = "Prioridad Incorrecta";
            }

            cTexto($resumen, 'resumen', $error, 500, 1);
            cTexto($descripcion, 'descripcion', $error, 2500, 1);


            //inserción en BBDD
            if (empty($error)) {
                try {
                    if ($estado == "C") {
                        $F_cierre = $info['F_actual'];
                    } else {
                        $F_cierre = null;
                    }

                    $m = new Model();

                    if (!$m->ModificarTicket($tipo, $resumen, $descripcion, $estado, $F_modificacion,$F_cierre, $Grupo, $solicitante, $prioridad,$asignatario,$_SESSION["infoTicket"][0]['Id'])) {
                   
                        $_SESSION["aviso"] = 'No se ha podido completar el registro. Revisa el formulario y vuelve a intentarlo.';

                    } else {
                        $_SESSION["aviso"] = "Ticket ".$_SESSION["infoTicket"][0]['Id']." Modificado";
                        header('Location: index.php?ctl=dashboard_SU');
                    }
                } catch (Exception $e) {
                    error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
                    header('Location: index.php?ctl=error');
                } catch (Error $e) {
                    error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
                    header('Location: index.php?ctl=error');
                }
            }
        }
        require __DIR__ . '/templates/formModificarTicket.php';
    }




}
