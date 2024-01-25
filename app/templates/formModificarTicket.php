<?php ob_start();
?>
<form name="formModificarTicket" action="index.php?ctl=ModificarTicket" method="POST">
    <div id="form">
        <div class="row ms-1 mb-2 me-2">
            <div class="col-12 col-sm ms-2 me-2">
                <div class="row ms-1 mb-2 me-2">
                    <div class="col ms-2 me-2"><label for="Tipo">Tipo</label></div>
                </div>
                <div class="row ms-1 mb-2 me-2">
                    <select class="form-select col ms-2 me-2" name="tipo" id="tipo">

                        <?php
                        if($info['infoTicket'][0]['Tipo'] == "INC"){
                            echo'<option value="INC" selected>Incidente</option>
                            <option value="SOL">Solicitud</option>';
                        }else{
                            echo'<option value="INC" >Incidente</option>
                            <option value="SOL" selected>Solicitud</option>';
                        }
                        ?>
                        
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

                        <?php
                        

                        if($info['infoTicket'][0]['Prioridad'] == "1"){
                            echo '
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            ';
                        }
                        if($info['infoTicket'][0]['Prioridad'] == "2"){
                            echo '
                            <option value="1">1</option>
                            <option value="2" selected>2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            ';
                        }
                        if($info['infoTicket'][0]['Prioridad'] == "3"){
                            echo '
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3" selected>3</option>
                            <option value="4">4</option>
                            ';
                        }
                        if($info['infoTicket'][0]['Prioridad'] == "4"){
                            echo '
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4" selected>4</option>
                            ';
                        }
                        ?>
                        
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
                    <input type="datetime" class="form-control col ms-2 me-2" name="F_apertura" id="F_apertura" disabled
                        value="<?php echo $info['infoTicket'][0]['Fecha_Apertura']; ?>">
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
                    foreach ($info['usuariosCU'] as $fila) {

                        if($fila["Id"]==$info['infoTicket'][0]['Solicitante']){
                            echo '<option value="' . $fila["Id"] . '" selected>' . $fila["Nombre"] . " " . $fila["Apellidos"] . '</option>'; 
                        }else{
                            echo '<option value="' . $fila["Id"] . '">' . $fila["Nombre"] . " " . $fila["Apellidos"] . '</option>';
                        }
                        
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
                    foreach ($info['grupos'] as $fila) {


                        if($fila["Id"]==$info['infoTicket'][0]['Grupo_resolutor']){
                            echo '<option value="' . $fila["Id"] . '" selected>' . $fila["Nombre"] . '</option>';
                        }else{
                            echo '<option value="' . $fila["Id"] . '">' . $fila["Nombre"] . '</option>';
                        }
                        
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
                    <?php echo '<select class="form-select col ms-2 me-2" name="estado" id="estado">';
                    foreach ($info['estados'] as $fila) {
                        if ($fila["Codigo"] == $info['infoTicket'][0]['Estado']) {
                            echo '<option value="' . $fila["Codigo"] . '" Selected>' . $fila["Nombre"] . '</option>';
                        }else{
                            echo '<option value="' . $fila["Codigo"] . '">' . $fila["Nombre"] . '</option>';
                        }

                        
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
                
                <?php echo '<select class="form-select col ms-2 me-2" name="asignatario" id="asignatario">';
                        echo '<option value=""></option>';
                    foreach ($info['usuarios'] as $fila) {

                        if($fila["Id"]==$info['infoTicket'][0]['Asignatario']){
                            echo '<option value="' . $fila["Id"] . '" selected>' . $fila["Nombre"] . " " . $fila["Apellidos"] . '</option>';
                        }else{
                            echo '<option value="' . $fila["Id"] . '">' . $fila["Nombre"] . " " . $fila["Apellidos"] . '</option>';
                        }

                        
                    }
                    echo '</select>';
                    ?>

                </div>
                <div class="row ms-1 mb-2 me-2 ">
                <?php if (isset($error['estado'])) {
                        echo '<div class="col ms-2 me-2"><div class="alert alert-danger" role="alert">';
                        echo $error['asignatario'];
                        echo '</div></div>';
                    } ?>

                </div>
            </div>
        </div>

        <div class="row ms-1 mb-2 me-2">
            <div class="col-12 col-sm ms-2 me-2">
                <div class="row ms-1 mb-2 me-2 ">
                    <div class="col  ms-2 me-2"><label for="Resumen">Resumen</label></div>
                </div>
                <div class="row ms-1 mb-2 me-2 ">
                    <textarea class="form-control" name="resumen" id="resumen"><?php echo $info['infoTicket'][0]['Resumen'];?></textarea>
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
                    <textarea class="form-control" name="descripcion" id="descripcion"><?php echo $info['infoTicket'][0]['Descripcion'];?></textarea>
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
                    <input type="datetime" class="form-control col ms-2 me-2" name="F_modificacion" id="F_modificacion"
                        value="<?php echo $info['infoTicket'][0]['Fecha_Ultima_actualizacion']; ?>" disabled>

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
                    <?php
                        if($info['infoTicket'][0]['Fecha_Cierre']==""){
                            echo'<input type="datetime" class="form-control col ms-2 me-2" name="F_cierre" id="F_cierre" disabled>';
                        }else{
                            echo'<input type="datetime" class="form-control col ms-2 me-2" name="F_cierre" id="F_cierre" value="'.$info['infoTicket'][0]['Fecha_Cierre'].'" disabled>';
                        }
                    ?>
                    

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
                    name="enviar" id="enviar" value="Modificar"></div>
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