<?php
include('../partials/header.php');
?>

<?php
require '../class/dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeErro = null;
    $enderecoErro = null;
    $cepErro = null;
    $telefoneCelularErro = null;
    $emailErro = null;
    $sexoErro = null;

    if (!empty($_POST)) {
        $validacao = True;
        $novoUsuario = False;
        if (!empty($_POST['nome'])) {
            $nome = $_POST['nome'];
        } else {
            $nomeErro = 'Por favor digite o seu nome!';
            $validacao = False;
        }


        if (!empty($_POST['endereco'])) {
            $endereco = $_POST['endereco'];
        } else {
            $enderecoErro = 'Por favor digite o seu endereço!';
            $validacao = False;
        }

        $cep = $_POST['cep'];

        if (!empty($_POST['telefoneCelular'])) {
            $telefoneCelular = $_POST['telefoneCelular'];
        } else {
            $telefoneCelularErro = 'Por favor digite o número do telefone celular!';
            $validacao = False;
        }

        $telefoneResidencial = $_POST['telefoneResidencial'];

        if (!empty($_POST['email'])) {
            $email = $_POST['email'];
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $emailErro = 'Por favor digite um endereço de email válido!';
                $validacao = False;
            }
        } else {
            $emailErro = 'Por favor digite um endereço de email!';
            $validacao = False;
        }

        if (!empty($_POST['sexo'])) {
            $sexo = $_POST['sexo'];
        } else {
            $sexoErro = 'Por favor seleccione um campo!';
            $validacao = False;
        }

        $observacoes = $_POST['observacoes'];
    }

    if ($validacao) {
        $pdo = DbConnection::open();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO pessoa (Nome, Endereco, Cep, TelefoneCelular, TelefoneResidencial, Email, Sexo, Observacoes) VALUES(?,?,?,?,?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $endereco, $cep, $telefoneCelular, $telefoneResidencial, $email, $sexo, $observacoes));
        DbConnection::close();
        header("Location: list.php");
    }
}
?>

<div class="container">
    <div clas="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well"> Adicionar Contato </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="create.php" method="post">

                    <div class="control-group  <?php echo !empty($nomeErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Nome</label>
                        <div class="controls">
                            <input size="100" class="form-control" name="nome" type="text" placeholder="Nome" value="<?php echo !empty($nome) ? $nome : ''; ?>">
                            <?php if (!empty($nomeErro)) : ?>
                                <span class="text-danger"><?php echo $nomeErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($enderecoErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Endereço</label>
                        <div class="controls">
                            <input size="150" class="form-control" name="endereco" type="text" placeholder="Endereço" value="<?php echo !empty($endereco) ? $endereco : ''; ?>">
                            <?php if (!empty($enderecoErro)) : ?>
                                <span class="text-danger"><?php echo $enderecoErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($cepErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Cep</label>
                        <div class="controls">
                            <input size="7" class="form-control" name="cep" type="text" placeholder="CEP" value="<?php echo !empty($cep) ? $cep : ''; ?>">
                            <?php if (!empty($cepErro)) : ?>
                                <span class="text-danger"><?php echo $cepErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($telefoneCelularErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Celular</label>
                        <div class="controls">
                            <input size="13" class="form-control" name="telefoneCelular" type="text" placeholder="Celular" value="<?php echo !empty($telefoneCelular) ? $telefoneCelular : ''; ?>">
                            <?php if (!empty($telefoneCelularErro)) : ?>
                                <span class="text-danger"><?php echo $telefoneCelularErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($telefoneResidencialErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Residencial</label>
                        <div class="controls">
                            <input size="13" class="form-control" name="telefoneResidencial" type="text" placeholder="Residencial" value="<?php echo !empty($telefoneResidencial) ? $telefoneResidencial : ''; ?>">
                            <?php if (!empty($telefoneResidencialErro)) : ?>
                                <span class="text-danger"><?php echo $telefoneResidencialErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php !empty($emailErro) ? '$emailErro ' : ''; ?>">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input size="150" class="form-control" name="email" type="text" placeholder="Email" value="<?php echo !empty($email) ? $email : ''; ?>">
                            <?php if (!empty($emailErro)) : ?>
                                <span class="text-danger"><?php echo $emailErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php !empty($sexoErro) ? 'echo($sexoErro)' : ''; ?>">
                        <div class="controls">
                            <label class="control-label">Sexo</label>
                            <div class="form-check">
                                <p class="form-check-label">
                                    <input class="form-check-input" type="radio" name="sexo" id="sexo" value="M" <?php isset($_POST["sexo"]) && $_POST["sexo"] == "M" ? "checked" : null; ?> />
                                    Masculino
                                </p>
                            </div>
                            <div class="form-check">
                                <p class="form-check-label">
                                    <input class="form-check-input" id="sexo" name="sexo" type="radio" value="F" <?php isset($_POST["sexo"]) && $_POST["sexo"] == "F" ? "checked" : null; ?> />
                                    Feminino
                                </p>
                            </div>
                            <?php if (!empty($sexoErro)) : ?>
                                <span class="help-inline text-danger"><?php echo $sexoErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <br>

                    <div class="control-group <?php !empty($observacoesErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Observações</label>
                        <div class="controls">
                            <input size="250" class="form-control" name="observacoes" type="text" placeholder="Observações. máx 250 caracteres" value="<?php echo !empty($observacoes) ? $observacoes : ''; ?>">
                            <?php if (!empty($observacoesErro)) : ?>
                                <span class="text-danger"><?php echo $observacoesErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-actions">
                        <br />
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="list.php" type="btn" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<?php
include('../partials/footer.php');
?>