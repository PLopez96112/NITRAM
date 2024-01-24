<?php ob_start();
?>
<form name="formBuscarUsuario" action="index.php?ctl=BuscarUsuario" method="POST" class="d-flex justify-content-center">
    <div id="form">
        <div id="title" class="d-flex justify-content-center">
            <h2>Buscar Usuario</h2>
        </div>

        <div class="row">
            <div class="cell1 d-flex justify-content-center"><label for="email">Email</label></div>
            <div class="cell2 d-flex justify-content-center"><input type="email" name="email" id="e-mail"
                    value="<?php echo $info['email'] ?>" required></div><br>
        </div>
        <?php if (isset($error['email'])){
                echo '<div class="row"><div class="alert alert-danger" role="alert">';
                echo $error['email'];
                echo '</div></div>';
            }
            
            ?>


        <div class="row">
            <div class="cell1 d-flex justify-content-center"></div>
            <div class="cell2 d-flex justify-content-center"><input type="submit" name="enviar" id="enviar"
                    value="Buscar"></div>
        </div>
    </div>
</form>
<?php $contenido_SU = ob_get_clean() ?>
<?php include 'dashboard_SU.php' ?>