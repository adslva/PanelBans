<?php
require 'inc/auto_load.php';

App::getAuth()->restrict();
$db = App::getDatabase();
$user = App::getAuth()->page_restrict($db, $_SESSION['auth']->id);

if ($user->rank == 4) {
    if (empty($_GET['id']) || empty($_GET['email']) || empty($_GET['username'])){
        App::redirect('account.php');
    }

    $email = $_GET['email'];
    $username = $_GET['username'];

    if (!empty($_POST)) {
        if (empty($_POST['EnergyGrade'])) {
            $_SESSION['flash']['danger'] = "Vous n'avez pas cocher de grade";
        } else {
            $user_id = $_GET['id'];
            $rank = $_POST['EnergyGrade'];
            $db->query("UPDATE users SET rank = ? WHERE id = ?")->execute([$rank, $user_id]);
            $_SESSION['flash']['success'] = "Le grade de l'utilisateur a bien été mis à jour";
        }
    }
    require 'inc/header.php';
    ?>
    <form action="" method="post">
        <fieldset disabled>
            <div class="form-group">
                <label for="disabledTextInput">Username</label>
                <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= $username; ?>">
            </div>
        </fieldset>
        <fieldset disabled>
            <div class="form-group">
                <label for="disabledTextInput">Email</label>
                <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= $email; ?>">
            </div>
        </fieldset>
        <div class="form-group">
            <label class="radio-inline"><input type="radio" name="EnergyGrade" value="1">Désactivation du compte</label>
            <label class="radio-inline"><input type="radio" name="EnergyGrade" value="2C">MJ Cheat</label>
            <label class="radio-inline"><input type="radio" name="EnergyGrade" value="2F">MJ Fight</label>
            <label class="radio-inline"><input type="radio" name="EnergyGrade" value="3C">Modérateur Cheat</label>
            <label class="radio-inline"><input type="radio" name="EnergyGrade" value="3F">Modérateur Fight</label>
        </div>

        <button class="btn btn-primary">Enregistrer les modifications</button>
    </form>
    <?php
}else{
    App::redirect('account.php');
}
require 'inc/footer.php';
?>
