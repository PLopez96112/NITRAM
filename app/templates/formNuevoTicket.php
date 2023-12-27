<?php ob_start();
?>

<?php if (isset($info['aviso'])): ?>
    <b><span style="color: red;">
            <?php echo $info['aviso'] ?>
        </span></b>
<?php endif; ?>


<br />
<form name="formNuevoTicket" action="index.php?ctl=NuevoTicket" method="POST">
    <div id="form">
        <div class="row ms-2 me-2 mb-3">
            <div class="col ms-2 me-2"><label for="Tipo">Tipo</label></div>
            <div class="col  ms-2 me-2"><label for="Prioridad">Prioridad</label></div>
            <div class="col  ms-2 me-2"><label for="Fecha de Apertura">Fecha de Apertura</label>
            </div>
        </div>
        <div class="row ms-2 me-2 mb-5">
            <div class="input-group">
                <select class="form-select col ms-2 me-2" name="tipo" id="tipo">
                    <option value="INC">Incidente</option>
                    <option value="SOL">Solicitud</option>
                </select>




                <select class="form-select col ms-2 me-2" name="prioridad" id="prioridad">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
                <input type="datetime" class="form-control col ms-2 me-2" name="F_apertura" id="F_apertura" disabled
                    value="<?php echo $info['F_actual']; ?>">
            </div>
        </div>

        <div class="row ms-2 me-2 mb-3">
            <?php if (isset($error['tipo'])) {
                echo '<div class="col ms-2 me-2"><div class="alert alert-danger" role="alert">';
                echo $error['tipo'];
                echo '</div></div>';
            }

            ?>

            <?php if (isset($error['prioridad'])) {
                echo '<div class="col ms-2 me-2"><div class="alert alert-danger" role="alert">';
                echo $error['prioridad'];
                echo '</div></div>';
            }

            ?>

            <?php if (isset($error['F_apertura'])) {
                echo '<div class="col ms-2 me-2"><div class="alert alert-danger" role="alert">';
                echo $error['F_apertura'];
                echo '</div></div>';
            }

            ?>


        </div>




        <div class="row ms-2 me-2 mb-3">
            <div class="col  ms-2 me-2"><label for="Solicitante">Solicitante</label></div>
            <div class="col  ms-2 me-2"><label for="Grupo">Grupo</label></div>
            <div class="col  ms-2 me-2"><label for="Estado">Estado</label></div>
        </div>
        <div class="row ms-2 me-2 mb-5">
            <div class="input-group">
                <?php

                echo '<select class="form-select col ms-2 me-2" name="solicitante" id="solicitante">';
                foreach ($info['usuariosCU'] as $fila) {

                    echo '<option value="' . $fila["Id"] . '">' . $fila["Nombre"] . " " . $fila["Apellidos"] . '</option>';
                }
                echo '</select>';
                ?>

                <?php

                echo '<select class="form-select col ms-2 me-2" name="Grupo" id="grupo">';
                foreach ($info['grupos'] as $fila) {

                    echo '<option value="' . $fila["Id"] . '">' . $fila["Nombre"] . '</option>';
                }
                echo '</select>';
                ?>
                <?php

                echo '<select class="form-select col ms-2 me-2" name="estado" id="estado" disabled>';
                foreach ($info['estados'] as $fila) {
                    if ($fila["Codigo"] == "EG") {
                        echo '<option value="' . $fila["Codigo"] . '" Selected>' . $fila["Nombre"] . '</option>';
                    }

                    echo '<option value="' . $fila["Codigo"] . '">' . $fila["Nombre"] . '</option>';
                }
                echo '</select>';
                ?>

            </div>
        </div>
        <div class="row ms-2 me-2 mb-3">
            <?php if (isset($error['solicitante'])) {
                echo '<div class="col ms-2 me-2"><div class="alert alert-danger" role="alert">';
                echo $error['solicitante'];
                echo '</div></div>';
            }

            ?>

            <?php if (isset($error['Grupo'])) {
                echo '<div class="col ms-2 me-2"><div class="alert alert-danger" role="alert">';
                echo $error['Grupo'];
                echo '</div></div>';
            }

            ?>

            <?php if (isset($error['estado'])) {
                echo '<div class="col ms-2 me-2"><div class="alert alert-danger" role="alert">';
                echo $error['estado'];
                echo '</div></div>';
            }

            ?>


        </div>



        <div class="row ms-2 me-2 mb-3">
            <div class="col  ms-2 me-2"><label for="Resumen">Resumen</label></div>
        </div>
        <div class="row ms-2 me-2 mb-5">
            <div class="form-floating col-12  ms-2 me-2">
                <textarea class="form-control" name="resumen" id="resumen"></textarea>
            </div>
        </div>

        <div class="row ms-2 me-2 mb-3">
            <?php if (isset($error['resumen'])) {
                echo '<div class="col ms-2 me-2"><div class="alert alert-danger" role="alert">';
                echo $error['resumen'];
                echo '</div></div>';
            }

            ?>


        </div>

        <div class="row ms-2 me-2 mb-3">
            <div class="col  ms-2 me-2"><label for="Descripcion">Descripcion</label></div>
        </div>
        <div class="row ms-2 me-2 mb-5">
            <div class="form-floating col-12  ms-2 me-2">
                <textarea class="form-control" name="descripcion" id="descripcion"></textarea>
            </div>
        </div>

        <div class="row ms-2 me-2 mb-3">
            <?php if (isset($error['descripcion'])) {
                echo '<div class="col ms-2 me-2"><div class="alert alert-danger" role="alert">';
                echo $error['descripcion'];
                echo '</div></div>';
            }

            ?>


        </div>

        <div class="row ms-2 me-2 mb-3">
            <div class="col  ms-2 me-2"><label for="Descripcion">Ultima modificacion</label></div>
            <div class="col  ms-2 me-2"><label for="Descripcion">Fecha de Cierre</label></div>
        </div>
        <div class="row ms-2 me-2 mb-5">
            <div class="input-group">
                <input type="datetime" class="form-control col ms-2 me-2" name="F_modificacion" id="F_modificacion"
                    value="<?php echo $info['F_actual']; ?>" disabled>
                <input type="datetime" class="form-control col ms-2 me-2" name="F_cierre" id="F_cierre" disabled>
            </div>
        </div>
        <div class="row ms-2 me-2 mb-3">
            <?php if (isset($error['F_modificacion'])) {
                echo '<div class="col ms-2 me-2"><div class="alert alert-danger" role="alert">';
                echo $error['F_modificacion'];
                echo '</div></div>';
            }

            ?>
            <?php if (isset($error['F_cierre'])) {
                echo '<div class="col ms-2 me-2"><div class="alert alert-danger" role="alert">';
                echo $error['F_cierre'];
                echo '</div></div>';
            }

            ?>


        </div>

        <div class="row">
            <div class="cell2 d-flex justify-content-center"><input type="submit" class="btn btn-outline-success"
                    name="enviar" id="enviar" value="Crear"></div>
        </div>


    </div>
</form>
<?php $contenido_SU = ob_get_clean() ?>
<?php include 'dashboard_SU.php' ?>