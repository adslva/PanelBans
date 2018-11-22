<?php
require 'inc/auto_load.php';

if (!empty($_POST)) {

    $errors = array();

    $db = App::getDatabase();
    $valid = new valid($_POST);
    $valid->IsAlpha('username', "Erreur pseudo");
    if ($valid->IsValid()){
        $valid->IsUnique('username', $db, 'users', 'Ce pseudo est déjà pris');
    }
    $valid->IsEmail('email', "Votre email n\'est pas valide");
    if ($valid->IsValid()){
        $valid->IsUnique('email', $db, 'users', 'Cet email est déjà pris');
    }
    $valid->IsConfirmed('password', 'Entrez un mdp valide');
        if ($valid->IsValid()) {
            App::getAuth()->register($db, $_POST['username'], $_POST['password'], $_POST['email']);
            Session::getInstance()->setFlash('success', "Un Email de confirmation vous a été envoyé");
            App::redirect('login.php');
        }else{
            $errors = $valid->getErrors();
        }
}

require 'inc/header.php'; 
?>
<h1>S'inscrire</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <p>Vous n'avez pas rempli le formulaire correctement</p>
            <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
            </ul>
    </div>
<?php endif; ?>
<form action="" method="POST">
	
	<div class="form-group">
		<label for="">Pseudo</label>
		<input type="text" name="username" class="form-control"/>
	</div>

	<div class="form-group">
		<label for="">Email</label>
		<input type="text" name="email" class="form-control"/>
	</div>


	<div class="form-group">
		<label for="">Mot de passe</label>
		<input type="password" name="password" class="form-control"/>
	</div>

	<div class="form-group">
		<label for="">Confirmation du Mot de passe</label>
		<input type="password" name="password confirm" class="form-control"/>
	</div>

	<button type="submit" class="btn btn-primary"> M'inscrire</button>

</form>

<?php require 'inc/footer.php'; ?>