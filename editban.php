<?php
require 'inc/auto_load.php';

App::getAuth()->restrict();
$db = App::getDatabase();
$user = App::getAuth()->page_restrict($db, $_SESSION['auth']->id);

require 'inc/header.php';

if ($user->rank == '2C' || $user->rank == '2F') {
    #if (empty($_GET['id']) || empty($_GET['email']) || empty($_GET['username'])){
    #    App::redirect('account.php');
    #}


    $ban_id = $_GET['id'];
    $edit_ban = $db->query("SELECT * FROM bans WHERE id = '$ban_id'");
    $edit_ban->execute();
    $result = $edit_ban->fetchall();

    if (!empty($_POST)) {
        if (empty($_POST['userban']) || empty($_POST['raisons']) || empty($_POST['dayban'])){
            $_SESSION['flash']['danger'] = "Vérifiez vos champs";
            App::redirect('showbanmj.php');
        } else {
            $user_ban = $_POST['userban'];
            $raisons = $_POST['raisons'];
            $d_ban = $_POST['dayban'];
            $db->query("UPDATE bans SET userban = ?, raisons = ?, tempban = ? WHERE id = $ban_id")->execute([$user_ban, $raisons, $d_ban]);
            $_SESSION['flash']['success'] = "Votre ban a bien été mis à jour";
            App::redirect('showbanmj.php');
        }
    }

    echo "
    <div class='panel panel-danger'>
        <div class='alert alert-danger' role='alert'>MODIFICATION DU BANNISSEMENT</div>
            <div class='panel-body'>
                <form action='' method='POST'>";
    foreach ( $result as $row){
        echo "
        <fieldset disabled>
            <div class=\"form-group\">
                <label for=\"disabledTextInput\">EMAIL MJ</label>
                <input type=\"text\" id=\"disabledTextInput\" class=\"form-control\" placeholder=\"$row->emailmj\">
            </div>
        </fieldset>      
        <br />  
        <div class=\"form-group\">
            <label for=\"\">USER BAN</label>
                <input type=\"text\" name=\"userban\" class=\"form-control\" value=\"$row->userban\" autocomplete=\"off\">
        </div>
        <br />
        <div class=\"form-group\">
            <label for=\"\">RAISONS</label>
                <input type=\"text\" name=\"raisons\" class=\"form-control\" value=\"$row->raisons\" autocomplete=\"off\">
        </div>
        <br />
        <div class=\"form-group\">
            <label for=\"\">DURÉE DU BAN</label>
                <input type=\"number\" name=\"dayban\" class=\"form-control\" value=\"$row->tempban\" autocomplete=\"off\"/>
        </div>
        <br />
        <button class=\"btn btn-primary\">ENREGISTRER LES MODIFICATIONS</button>
        ";
    }

    echo "
            </form>
        </div>
    </div>";


}else{
    App::redirect('account.php');
}

require 'inc/footer.php';

