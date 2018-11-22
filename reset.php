<?php
require 'inc/auto_load.php';
if (isset($_GET['id']) && isset($_GET['token'])){
    $auth = App::getAuth();
    $db = App::getDatabase();
    $user = $auth->reset_token_valid($db, $_GET['id'], $_GET['token']);
    if ($user){
        if (!empty($_POST)){
            $valid = new valid($_POST);
            $valid->IsConfirmed('password');
            if ($valid->IsValid()){
                $password = $auth->hashPassword($_POST['password']);
                $db->query('UPDATE users SET password = ?, reset_at = NULL, reset_token = NULL WHERE id = ?', [$password, $_GET['id']]);
                Session::getInstance()->setFlash('success', "Votre mot de passe a bien était modifié");
                $auth->connect($user);
                App::redirect('account.php');
            }
        }
    }else{
        Session::getInstance()->setFlash('danger', "Ce token n\'est pas valide");
        App::redirect('login.php');
    }
}else{
    App::redirect('login.php');
}
?>
<?php require 'inc/header.php'; ?>

<h1>Réinitialisation de mot de passe</h1>

<form action="" method="POST">
    <fieldset disabled>
    <div class="form-group">
        <label for="disabledTextInput">Token de réinitialisation</label>
        <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= $user->reset_token; ?>">
    </div>
    </fieldset>

    <div class="form-group">
        <label for="">Password</label>
        <input type="password" name="password" class="form-control" autocomplete="off"/>
    </div>

    <div class="form-group">
        <label for="">Password Confirmation</label>
        <input type="password" name="password_confirm" class="form-control" autocomplete="off"/>
    </div>

    <button type="submit" class="btn btn-primary">Réinitialiser mon mot de passe</button>

</form>
<?php require 'inc/footer.php'; ?>
