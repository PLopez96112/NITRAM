<?php ob_start() ?>

<?php

if ($_SESSION["sesionIniciada"] != 1) {
    header('Location: index.php?ctl=iniciar');
}
if ($_SESSION["Tipo"] != "SU") {
    header('Location: index.php?ctl=iniciar');
}

?>


<nav class="navbar navbar-expand-lg bg-Light">
    <div class="container-fluid">
    <a href="index.php?ctl=dashboard_SU"><img src="img/Logo.png" class="img-fluid" alt="NITRM"></a>
        

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Acciones
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.php?ctl=NuevoUsuario">Crear nuevo usuario</a></li>
                        <li><a class="dropdown-item" href="index.php?ctl=NuevoGrupo">Crear nuevo grupo</a></li>
                        <li><a class="dropdown-item" href="index.php?ctl=BuscarUsuario">Modificar Usuario</a></li>
                        <li><a class="dropdown-item" href="index.php?ctl=NuevoTicket">Crear Ticket</a></li>
                    </ul>
                </li>
            </ul>

            <a href="index.php?ctl=salir" class="btn btn-outline-success" role="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                    <path fill-rule="evenodd"
                        d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                </svg>
            </a>

        </div>
    </div>
</nav>

<?php 
if(isset($info['aviso'])){
    echo '<div class="alert alert-info" role="alert">';
    echo $info['aviso'];
    echo'</div>';
}
?>


<div id="contenido_SU">
<?php 

if(isset($contenido_SU)){
    echo $contenido_SU;
}


?>
</div>


<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>