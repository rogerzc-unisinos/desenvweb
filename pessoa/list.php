<?php
include '../class/dbConnection.php';
$pdo = DbConnection::open();
?>

<?php
include('../partials/header.php');
?>

<div class="container">

    <br>

    <div>
        <div class="m3">
            <p>
                <a href="../index.php" class="btn btn-danger">Back</a>
                <a href="create.php" class="btn btn-success">Add</a>
            </p>
        </div>
    </div>

    <br>

    <div class="row">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">CEP</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Residencial</th>
                    <th scope="col">Email</th>
                    <th scope="col">Sexo</th>
                    <th scope="col">Observações</th>
                    <th scope="col">Data do Cadastro</th>
                    <th scope="col">#</a></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = 'SELECT * FROM pessoa ORDER BY id DESC';

                foreach ($pdo->query($sql) as $row) {

                    echo '<tr>';
                    echo '<th scope="row">' . $row['Id'] . '</th>';
                    echo '<td>' . $row['Nome'] . '</td>';
                    echo '<td>' . $row['Endereco'] . '</td>';
                    echo '<td>' . $row['Cep'] . '</td>';
                    echo '<td>' . $row['TelefoneCelular'] . '</td>';
                    echo '<td>' . $row['TelefoneResidencial'] . '</td>';
                    echo '<td>' . $row['Email'] . '</td>';
                    echo '<td>' . $row['Sexo'] . '</td>';
                    echo '<td>' . $row['Observacoes'] . '</td>';
                    echo '<td>' . $row['DataCadastro'] . '</td>';

                    echo '<td width=250>';
                    echo '<div class="m3"><a class="btn btn-primary" style="width:150px" href="read.php?id=' . $row['Id'] . '">Info</a></div>';
                    echo '<br>';
                    echo '<div class="m3"><a class="btn btn-warning" style="width:150px" href="update.php?id=' . $row['Id'] . '">Update</a></div>';
                    echo '<br>';
                    echo '<div class="m3"><a class="btn btn-danger" style="width:150px" href="delete.php?id=' . $row['Id'] . '">Delete</a></div>';
                    echo '</td>';
                    echo '</tr>';
                }

                ?>
            </tbody>
        </table>
    </div>

</div>
</body>

<?php
DbConnection::close();
?>

<?php
include('../partials/footer.php');
?>