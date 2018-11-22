<?php

class Auth{
    private $options = [
        'restrict_msg' => "Vous devez être connecté pour accéder à cette page"
    ];
    private $session;

    public function __construct($session, $options = []){
        $this->options = array_merge($this->options, $options);
        $this->session = $session;
    }

    public function hashPassword($password){
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function register($db, $username, $password, $email){
        $password = $this->hashPassword($password);
        $token = str::str_rdm(60);
        $db->query("INSERT INTO users SET username = ?, password = ?, email = ?, confirmation_token = ?, rank = 0", [
            $username,
            $password,
            $email,
            $token
        ]);
        $user_id = $db->lastInsertId();
        mail($email, 'Confirmation de votre compte EnergyGaming', "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://soowyz.000webhostapp.com/confirmation.php?id=$user_id&token=$token");
    }

    public function sendbans($db, $emailmj, $serveur, $userban, $raisons, $tempban, $pseudomj){
        $db->query("INSERT INTO bans SET emailmj = ?, serveur = ?, userban = ?, raisons = ?, tempban = ?, pseudomj = ?", [
            $emailmj,
            $serveur,
            $userban,
            $raisons,
            $tempban,
            $pseudomj
        ]);
    }

    public function Count($db, $serveur = ""){
        $Count = $db->query("SELECT COUNT(*) As Nbr FROM bans WHERE serveur = '$serveur' AND send = '0'");
        $Count->execute();
        $ResultCount = $Count->fetch(PDO::FETCH_ASSOC);
        echo "<span style='margin-left: 10px;' class='badge'>". $ResultCount['Nbr'] ."</span>";
    }

    public function showbans($db, $serveur){
        $bans = $db->query("SELECT * FROM bans WHERE serveur = '$serveur' AND send = '0'");
        $bans->execute();
        $result = $bans->fetchall();
        echo "
                <div class='panel panel-danger'>
                    <div class='alert alert-danger' role='alert'>" . strtoupper($serveur), App::getAuth()->Count($db, $serveur) . "</div>
                        <table class='table table-striped'>
                            <thead>
                                <tr>
                                    <th scope='col'>UTILISATEUR</th>
                                    <th scope='col'>RAISONS</th>
                                    <th scope='col'>DURÉE DU BAN</th>
                                    <th scope='col'>PSEUDO MJ</th>
                                    <th scope='col'>ARCHIVER</th>
                                </tr>
                            </thead>
                            <tbody>
        ";
        foreach($result as $row)
        {
            echo "<tr>";
            echo "<td>" . $row->userban . "</td>";
            echo "<td>" . $row->raisons . "</td>";
            echo "<td>" . $row->tempban . "</td>";
            echo "<td>" . $row->pseudomj . "</td>";
            echo "<td><a href=\"edit.php?id=$row->id\"><img src='Images/Modify.png'></a></td>";
        }
        echo "
                            </tbody>
                        </table>
                    </div>
        ";
    }

    public function showbansmj($db, $serveur){
        $mjname = $_SESSION['auth']->username;
        $mjbans = $db->query("SELECT * FROM bans WHERE serveur = '$serveur' AND send = '0' AND pseudomj = '$mjname'");
        $mjbans->execute();
        $result = $mjbans->fetchall();
        echo "
                <div class='panel panel-danger'>
                    <div class='alert alert-danger' role='alert'>" . strtoupper($serveur), App::getAuth()->Count($db, $serveur) . "</div>
                        <table class='table table-striped'>
                            <thead>
                                <tr>
                                    <th scope='col'>UTILISATEUR</th>
                                    <th scope='col'>RAISONS</th>
                                    <th scope='col'>DURÉE DU BAN</th>
                                    <th scope='col'>PSEUDO MJ</th>
                                    <th scope='col'>EDITER</th>
                                    <th scope='col'>SUPPRIMER</th>
                                </tr>
                            </thead>
                            <tbody>
        ";
        foreach($result as $row)
        {
            echo "<tr>";
            echo "<td>" . $row->userban . "</td>";
            echo "<td>" . $row->raisons . "</td>";
            if($row->tempban == 0){
                echo "<td>Définitif</td>";
            }else {
                echo "<td>" . $row->tempban . "</td>";
            }
            echo "<td>" . $row->pseudomj . "</td>";
            echo "<td><a href=\"editban.php?id=$row->id\"><img src='Images/Modify.png'></a></td>";
            echo "<td><a href=\"removeban.php?id=$row->id\"><img src='Images/Delete.png'></a></td>";
        }
        echo "
                            </tbody>
                        </table>
                    </div>
        ";
    }

    public function showbansarchived($db, $serveur){
        $nombre_de_msg_par_page=10;
        $reponse = $db->query("SELECT COUNT(*) AS nbBan FROM bans WHERE serveur = '$serveur'");
        $reponse->execute();
        $total_messages = $reponse->fetch();
        $nombre_messages=$total_messages->nbBan;
        $nb_pages = ceil($nombre_messages / $nombre_de_msg_par_page);

        if (isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<=$nb_pages)
        {
            $page = $_GET['p'];
        }else{
            $page = 1;
        }

        $premierMessageAafficher = ($page - 1) * $nombre_de_msg_par_page;
        $bans = $db->query("SELECT * FROM bans WHERE serveur = '$serveur' AND send = '1' LIMIT " . $premierMessageAafficher . ", " . $nombre_de_msg_par_page);
        $bans->execute();
        $result = $bans->fetchall();
        echo "
                <div class='panel panel-danger'>
                    <div class='alert alert-danger' role='alert'>" . strtoupper($serveur), App::getAuth()->Count($db, $serveur) . "</div>
                        <table class='table table-striped'>
                            <thead>
                                <tr>
                                    <th scope='col'>Utilisateur</th>
                                    <th scope='col'>Raisons</th>
                                    <th scope='col'>Durée du ban</th>
                                    <th scope='col'>Pseudo MJ</th>
                                    <th scope='col'>Archiver par</th>
                                    <th scope='col'>Date</th>
                                </tr>
                            </thead>
                            <tbody>
        ";
        foreach($result as $row)
        {
            echo "<tr>";
            echo "<td>" . $row->userban . "</td>";
            echo "<td>" . $row->raisons . "</td>";
            echo "<td>" . $row->tempban . "</td>";
            echo "<td>" . $row->pseudomj . "</td>";
            echo "<td>" . $row->pseudom . "</td>";
            echo "<td>" . $row->m_date . "</td>";
        }

        echo "
                            </tbody>
                        </table>
                    </div>
                <nav class='text-center' aria-label='Page navigation'>
                    <ul class='pagination'>
        ";
        for ($i = 1 ; $i <= $nb_pages ; $i++){
            echo "<li><a href=\"?p=$i\">". $i . "</a></li>";
        }
        echo "    
                    </ul>
                </nav>
        ";
    }

    public function showuser($db){
        $bans = $db->query("SELECT * FROM users WHERE rank < 4");
        $bans->execute();
        $result = $bans->fetchall();
        echo "
                <div class='panel panel-danger'>
                    <div class='alert alert-danger' role='alert'>" . strtoupper('utilisateurs'), App::getAuth()->Count($db) . "</div>
                        <table class='table table-striped'>
                            <thead>
                                <tr>
                                    <th scope='col'>PSEUDO</th>
                                    <th scope='col'>ADRESSE EMAIL</th>
                                    <th scope='col'>GRADE</th>
                                    <th scope='col'>EDITER</th>
                                </tr>
                            </thead>
                            <tbody>
        ";
        foreach($result as $row)
        {
            echo "<tr>";
            echo "<td>" . $row->username . "</td>";
            echo "<td>" . $row->email . "</td>";
            $ranked = str_replace(
                array(
                    '0',
                    '1',
                    '2C',
                    '2F',
                    '3C',
                    '3F'
                ),
                array(
                    'Compte en attente',
                    'Compte désactiver',
                    'Modérateur-Joueur du Cheat',
                    'Modérateur-Joueur du Fight',
                    'Modérateur Cheat',
                    'Modérateur Fight'
                ),
                $row->rank
            );
            echo "<td>" . $ranked . "</td>";
            echo "<td><a href=\"edituser.php?id=$row->id&email=$row->email&username=$row->username\"><img src='Images/Modify.png'></a></td>";
        }
        echo "
                        </tbody>
                    </table>
                </div>
        ";
    }

    public function editban($db){
        $idban = $_GET['id'];
        $username = $_SESSION['auth']->username;
        $db->query("UPDATE bans SET send = '1', pseudom = '$username', m_date = NOW() WHERE id = $idban")->execute();
        Session::getInstance()->setFlash('success', 'Votre ban a bien était archiver');
        App::redirect('showban.php');
    }

    public function edituser($db){
        $userid = $_GET['id'];
        $db->query("UPDATE bans SET send = '1' WHERE id = $userid")->execute();
        Session::getInstance()->setFlash('success', 'Vôtre ban a bien était archiver');
        App::redirect('account.php');
    }

    public function confirm($db, $user_id, $token){
        $user = $db->query('SELECT * FROM users WHERE id = ?', [$user_id])->fetch();
        if ($user && $user->confirmation_token == $token){
            $db->query('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?', [$user_id]);
            $this->session->write('auth', $user);
            return true;
        }else{
            return false;
        }
    }

    public function restrict(){
        if (!$this->session->read('auth')){
            $this->session->setFlash('danger', $this->options['restrict_msg']);
            header('Location: login.php');
            exit();
        }
    }

    public function page_restrict($db, $user_id){
        return $db->query('SELECT * FROM users WHERE id = ? ', [$user_id])->fetch();
    }

    public function user(){
        if (!$this->session->read('auth')){
            return false;
        }
        return $this->session->read('auth');
    }

    public function connect($user){
        $this->session->write('auth', $user);
    }

    public function connectFromCookie($db){
        if (isset($_COOKIE['remember']) && !$this->user()){
            $remember_token = $_COOKIE['remember'];
            $parts = explode('//', $remember_token);
            $user_id = $parts[0];
            $user = $db->query('SELECT * FROM users WHERE id = ?', [$user_id])->fetch();
            if ($user){
                $expected = $user_id . '//' . $user->remember_token . sha1($user_id . 'remembertokensecuritybysoowyz');
                if ($expected == $remember_token){
                    $this->connect($user);
                    setcookie('remember', $remember_token, time() + 60 * 60 * 24 * 2);
                }else{
                    setcookie('remember', NULL, -1);
                }
            }else{
                setcookie('remember', NULL, -1);
            }
        }
    }

    public function login($db, $username, $password, $remember = false){
            $user = $db->query('SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL', ['username' => $username])->fetch();
            if ($user && password_verify($password, $user->password)){
                $this->connect($user);
                if ($remember){
                    $this->remember($db, $user->id);
                }
                return $user;
            }else{
                return false;
            }
    }

    public function remember($db, $user_id){
            $remember_token = str::str_rdm(250);
            $db->query('UPDATE users SET remember_token = ? WHERE id = ?', [$remember_token, $user_id]);
            setcookie('remember', $user_id . '//' . $remember_token . sha1($user_id . 'remembertokensecuritybysoowyz'), time() + 60 * 60 * 24 * 2);
    }

    public function logout(){
        setcookie('remember', NULL, -1);
        $this->session->delete('auth');
    }

    public function reset_pass($db, $email){
        $user = $db->query('SELECT * FROM users WHERE email = ? AND confirmed_at IS NOT NULL', [$email])->fetch();
        if ($user){
            $reset_token = str::str_rdm(60);
            $db->query('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?', [$reset_token, $user->id]);
            mail($_POST['email'], 'Réinitialitation de votre mot de passe', "Afin de changer votre mot de passe merci de cliquer sur ce lien\n\nhttp://soowyz.000webhostapp.com/reset.php?id={$user->id}&token=$reset_token");
            return $user;
        }
        return false;
    }

    public function reset_token_valid($db, $user_id, $token){
        return $db->query('SELECT * FROM users WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)', [$user_id, $token])->fetch();
    }
}