<?php

require 'inc/auto_load.php';
App::getAuth()->restrict();
require 'inc/header.php';
$db = App::getDatabase();

$user = App::getAuth()->page_restrict($db, $_SESSION['auth']->id);?>
<?php if ($user->rank == '4'):?>
    <?php App::getAuth()->showbansarchived($db, 'EnergyFight'); ?>

<?php else:?>
    <?php
    App::redirect('account.php');
    endif; ?>
<?php require 'inc/footer.php'; ?>
