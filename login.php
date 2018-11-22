<?php
require 'inc/auto_load.php';

$auth = App::getAuth();
$db = App::getDatabase();
$auth->connectFromCookie($db);

if ($auth->user()){
    App::redirect('account.php');
}

if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
    $user = $auth->login($db, $_POST['username'], $_POST['password'], isset($_POST['remember']));
    $session = Session::getInstance();
        if ($user){
            $session->setFlash('success', 'VOUS ÊTES MAINTENANT BIEN CONNECTÉ');
            App::redirect('account.php');
            exit();
        }else{
            $session->setFlash('danger', "IDENTIFIANT OU MOT DE PASSE INCORRECTE");
        }
    }

require 'inc/header.php';
?>

<div class="page-header"><h3>SE CONNECTER</h3></div>
<form action="" method="POST">
    <!-- PSEUDO / EMAIL -->
    <div class="form-group">
        <label for="">PSEUDO OU EMAIL</label>
        <input type="text" name="username" class="form-control" autocomplete="off"/>
    </div>
    <!-- MOT DE PASSE -->
    <div class="form-group">
        <label for="">MOT DE PASSE <a href="forget.php">(J'ai oublié mon mot de passe)</a></label>
        <input type="password" name="password" class="form-control" autocomplete="off"/>
    </div>
    <!-- REMEMBER -->
    <div class="form-group">
        <label><input type="checkbox" name="remember" value="1"/> SE SOUVENIR DE MOI ?</label>
    </div>
    <!-- BOUTTON SE CONNECTER -->
    <button type="submit" class="btn btn-primary">SE CONNECTER</button>
</form>
<?php require 'inc/footer.php'; ?>
