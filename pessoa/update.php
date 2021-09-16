<?php

require '../class/dbConnection.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: ../index.php");
}

if (!empty($_POST)) {

    $nomeErro = null;
    $enderecoErro = null;
    $telefoneCelularErro = null;
    $emailErro = null;
    $sexoErro = null;

    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $cep = $_POST['cep'];
    $telefoneCelular = $_POST['telefoneCelular'];
    $telefoneResidencial = $_POST['telefoneResidencial'];
    $email = $_POST['email'];
    $sexo = $_POST['sexo'];
    $observacoes = $_POST['observacoes'];

    $validacao = true;
    if (empty($nome)) {
        $nomeErro = 'Por favor digite o nome!';
        $validacao = false;
    }

    if (empty($email)) {
        $emailErro = 'Por favor digite o email!';
        $validacao = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErro = 'Por favor digite um email válido!';
        $validacao = false;
    }

    if (empty($endereco)) {
        $enderecoErro = 'Por favor digite o endereço!';
        $validacao = false;
    }

    if (empty($cep)) {
        $cepErro = 'Por favor digite o CEP!';
        $validacao = false;
    }

    if (empty($telefoneCelular)) {
        $telefoneCelularErro = 'Por favor digite o telefone celular!';
        $validacao = false;
    }

    if (empty($sexo)) {
        $sexoErro = 'Por favor preenche o campo!';
        $validacao = false;
    }

    if ($validacao) {
        $pdo = DbConnection::open();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE pessoa  set Nome = ?, Endereco = ?, Cep = ?, TelefoneCelular = ?, TelefoneResidencial = ?, Email = ?, Sexo = ?, Observacoes = ? WHERE Id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $endereco, $cep, $telefoneCelular, $telefoneResidencial, $email, $sexo, $observacoes, $id));
        DbConnection::close();
        header("Location: list.php");
    }
} else {
    $pdo = DbConnection::open();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM pessoa where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    $nome = $data['Nome'];
    $endereco = $data['Endereco'];
    $cep = $data['Cep'];
    $telefoneCelular = $data['TelefoneCelular'];
    $telefoneResidencial = $data['TelefoneResidencial'];
    $email = $data['Email'];
    $sexo = $data['Sexo'];
    $observacoes = $data['Observacoes'];

    DbConnection::close();
}
?>

<?php
include('../partials/header.php');
?>

<div class="container">

    <div class="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well"> Atualizar Contato </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="update.php?id=<?php echo $id ?>" method="post">

                    <div class="control-group <?php echo !empty($nomeErro) ? 'error' : ''; ?>">
                        <label class="control-label">Nome</label>
                        <div class="controls">
                            <input name="nome" class="form-control" size="100" type="text" placeholder="Nome" value="<?php echo !empty($nome) ? $nome : ''; ?>">
                            <?php if (!empty($nomeErro)) : ?>
                                <span class="text-danger"><?php echo $nomeErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($enderecoErro) ? 'error' : ''; ?>">
                        <label class="control-label">Endereço</label>
                        <div class="controls">
                            <input name="endereco" class="form-control" size="150" type="text" placeholder="Endereço" value="<?php echo !empty($endereco) ? $endereco : ''; ?>">
                            <?php if (!empty($enderecoErro)) : ?>
                                <span class="text-danger"><?php echo $enderecoErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>


                    <div class="control-group <?php echo !empty($cepErro) ? 'error' : ''; ?>">
                        <label class="control-label">CEP</label>
                        <div class="controls">
                            <input name="cep" class="form-control" size="7" type="text" placeholder="CEP" value="<?php echo !empty($cep) ? $cep : ''; ?>">
                            <?php if (!empty($cepErro)) : ?>
                                <span class="text-danger"><?php echo $cepErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($telefoneCelularErro) ? 'error' : ''; ?>">
                        <label class="control-label">Celular</label>
                        <div class="controls">
                            <input name="telefoneCelular" class="form-control" size="13" type="text" placeholder="Telefone Celular" value="<?php echo !empty($telefoneCelular) ? $telefoneCelular : ''; ?>">
                            <?php if (!empty($telefoneCelularErro)) : ?>
                                <span class="text-danger"><?php echo $telefoneCelularErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($telefoneResidencialErro) ? 'error' : ''; ?>">
                        <label class="control-label">Residencial</label>
                        <div class="controls">
                            <input name="telefoneResidencial" class="form-control" size="13" type="text" placeholder="Telefone Residencial" value="<?php echo !empty($telefoneResidencial) ? $telefoneResidencial : ''; ?>">
                            <?php if (!empty($telefoneResidencialErro)) : ?>
                                <span class="text-danger"><?php echo $telefoneResidencialErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($emailErro) ? 'error' : ''; ?>">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input name="email" class="form-control" size="150" type="text" placeholder="Email" value="<?php echo !empty($email) ? $email : ''; ?>">
                            <?php if (!empty($emailErro)) : ?>
                                <span class="text-danger"><?php echo $emailErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($sexoErro) ? 'error' : ''; ?>">
                        <label class="control-label">Sexo</label>
                        <div class="controls">
                            <div class="form-check">
                                <p class="form-check-label">
                                    <input class="form-check-input" type="radio" name="sexo" id="sexo" value="M" <?php echo ($sexo == "M") ? "checked" : null; ?> /> Masculino
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexo" id="sexo" value="F" <?php echo ($sexo == "F") ? "checked" : null; ?> /> Feminino
                            </div>
                            </p>
                            <?php if (!empty($sexoErro)) : ?>
                                <span class="text-danger"><?php echo $sexoErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($observacoesErro) ? 'error' : ''; ?>">
                        <label class="control-label">Observações</label>
                        <div class="controls">
                            <input name="observacoes" class="form-control" size="250" type="text" placeholder="Observações. máx 250 caracteres" value="<?php echo !empty($observacoes) ? $observacoes : ''; ?>">
                            <?php if (!empty($observacoesErro)) : ?>
                                <span class="text-danger"><?php echo $observacoesErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <br />
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning">Update</button>
                        <a href="list.php" type="btn" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include('../partials/footer.php');
?>