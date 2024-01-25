<?php ob_start();
?>
<div class="container text-center">
    <div class="row align-items-start border-bottom border-primary">
        <div class="col">
            <label for="Id">Numero de Referencia</label>
        </div>
        <div class="col">
            <label for="Tipo">Tipo</label>
        </div>
        <div class="col">
            <label for="Prioridad">Prioridad</label>
        </div>
        <div class="col">
            <label for="Resumen">Resumen</label>
        </div>
        <div class="col">
            <label for="Descripcion">Descripcion</label>
        </div>
        <div class="col">
            <label for="Estado">Estado</label>
        </div>
        <div class="col">
            <label for="Fecha_Ultima_actualizacion">Fecha de actualizacion</label>
        </div>
        <div class="col">
            <label for="Fecha_Apertura">Fecha de apertura</label>
        </div>
        <div class="col">
            <label for="Fecha_Cierre">Fecha de Cierre</label>
        </div>
    </div>
    <?php
    if (isset($info['tickets'])) {

        foreach ($info['tickets'] as $fila) {

            echo '
            <div class="row align-items-start border-bottom border-dark mt-5">
        <div class="col">
            <label for="' . $fila["Id"] . '"><a href="index.php?ctl=ModificarTicket&Id=' . $fila["Id"] . '">' . $fila["Id"] . '</a></label>
        </div>
        <div class="col">
            <label for="' . $fila["Tipo"] . '">' . $fila["Tipo"] . '</label>
        </div>
        <div class="col">
            <label for="' . $fila["Prioridad"] . '">' . $fila["Prioridad"] . '</label>
        </div>
        <div class="col">
            <label for="' . $fila["Resumen"] . '">' . $fila["Resumen"] . '</label>
        </div>
        <div class="col">
            <label for="' . $fila["Descripcion"] . '">' . $fila["Descripcion"] . '</label>
        </div>
        <div class="col">
            <label for="' . $fila["Estado"] . '">' . $fila["Estado"] . '</label>
        </div>
        <div class="col">
            <label for="' . $fila["Fecha_Ultima_actualizacion"] . '">' . $fila["Fecha_Ultima_actualizacion"] . '</label>
        </div>
        <div class="col">
            <label for="' . $fila["Fecha_Apertura"] . '">' . $fila["Fecha_Apertura"] . '</label>
        </div>
        <div class="col">
            <label for="' . $fila["Fecha_Cierre"] . '">' . $fila["Fecha_Cierre"] . '</label>
        </div>
        </div>
            
            ';

        }
    }

    ?>
</div>
<?php $contenido_SU = ob_get_clean() ?>
<?php 
if($_SESSION["Tipo"] == "SU"){
    include 'dashboard_SU.php';
}else if($_SESSION["Tipo"] == "U"){
    include 'dashboard_U.php' ;
}else if($_SESSION["Tipo"] == "C"){
    include 'dashboard_C.php' ;
}
?>