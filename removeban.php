<?php
require 'inc/auto_load.php';

App::getAuth()->restrict();
$db = App::getDatabase();
$user = App::getAuth()->page_restrict($db, $_SESSION['auth']->id);

require 'inc/header.php';
if ($user->rank == '2C' || $user->rank == '2F') {
    $removeb = $_GET['id'];
    $db->query("DELETE FROM bans WHERE id = $removeb")->execute();
    $_SESSION['flash']['success'] = "Votre ban a bien était suprimer";
    App::redirect('showbanmj.php');
} else {
    App::redirect('account.php');
}
require 'inc/footer.php';
