<?php
    include('config.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    function send_password_reset($get_email, $token)
    {
        //Parametre du serveur
        $mail=new PHPMailer(true);
        $mail->SMTPDebug=2;
        $mail->isSMTP();
        $mail->Host= 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username='salesanalysishelp@gmail.com';//Mail de puis lequel l'envoie est fait
        $mail->Password='yrhlkfxqdnqfyxbo';//Mot de passe du mail avec methode 2 facteur de google
        $mail->SMTPSecure='tls';
        $mail->Port=587;
        $mail->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));

        $mail->setFrom('salesanalysishelp@gmail.com'); //Mail
        $mail->addAddress($_POST["email"]); //Mail du destinataire
        $mail->isHTML(true);
        $mail->Subject="Reset Password Notification";//Objet du mail
        $email_template= "
            <h2>Hello</h2>
            <h3>You are receiving this email because we received a password reset request for your account.</h3>
            <br/><br/>
            <a href='http://localhost:8888/sales-analysis/html/pass_reset.php?token=$token&email=$get_email'>Click Me </a>
        ";
        
        $mail->Body =$email_template;//Message contenu dans le mail
        $mail->send();
    }

    //Aprés avoir cliquer sur le lien "forgot password ?"
    if(isset($_POST["send"]))
    {
        $email=mysqli_real_escape_string($mysqli, $_POST['email']);
        $token = md5(rand());

        $check_email = "SELECT email FROM vendeur WHERE email='$email' LIMIT 1";
        $check_email_run = mysqli_query($mysqli, $check_email);

        if(mysqli_num_rows($check_email_run)>0)
        {
            $row=mysqli_fetch_array($check_email_run);
            $get_email=$row['email'];

            $update_token="UPDATE vendeur SET verify_status='$token' WHERE email='$get_email' LIMIT 1";
            $update_token_run = mysqli_query($mysqli, $update_token);

            if($update_token_run)
            {
                send_password_reset($get_email, $token);
                echo "We e-mailed you a password link";
                header("Location: mail.php");
                exit(0);
            }
            else
            {
                $_SESSION['status']= "Something went wrong #1";
                header("Location: password_reset.php");
                exit(0);
            }
        } 
    }

    //Aprés avoir cliquer sur le lien du message
    if(isset($_POST['password_update']))
    {
        $email= mysqli_real_escape_string($mysqli, $_POST['email']);
        $new_password = mysqli_real_escape_string($mysqli, $_POST['new_password']);
        $confirm_password = mysqli_real_escape_string($mysqli, $_POST['confirm_password']);
        $token = mysqli_real_escape_string($mysqli, $_POST['password_token']);

        if(!empty($token))
        {
            if(!empty($email) && !empty($new_password) && !empty($confirm_password))
            {
                $check_token="SELECT verify_status FROM vendeur WHERE verify_status='$token' LIMIT 1";
                $check_token_run=mysqli_query($mysqli, $check_token);

                if(mysqli_num_rows($check_token_run) > 0)
                {
                    if($new_password == $confirm_password)
                    {
                        $update_password= "UPDATE vendeur SET password='$new_password' WHERE verify_status='$token' LIMIT 1";
                        $update_password_run= mysqli_query($mysqli, $update_password);

                        if($update_password_run)
                        {
                            $_SESSION['status']="New password succefully updated";
                            header("Location: login.php");
                            exit(0);
                        }
                        else
                        {
                            echo "FALSE1";   
                        }
                    }
                    else
                    {
                        echo "Password non identique";
                    }
                }
                else
                {
                    echo "FALSE2";
                }
            }
            
            else
            {
                echo "FALSE3";
            }
            
        }
        
        else
        {
            echo "FALSE4";
        }
        
     //Arret video 24:12
    }
    else
    {
        echo "FALSE5";
    }
?>