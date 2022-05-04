<h1>Hola, <?= $_SESSION['login']->username ?></h1>
<p>Este es tu token para hacer consultas tipo INSERT, DELETE Y UPDATE a esta API:</p>
<p class="api-doc"><?= $token ?></p>