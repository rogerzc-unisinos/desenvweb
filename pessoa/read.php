<?php
include('../partials/header.php');
?>

<?php
require '../class/dbConnection.php';
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: ../index.php");
} else {
    $pdo = DbConnection::open();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM pessoa where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    DbConnection::close();
}
?>

<div class="container">
    <div class="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well">Informações do Contato</h3>
            </div>
            <div class="container">
                <div class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label">Nome</label>
                        <div class="controls form-control">
                            <label class="carousel-inner">
                                <?php echo $data['Nome']; ?>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Endereço</label>
                        <div class="controls form-control disabled">
                            <label class="carousel-inner">
                                <?php echo $data['Endereco']; ?>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">CEP</label>
                        <div class="controls form-control disabled">
                            <label class="carousel-inner">
                                <?php echo $data['Cep']; ?>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Celular</label>
                        <div class="controls form-control disabled">
                            <label class="carousel-inner">
                                <?php echo $data['TelefoneCelular']; ?>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Residencial</label>
                        <div class="controls form-control disabled">
                            <label class="carousel-inner">
                                <?php echo $data['TelefoneResidencial']; ?>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Email</label>
                        <div class="controls form-control disabled">
                            <label class="carousel-inner">
                                <?php echo $data['Email']; ?>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Sexo</label>
                        <div class="controls form-check disabled">
                            <label class="carousel-inner">
                                <?php echo $data['Sexo']; ?>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Observações</label>
                        <div class="controls form-check disabled">
                            <label class="carousel-inner">
                                <?php echo $data['Observacoes']; ?>
                            </label>
                        </div>
                    </div>


                    <div class="form-actions">
                        <a href="list.php" type="btn" class="btn btn-danger">Back</a>
                    </div>

                    <br />
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('../partials/footer.php');
?>