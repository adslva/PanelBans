<?php
$db = App::getDatabase();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title></title>
    <!-- Bootstrap core CSS -->
    <link href="css/app.css" rel="stylesheet">
  </head>
  <body>
  <nav class="navbar navbar-default">
      <div class="container-fluid">
          <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="account.php"><b>PANEL ENERGY<span class='badge'>BETA</span></b></a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                  <?php if (isset($_SESSION['auth'])): ?>
                      <li><a href="account.php">ACCEUIL</a></li>
                  <?php $user = App::getAuth()->page_restrict($db, $_SESSION['auth']->id);?>
                    <?php if ($user->rank == '3C' || $user->rank == '3F' || $user->rank == '4'):?>
                      <li><a href="showban.php">AFFICHER LES BAN'S</a></li>
                    <?php endif; ?>
                    <?php if ($user->rank == '2C' || $user->rank == '2F'):?>
                      <li><a href="sendban.php">ENVOYER UN BAN</a></li>
                      <li><a href="showbanmj.php">HISTORIQUE DE MES BANS</a></li>
                    <?php endif; ?>
                    <?php if ($user->rank == '4'):?>
                      <li><a href="admin.php">UTILISATEURS</a></li>
                      <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">BAN'S ARCHIVER<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                          <li><a href="archi_cheat.php"> BAN'S ARCHIVER ENERGYCHEAT</a></li>
                          <li role="separator" class="divider"></li>
                          <li><a href="archi_fight.php"> BAN'S ARCHIVER ENERGYFIGHT</a></li>
                      </ul>
                      </li>
                      <?php endif; ?>
                  <?php else: ?>
                      <li><a href="register.php">S'INSCRIRE</a></li>
                      <li><a href="login.php">SE CONNECTER</a></li>
                  <?php endif; ?>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown">
                      <?php if (isset($_SESSION['auth'])): ?>
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $_SESSION['auth']->username; ?> <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                          <li><a href="resetpass.php"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> CHANGER DE MOT DE PASSE</a></li>
                          <li role="separator" class="divider"></li>
                          <li><a href="logout.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> SE DÉCONNECTER</a></li>
                      </ul>
                      <?php else: ?>
                      <?php endif; ?>
                  </li>
              </ul>
          </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
  </nav>
    <div class="container">
<?php if (Session::getInstance()->hasFlash()): ?>
        <?php foreach (Session::getInstance()->getFlash() as $type => $message): ?>
            <div class="alert alert-<?= $type; ?>">
            <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                <span style="margin-left: 10px;"><?= $message; ?></span>
            </div>
            <br />
        <?php endforeach; ?>
<?php endif; ?>