<?php ob_start();
?>

<br />
<form name="formSolicitarPass" action="index.php?ctl=solicitar" method="POST" class="d-flex justify-content-center">
    <div id="form">
        <div id="title" class="d-flex justify-content-center">
            <h2>He olvidado mi contraceña</h2>
        </div>
       
        <div class="row">
            <div class="cell1 d-flex justify-content-center"><label for="email">Email</label></div>
            <div class="cell2 d-flex justify-content-center"><input type="email" name="email" id="e-mail" required></div><br>
        </div>

        <div class="row">
            <div class="cell1 d-flex justify-content-center"></div>
            <div class="cell2 d-flex justify-content-center"><input type="submit" name="enviar" id="enviar"
                    value="Enviar"></div>
        </div>
    </div>
</form>
<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>