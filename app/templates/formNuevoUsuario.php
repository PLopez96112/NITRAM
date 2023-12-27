<?php ob_start();
?>

<?php if (isset($info['aviso'])): ?>
    <b><span style="color: red;">
            <?php echo $info['aviso'] ?>
        </span></b>
<?php endif; ?>


<br />
<form name="formNuevoUsuario" action="index.php?ctl=NuevoUsuario" method="POST" class="d-flex justify-content-center">
    <div id="form">
        <div id="title" class="d-flex justify-content-center">
            <h2>Nuevo Usuario</h2>
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
            <div class="cell1 d-flex justify-content-center"><label for="apellidos">Apellidos</label></div>
            <div class="cell2 d-flex justify-content-center"><input type="text" name="apellidos" id="apellidos"
                    value="<?php echo $info['apellidos'] ?>" required /><br />

            </div>
        </div>
        <?php if (isset($error['apellidos'])){
                echo '<div class="row"><div class="alert alert-danger" role="alert">';
                echo $error['apellidos'];
                echo '</div></div>';
            }
            
            ?>

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

            <div class="cell1 d-flex justify-content-center"><label for="Tipo_Usuario">Tipo de Usuario</label></div>
            <div class="cell2 d-flex justify-content-center">
                <select name="tipo" id="tipo">
                    <option value="C">Cliente</option>
                    <option value="U">Usuario</option>
                    <option value="SU">Super Usuario</option>
                </select>
            </div>
        </div>
        <?php if (isset($error['Tipo'])){
                echo '<div class="row"><div class="alert alert-danger" role="alert">';
                echo $error['Tipo'];
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