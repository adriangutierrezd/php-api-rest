<h1>Login</h1>
<div>
    <form action="<?= base_url ?>user/log" method="post">
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
            <button type="submit">Iniciar sesión</button>
        </div>
    </form>
</div>

<?php deleteErrors(); ?>