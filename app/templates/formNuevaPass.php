<?php ob_start();
?>
<?php if (isset($info['aviso'])): ?>
    <b><span style="color: red;">
            <?php echo $info['aviso'] ?>
        </span></b>
<?php endif; ?>
<form name="formNuevaPass" action="index.php?ctl=NuevaPass" method="POST" class="d-flex justify-content-center">
    <div id="form">
        <div id="title" class="d-flex justify-content-center">
            <h2>Establecer Contraseña</h2>
        </div>

        <div class="row">
            <div class="cell1 d-flex justify-content-center"><label for="nombre">Contaseña</label></div>
            <div class="cell2 d-flex justify-content-center"><input type="password"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$@¿?¡!_-]).{8,20}" name="pass" required /><br />

            </div>
        </div>


        <?php if (isset($error['pass'])) {
            echo '<div class="row"><div class="alert alert-danger" role="alert">';
            echo $error['pass'];
            echo '</div></div>';
        }

        ?>

        <div class="row">
            <div class="cell1 d-flex justify-content-center"><label for="apellidos">Repetir contaseña </label></div>
            <div class="cell2 d-flex justify-content-center"><input type="password"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$@¿?¡!_-]).{8,20}" name="repass" required /><br />

            </div>
        </div>
        <?php if (isset($error['repass'])) {
            echo '<div class="row"><div class="alert alert-danger" role="alert">';
            echo $error['repass'];
            echo '</div></div>';
        }

        ?>
        <div class="row">
            <div class="cell1 d-flex justify-content-center"></div>
            <div class="cell2 d-flex justify-content-center"><input type="submit" name="enviar" id="enviar"
                    value="Enviar"></div>
        </div>


</form>
<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>