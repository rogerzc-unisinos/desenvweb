<?php
require '../class/dbConnection.php';

$id = 0;

if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (!empty($_POST)) {
    $id = $_POST['id'];

    $pdo = DbConnection::open();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM pessoa where Id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    DbConnection::close();
    header("Location: list.php");
}
?>

<?php
include('../partials/header.php');
?>

<div class="container">
    <div class="span10 offset1">
        <div class="row">
            <h3 class="well">Excluir Contato</h3>
        </div>
        <form class="form-horizontal" action="delete.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <div class="alert alert-danger"> Deseja excluir o contato?
            </div>
            <div class="form actions">
                <button type="submit" class="btn btn-danger">Yes</button>
                <a href="list.php" type="btn" class="btn btn-primary">No</a>
            </div>
        </form>
    </div>
</div>


<?php
include('../partials/footer.php');
?>