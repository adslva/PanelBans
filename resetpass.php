<?php
require 'inc/auto_load.php';
App::getAuth()->restrict();
$db = App::getDatabase();

if(!empty($_POST)){
    if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
        $_SESSION['flash']['danger'] = "Les mots de passe ne correspondent pas";
    }else{
        $user_id = $_SESSION['auth']->id;
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $db->query('UPDATE users SET password = ? WHERE id = ?')->execute([$password, $user_id]);
        $_SESSION['flash']['success'] = "Votre mot de passe a bien était mis a jour";
    }
}
require 'inc/header.php';
?>

    <h4>CHANGEZ VOTRE MOT DE PASSE</h4><br />
<form action="" method="post">
    <div class="form-group">
        <label for="">Nouveau mot de passe</label>
        <input class="form-control" type="password" name="password"/>
    </div>
    <div class="form-group">
        <label for="">Confirmer votre mot de passe</label>
        <input class="form-control" type="password" name="password_confirm"/>
    </div>
    <br />
    <div class="form-group">
    <button class="btn btn-primary">Changer mon mot de passe</button>
    </div>
</form>
<?php require 'inc/footer.php'; ?>
