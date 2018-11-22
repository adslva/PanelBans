<?php

require 'inc/auto_load.php';



App::getAuth()->restrict();

$db = App::getDatabase();

$user = App::getAuth()->page_restrict($db, $_SESSION['auth']->id);



require 'inc/header.php';

if ($user->rank == '3C' || $user->rank == '3F' || $user->rank == '4') {

    App::getAuth()->editban($db);

} else {

    App::redirect('account.php');

}

require 'inc/footer.php';

