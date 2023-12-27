<?php ob_start();
?>

<?php if (isset($info['aviso'])): ?>
    <b><span style="color: red;">
            <?php echo $info['aviso'] ?>
        </span></b>
<?php endif; ?>


<br />
<form name="formNuevoGrupo" action="index.php?ctl=NuevoGrupo" method="POST" class="d-flex justify-content-center">
    <div id="form">
        <div id="title" class="d-flex justify-content-center">
            <h2>Nuevo Grupo</h2>
        </div>

        <div class="row">
            <div class="cell1 d-flex justify-content-center"><label for="nombre">Nombre</label></div>
            <div class="cell2 d-flex justify-content-center"><input type="text" name="nombre" id="username"
                    value="<?php echo $info['nombre'] ?>" required /><br />

            </div>
        </div>
        

            <?php if (isset($error['nombre'])){
                echo '<div class="row"><div class="alert alert-danger" role="alert">';
                echo $error['nombre'];
                echo '</div></div>';
            }
            
            ?>


        <div class="row">
            <div class="cell1 d-flex justify-content-center"></div>
            <div class="cell2 d-flex justify-content-center"><input type="submit" name="enviar" id="enviar"
                    value="Enviar"></div>
        </div>
    </div>
</form>
<?php $contenido_SU = ob_get_clean() ?>
<?php include 'dashboard_SU.php' ?>