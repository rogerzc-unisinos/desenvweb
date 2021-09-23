<?php
session_start();
include('./partials/header.php');
?>

<div class="d-flex justify-content-center text-center">
    <form class="form-signin" action="login.php" method="POST">
        <br>
        <h1 class="h3 mb-3 font-weight-bold">Login</h1>
        <label for="inputUsuario" class="sr-only">Usuário</label>
        <input type="text" id="inputUsuario" name="usuario" class="form-control" placeholder="Usuário" required="true" autofocus="true">
        <label for="inputSenha" class="sr-only">Senha</label>
        <input type="password" id="inputSenha" name="senha" class="form-control" placeholder="Senha" required="true">
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
        <p class="mt-5 mb-3 text-muted">© 2021</p>
    </form>
</div>

<?php
include('./partials/footer.php');
?>