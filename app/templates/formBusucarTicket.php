<?php ob_start();
?>
<form name="formBuscarTicket" action="index.php?ctl=BuscarTicket" method="POST">
    <div id="form">
        <div class="row ms-1 mb-2 me-2">
            <div class="col-12 col-sm ms-2 me-2">
                <div class="row ms-1 mb-2 me-2">
                    <div class="col ms-2 me-2"><label for="Tipo">Tipo</label></div>
                </div>
                <div class="row ms-1 mb-2 me-2">
                    <select class="form-select col ms-2 me-2" name="tipo" id="tipo">
                        <option value="null"></option>
                        <option value="INC">Incidente</option>
                        <option value="SOL">Solicitud</option>
                    </select>
                </div>
                <div class="row ms-1 mb-2 me-2">
                    <?php if (isset($error['tipo'])) {
                        echo '<div class="col ms-2 me-2"><div class="alert alert-danger" role="alert">';
                        echo $error['tipo'];
                        echo '</div></div>';
                    }

                    ?>
                </div>
            </div>
            <div class="col-12 col-sm ms-2 me-2">
                <div class="row ms-1 mb-2 me-2">
                    <div class="col  ms-2 me-2"><label for="Prioridad">Prioridad</label></div>
                </div>
                <div class="row ms-1 mb-2 me-2">
                    <select class="form-select col ms-2 me-2" name="prioridad" id="prioridad">
                        <option value="null"></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>

                <div class="row ms-1 mb-2 me-2">
                    <?php if (isset($error['prioridad'])) {
                        echo '<div class="col ms-2 me-2"><div class="alert alert-danger" role="alert">';
                        echo $error['prioridad'];
                        echo '</div></div>';
                    } ?>
                </div>
            </div>
            
            <div class="col-12 col-sm ms-2 me-2">
                <div class="row ms-1 mb-2 me-2">
                    <div class="col  ms-2 me-2"><label for="Fecha de Apertura">Fecha de Apertura</label></div>
                </div>
                <div class="row ms-1 mb-2 me-2 ">
                    <input type="datetime" class="form-control col ms-2 me-2" name="F_apertura" id="F_apertura" placeholder="aaaa-mm-dd hh:mm:ss" disabled>
                </div>
                <div class="row ms-1 mb-2 me-2 ">
                    <?php if (isset($error['F_apertura'])) {
                        echo '<div class="col ms-2 me-2"><div class="alert alert-danger" role="alert">';
                        echo $error['F_apertura'];
                        echo '</div></div>';
                    } ?>
                </div>
            </div>
            
        </div>





        <div class="row ms-1 mb-2 me-2">
            <div class="col-12 col-sm ms-2 me-2">
                <div class="row ms-1 mb-2 me-2 ">
                    <div class="col  ms-2 me-2"><label for="Solicitante">Solicitante</label></div>
                </div>
                <div class="row ms-1 mb-2 me-2 ">
                    
                    <?php echo '<select class="form-select col ms-2 me-2" name="solicitante" id="solicitante">';
                         echo '<option value="null"></option>';
                    foreach ($info['usuariosCU'] as $fila) {

                        echo '<option value="' . $fila["Id"] . '">' . $fila["Nombre"] . " " . $fila["Apellidos"] . '</option>';
                    }
                    echo '</select>';
                    ?>

                </div>
                <div class="row ms-1 mb-2 me-2 ">
                    <?php if (isset($error['solicitante'])) {
                        echo '<div class="col ms-2 me-2"><div class="alert alert-danger" role="alert">';
                        echo $error['solicitante'];
                        echo '</div></div>';
                    } ?>

                </div>
            </div>

            <div class="col-12 col-sm ms-2 me-2">
                <div class="row ms-1 mb-2 me-2 ">
                    <div class="col  ms-2 me-2"><label for="Grupo">Grupo</label></div>
                </div>
                <div class="row ms-1 mb-2 me-2 ">
                    <?php echo '<select class="form-select col ms-2 me-2" name="Grupo" id="grupo">';
                    echo '<option value="null"></option>';
                    foreach ($info['grupos'] as $fila) {

                        echo '<option value="' . $fila["Id"] . '">' . $fila["Nombre"] . '</option>';
                    }
                    echo '</select>';
                    ?>

                </div>
                <div class="row ms-1 mb-2 me-2 ">
                    <?php if (isset($error['Grupo'])) {
                        echo '<div class="col ms-2 me-2"><div class="alert alert-danger" role="alert">';
                        echo $error['Grupo'];
                        echo '</div></div>';
                    } ?>

                </div>
            </div>
            <div class="col-12 col-sm ms-2 me-2">
                <div class="row ms-1 mb-2 me-2 ">
                    <div class="col  ms-2 me-2"><label for="Estado">Estado</label></div>
                </div>
                <div class="row ms-1 mb-2 me-2 ">
                    <?php echo '<select class="form-select col ms-2 me-2" name="estado" id="estado" >';
                    echo '<option value="null"></option>';
                    foreach ($info['estados'] as $fila) {
                        echo '<option value="' . $fila["Codigo"] . '">' . $fila["Nombre"] . '</option>';
                    }
                    echo '</select>';
                    ?>

                </div>
                <div class="row ms-1 mb-2 me-2 ">
                    <?php if (isset($error['estado'])) {
                        echo '<div class="col ms-2 me-2"><div class="alert alert-danger" role="alert">';
                        echo $error['estado'];
                        echo '</div></div>';
                    } ?>

                </div>
            </div>
            <div class="col-12 col-sm  ms-2 me-2">
                <div class="row ms-1 mb-2 me-2 ">
                    <div class="col  ms-2 me-2"><label for="Estado">Asignatario</label></div>
                </div>
                <div class="row ms-1 mb-2 me-2 ">
                
                <?php echo '<select class="form-select col ms-2 me-2" name="solicitante" id="solicitante">';
                        echo '<option value=""></option>';
                    foreach ($info['usuarios'] as $fila) {

                        echo '<option value="' . $fila["Id"] . '">' . $fila["Nombre"] . " " . $fila["Apellidos"] . '</option>';
                    }
                    echo '</select>';
                    ?>

                </div>
                <div class="row ms-1 mb-2 me-2 ">


                </div>
            </div>
        </div>

        <div class="row ms-1 mb-2 me-2">
            <div class="col-12 col-sm ms-2 me-2">
                <div class="row ms-1 mb-2 me-2 ">
                    <div class="col  ms-2 me-2"><label for="Resumen">Resumen</label></div>
                </div>
                <div class="row ms-1 mb-2 me-2 ">
                    <textarea class="form-control" name="resumen" id="resumen"></textarea>
                </div>
                <div class="row ms-1 mb-2 me-2 ">
                    <?php if (isset($error['resumen'])) {
                        echo '<div class="col ms-6 me-6"><div class="alert alert-danger" role="alert">';
                        echo $error['resumen'];
                        echo '</div></div>';
                    } ?>
                </div>
            </div>
        </div>
        <div class="row ms-1 mb-2 me-2">
            <div class="col-12 col-sm ms-2 me-2">
                <div class="row ms-1 mb-2 me-2">
                    <div class="col  ms-2 me-2"><label for="Descripcion">Descripcion</label></div>
                </div>
                <div class="row ms-1 mb-2 me-2">
                    <textarea class="form-control" name="descripcion" id="descripcion"></textarea>
                </div>
                <div class="row ms-1 mb-2 me-2">
                    <?php if (isset($error['descripcion'])) {
                        echo '<div class="col ms-6 me-6"><div class="alert alert-danger" role="alert">';
                        echo $error['descripcion'];
                        echo '</div></div>';
                    } ?>
                </div>
            </div>
        </div>



        <div class="row ms-1 mb-2 me-2">
            <div class="col-12 col-sm ms-2 me-2">
                <div class="row ms-1 mb-2 me-2">
                    <div class="col  ms-2 me-2"><label for="Descripcion">Ultima modificacion</label></div>
                </div>
                <div class="row ms-1 mb-2 me-2">
                    <input type="datetime" class="form-control col ms-2 me-2" name="F_modificacion" id="F_modificacion" placeholder="aaaa-mm-dd hh:mm:ss" disabled>

                </div>
                <div class="row ms-1 mb-2 me-2">
                    <?php if (isset($error['F_modificacion'])) {
                        echo '<div class="col ms-2 me-2"><div class="alert alert-danger" role="alert">';
                        echo $error['F_modificacion'];
                        echo '</div></div>';
                    } ?>

                </div>
            </div>
            <div class="col-12 col-sm ms-2 me-2">
                <div class="row ms-1 mb-2 me-2">
                    <div class="col  ms-2 me-2"><label for="Descripcion">Fecha de Cierre</label></div>
                </div>
                <div class="row ms-1 mb-2 me-2 ">
                    <input type="datetime" class="form-control col ms-2 me-2" name="F_cierre" id="F_cierre" placeholder="aaaa-mm-dd hh:mm:ss" disabled>

                </div>
                <div class="row ms-1 mb-2 me-2 ">
                    <?php if (isset($error['F_cierre'])) {
                        echo '<div class="col ms-2 me-2"><div class="alert alert-danger" role="alert">';
                        echo $error['F_cierre'];
                        echo '</div></div>';
                    } ?>

                </div>
            </div>
        </div>
        <div class="row ms-1 mb-2 me-2">
            <div class="cell2 d-flex justify-content-center"><input type="submit" class="btn btn-outline-success"
                    name="enviar" id="enviar" value="Buscar"></div>
        </div>


    </div>
</form>
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