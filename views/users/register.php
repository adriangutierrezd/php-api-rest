<h1>Registro</h1>
<div>
    <form action="<?= base_url ?>user/save" method="post">
        <div>
            <label for="username">Nombre de usuario:</label>
            <input type="text" name="username" id="username" required>
            <span class="form-error"> <?= showError('username') ?></span>
        </div>
        <div>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>
            <span class="form-error"> <?= showError('password') ?></span>
        </div>
        <div>
            <label for="passwordRepeat">Repetir contraseña:</label>
            <input type="password" name="passwordRepeat" id="passwordRepeat" required>
            <span class="form-error"> <?= showError('passwordRepeat') ?></span>
        </div>
        <div>
            <button type="submit">Crear cuenta</button>
        </div>
    </form>
</div>

<?php deleteErrors(); ?>