<?php ob_start() ?>
<?php if (isset($info['aviso'])): ?>
    <b><span style="color: red;">
            <?php echo $info['aviso'] ?>
        </span></b>
<?php endif; ?>
<br />

<form name="form_login" action="index.php?ctl=iniciar" method="POST" class="d-flex justify-content-center">
    <div id="form">
        <div id="title" class="d-flex justify-content-center">
        <img src="img/Logo.png" class="img-fluid" alt="NITRM">
        </div>
        <div class="row">
            <div class="cell1"><label for="email" class="d-flex justify-content-center">Email</label></div>
            <div class="cell2 d-flex justify-content-center"><input type="text" name="email" id="e-mail"
                    value="<?php echo $info['email'] ?>" required /><br />
                <span></span>
            </div>
        </div>
        <div class="row">
            <div class="cell1"><label for="password" class="d-flex justify-content-center">Contraseña</label></div>
            <div class="cell2 d-flex justify-content-center"><input type="password" name="password" id="pass"
                    required><br>
            </div>
        </div>
        <div class="row">
            <a href="index.php?ctl=solicitar" class="d-flex justify-content-center"> He olvidado mi contraceña</a>
        </div>
        <div class="row">
            <div class="cell2 d-flex justify-content-center">
                <input type="submit" name="iniciar" id="send" value="Iniciar">
            </div>
        </div>
        
        <div class="row">
            <span id="errorLogin" class= "d-flex justify-content-center">
                <?php
                echo $info['error'];
                ?>
            </span>
        </div>

    </div>
</form>

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>