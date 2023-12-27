<?php ob_start();
?>

<?php if (isset($info['aviso'])): ?>
    <b><span style="color: red;">
            <?php echo $info['aviso'] ?>
        </span></b>
<?php endif; ?>


<br />
<form name="formModificarUsuario" action="index.php?ctl=ModificarUsuario" method="POST"
    class="d-flex justify-content-center">
    <div id="form">
        <div id="title" class="d-flex justify-content-center">
            <h2>Modificar Usuario</h2>
        </div>

        <div class="row">
            <div class="cell1 d-flex justify-content-center"><label for="nombre">Nombre</label></div>
            <div class="cell2 d-flex justify-content-center"><input type="text" name="nombre" id="username"
                    value="<?php echo $info['nombre'] ?>" required /><br />

            </div>
        </div>


        <?php if (isset($error['nombre'])) {
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
        <?php if (isset($error['apellidos'])) {
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
        <?php if (isset($error['email'])) {
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
                <?php
                echo '
                <script>
                        document.getElementById("tipo").value="' . $info['tipo'] . '";

                </script>';
                ?>
            </div>
        </div>
        <?php if (isset($error['Tipo'])) {
            echo '<div class="row"><div class="alert alert-danger" role="alert">';
            echo $error['Tipo'];
            echo '</div></div>';
        }

        ?>
        <div class="row">

            <div class="cell1 d-flex justify-content-center"><label for="Tipo_Usuario">Grupo</label></div>
            <div class="cell2 d-flex justify-content-center">
                <?php

                    echo '<select name="Grupo" id="Grupo">';
                    
                    foreach  ($info['grupos'] as $fila) {
                        
                        echo '<option value="'.$fila["Id"].'">'.$fila["Nombre"].'</option>';
                    }
                    echo '</select>';
                    echo '
                    <script>
                            document.getElementById("Grupo").value="' . $info['grupo'] . '";

                    </script>';
                ?>
            </div>
        </div>
        <?php if (isset($error['Grupo'])) {
            echo '<div class="row"><div class="alert alert-danger" role="alert">';
            echo $error['Grupo'];
            echo '</div></div>';
        }

        ?>
        <div class="row">

            <div class="cell1 d-flex justify-content-center"><label for="Tipo_Usuario">Estado</label></div>
            <div class="cell2 d-flex justify-content-center">
                <select name="Estado" id="Estado">
                    <option value="0">Activo</option>
                    <option value="1">Inactivo</option>
                </select>
                <?php
                echo '
    <script>
            document.getElementById("Estado").value="' . $info['estado'] . '";

    </script>';
                ?>
            </div>
        </div>
        <?php if (isset($error["Estado"])) {
            echo '<div class="row"><div class="alert alert-danger" role="alert">';
            echo $error['Estado'];
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