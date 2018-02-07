<?php

include './Class/Group.php';
include './Class/User.php';

$_host = 'localhost';
$_user = 'root';
$_password = '';
$_dbname = 'lexik';
$DB = new PDO("mysql:host=$_host;dbname=$_dbname", $_user, $_password);

$user = new User($DB);
$group = new Group($DB);

$allUsers = $user->getAll();

if (isset($_POST['search'])){
    $allUsers = $user->getUsers($_POST['search']);
    if ($allUsers == NULL) {
        $allUsers=[];
    }
}
else if(isset($_POST['cancel'])){
    $allUsers = $user->getAll();
}
if(isset($_POST['email'])){
    $newUser = new User($DB, $_POST['email'], $_POST['last_name'], $_POST['first_name'], $_POST['anniv'], $_POST['group']);
    $newUser->save();
}
if(isset($_POST['idChecked'])){
    foreach ($_POST['idChecked'] as $check) {
        $user->delete($check);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Exo Lexik</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="research">
        <form action="index.php" method="post">
            <input type="text" name="search" placeholder="Rechercher ..." class="testPerso">
            <input class="btn btn-primary" type="submit" value="Rechercher">
        </form>
        <form action="index.php" method="post">
            <input type="text" name="cancel" value="cancel" style="display:none">
            <input class="btn btn-secondary" type="submit" value="Annuler">
        </form>
    </div>

    <button class="btn btn-success btnAddUser" type="button" data-toggle="collapse" data-target="#formCreateUser">
        Créer un utilisateur
    </button>
    <div class="collapse " id="formCreateUser">
        <div class="card card-body">
            <form action="index.php" method="post" class="formAddUser">

                <label for="email" class="formAddUserLabelEmail">Email : </label>
                <input type="email" name="email" required class="form-control">
                <br />
                <label for="last_name">Nom de famille : </label>
                <input type="text" name="last_name" required class="form-control">
                <br />
                <label for="first_name">Prénom : </label>
                <input type="text" name="first_name" required class="form-control">
                <br />
                <label for="anniv">Date d'anniversaire : </label>
                <input type="date" name="anniv" required class="form-control">
                <label for="group">Nom du groupe : </label>
                <select name="group" required  class="form-control form-control-lg">
                    <?php
                    $allGroup = $group->getAll();
                    foreach ($allGroup as $row) {
                        echo ' <option value="'.$row['name'].'">'.$row['name'].'</option>';
                    }
                    ?>
                </select>

                <input type="submit" value="Valider" class="btn btn-success buttonValidateAddUser">
            </form>
        </div>
    </div>


    <form action="index.php" method="post">
        <table class="table table-striped">
            <thead>
                <tr><th>Selection</th><th>Nom du groupe</th><th>Nom</th><th>Email</th><th>Actions</th></tr>
            </thead>
            <tbody>
                <?php
                foreach( $allUsers as $row ) {
                    echo
                    '<tr>
                    <td><input type="checkbox" name="idChecked[]" value="'.$user->getID($row['email']).'"></td>
                    <td>' .$row['group_name'] .'</td>
                    <td>'. $row['last_name'] .' '. $row['first_name'] .'</td>
                    <td>'. $row['email'] .'</td>
                    <td><button type="button" onclick="details()" class="btn btn-light">details</button>
                    <input type="submit" value="Supprimer" class="btn btn-light redPerso"></td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
        <input type="submit" class="btn btn-danger" value="Supprimer la séléction">
    </form>
</body>
<script>
function details(data){

}
</script>
</html>
