<?php

require 'inc/auto_load.php';
App::getAuth()->restrict();
require 'inc/header.php';
$db = App::getDatabase();

$user = App::getAuth()->page_restrict($db, $_SESSION['auth']->id);?>
<?php if ($user->rank == '2C' || $user->rank == '2F'):?>
<br />
    <?php if ($user->rank == '2C'): ?>
        <?php     if (!empty($_POST)) {
            $emailmj = $user->email;
            $pseudomj = $user->username;
            App::getAuth()->sendbans($db, $emailmj, 'EnergyCheat', $_POST['userban'], $_POST['EnergyCheck'], $_POST['dayban'], $pseudomj);
            header("Refresh:0");
            Session::getInstance()->setFlash('success', 'Vôtre ban a bien était soumis aux supérieurs');
        }else{
            echo "";
        }?>
        <div class='panel panel-danger'>
            <div class="alert alert-danger" role='alert'>ENVOI D'UN BANNISSEMENT</div>
            <div class='panel-body'>
                <form action="" method="POST">
                    <fieldset disabled>
                        <div class="form-group">
                            <label for="disabledTextInput">Adresse E-mail</label>
                            <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= $user->email; ?>">
                        </div>
                    </fieldset>
                    </br>
                    <div class="form-group">
                        <label for="">Joueur à sanctionner</label>
                        <input type="text" name="userban" class="form-control" placeholder="Pseudo du joueur à sanctionner" autocomplete="off"/>
                    </div>
                    </br>
                    <div class="form-group">
                        <label for="">Raisons</label>
                        <input type="text" name="EnergyCheck" class="form-control" placeholder="Autres raisons" autocomplete="off"/>
                    </div>
                    </br>
                    <div class="form-group">
                        <label for="">Durée du Jail ( en jour ) [ 0 = Définitif ]</label>
                        <input type="number" name="dayban" class="form-control" placeholder="Durée du jail en jours" autocomplete="off"/>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="radio" name="radio_ban">
                                </span>
                                <input type="number" class="form-control" name="dayban">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="radio" name="radio_ban">
                                </span>
                                <input type="text" class="form-control" name="dayban" value="Définitif">
                            </div>
                        </div>
                    </div>
                    </br>
                    <fieldset disabled>
                        <div class="form-group">
                            <label for="disabledTextInput">Pseudo du MJ</label>
                            <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= $user->username; ?>">
                        </div>
                    </fieldset>
                    </br>
                    <button type="submit" class="btn btn-danger">Envoyer le banniseement</button>
                </form>
            </div>
        </div>
    <?php endif; ?> <!-- MJ Cheat -->
    <?php if ($user->rank == '2F'): ?>
        <?php     if (!empty($_POST)) {
            $emailmj = $user->email;
            $pseudomj = $user->username;
            App::getAuth()->sendbans($db, $emailmj, 'EnergyFight', $_POST['userban'], $_POST['EnergyCheck'], $_POST['dayban'], $pseudomj);
            header("Refresh:0");
            Session::getInstance()->setFlash('success', 'Vôtre ban a bien était soumis aux supérieurs');
        }else{
            echo "";
        }?>
        <div class='panel panel-danger'>
            <div class="alert alert-danger" role='alert'>ENVOI D'UN BANNISSEMENT</div>
        <div class='panel-body'>
            <form action="" method="POST">
                <fieldset disabled>
                    <div class="form-group">
                        <label for="disabledTextInput">Adresse E-mail</label>
                        <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= $user->email; ?>">
                    </div>
                </fieldset>
                </br>
                <div class="form-group">
                    <label for="">Joueur à sanctionner</label>
                    <input type="text" name="userban" class="form-control" placeholder="Pseudo du joueur à sanctionner" autocomplete="off"/>
                </div>
                </br>
                <div class="form-group">
                    <label for="">Raisons</label>
                    <input type="text" name="EnergyCheck" class="form-control" placeholder="Autres raisons" autocomplete="off"/>
                </div>
                </br>
                <div class="form-group">
                    <label for="">Durée du Jail ( en jour )</label>
                    <input type="text" name="dayban" class="form-control" placeholder="Durée du jail en jours" autocomplete="off"/>
                </div>
                </br>
                <fieldset disabled>
                    <div class="form-group">
                        <label for="disabledTextInput">Pseudo du MJ</label>
                        <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= $user->username; ?>">
                    </div>
                </fieldset>
                </br>
                <button type="submit" class="btn btn-danger">Envoyer le banniseement</button>
            </form>
        </div>
        </div>
    <?php endif; ?> <!-- MJ Fight -->
<?php else:?>
    <?php
    App::redirect('account.php');
endif;
?>
<?php require 'inc/footer.php'; ?>
