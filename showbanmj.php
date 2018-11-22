<?php
require 'inc/auto_load.php';

App::getAuth()->restrict();
$db = App::getDatabase();
$user = App::getAuth()->page_restrict($db, $_SESSION['auth']->id);

require 'inc/header.php';

if ($user->rank == '2C' || $user->rank == '2F'){
    if ($user->rank == '2C'){
        App::getAuth()->showbansmj($db, 'EnergyCheat');
    }
    if ($user->rank == '2F'){
        App::getAuth()->showbansmj($db, 'EnergyFight');
    }
} else {
    App::redirect('account.php');
}

require 'inc/footer.php';
