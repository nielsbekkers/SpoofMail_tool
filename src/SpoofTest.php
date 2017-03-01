<?php 
include("class.phpmailer.php"); 
include("class.smtp.php"); 
function executeSpoof() {
    $sendTo = $_POST['SendTo'];
    $subject = $_POST['Subject'];
    $from = $_POST['From'];
    $answer = $_POST['Answer'];
    $message = $_POST['Message'];
    $gmail = $_SESSION['gmail'];
    $ww = $_SESSION['password'];
    // Uncomment as needed for debugging
    //error_reporting(E_ALL);
    //error_reporting(E_STRICT);
    // Set as needed
    date_default_timezone_set('America/New_York');
    $mail = new PHPMailer(); 
    // Optionally get email body from external file
    //$body = file_get_contents('contents.html');
    //$body = eregi_replace("[\]",'',$body);
    $mail->IsSMTP();                            // telling the class to use SMTP
    $mail->Host       = "smtp.gmail.com";       // SMTP server
    $mail->SMTPDebug  = 2;                      // enables SMTP debug information (for testing)
                                                    // 0 default no debugging messages
                                                    // 1 = errors and messages
                                                    // 2 = messages only
    $mail->SMTPAuth   = true;                   // enable SMTP authentication
    //$mail->SMTPSecure = 'ssl';                // Not supported
    $mail->SMTPSecure = 'tls';                  // Supported
    $mail->Host       = "smtp.gmail.com";       // sets the SMTP server
    $mail->Port       = 587;                    // set the SMTP port for the GMAIL server
    $mail->Username   = $gmail;         // SMTP account username (how you login at gmail)
    $mail->Password   = $ww;      // SMTP account password (how you login at gmail)
 
    $mail->setFrom($answer, $from);
 
    $mail->addReplyTo($answer, $from);
 
    $mail->Subject    = $subject;
 
    $mail->AltBody    = "Gebruik een HTML-compatibele viewer om dit bericht te kunnen lezen!"; // optional, comment out and test
 
    $mail->msgHTML($message);
 
    $address = $sendTo;
    $mail->addAddress($address, "");
    // if you have attachments
    //$mail->addAttachment("phpmailer.gif");      // attachment 
    //$mail->addAttachment("phpmailer_mini.gif"); // attachment
 
    if(!$mail->Send()) {
      echo "<br/><div class='errorMessage'><b><i class='fa fa-bolt' aria-hidden='true'></i> FOUT! </b></div><br/>" . $mail->ErrorInfo;
    } else {
      echo "<br/><div class='succesMessage'><b><i class='fa fa-bolt' aria-hidden='true'></i> Bericht verzonden!</b></div><br/>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head> 
        <!-- @Author: Niels Bekkers -->

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- Website CSS style -->
        <link rel="stylesheet" type="text/css" href="css/mainAction.css">

        <!-- Website Font style -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
        
        <!-- Google Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

        <title>Spoofmail Tool</title>

        <style>
/* Center the loader */
#loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}

#myDiv {
  display: none;
  text-align: center;
}
</style>


    </head>
    <body onload="myFunction()">
        <div id="loader"></div>
        <div class="container animate-bottom" style="display:none;" id="myDiv">
            <div class="row main">
                <div class="panel-heading">
                   <div class="panel-title text-center">
                        <h1 class="title">Spoofmail Tool</h1>
                        <hr />
                    </div>
                </div> 
                <div class="main-login main-center">
                    <form class="form-horizontal" method="post" action="SpoofTest.php">
                        
                        <?php
                            //for($i = 1; $i < 3; $i++){
                                executeSpoof();
                                //sleep(3);
                            //}
                        ?>

                        <div class="form-group ">
                            <!--<input type="submit" class="btn btn-primary btn-lg btn-block login-button" Value="Terug" />-->
                            <a href="SpoofEmailTool.html" class="btn btn-primary btn-lg btn-block login-button">Terug</a>
                            <!--<button type="button" class="btn btn-primary btn-lg btn-block login-button">Verstuur</button>-->
                        </div>
                        <div class="login-register">
                            <i class="fa fa-copyright fa-lg" aria-hidden="true"></i> Niels Bekkers
                         </div>
                    </form>
                </div>
            </div>
        </div>
    </body>

    <script>
var myVar;

function myFunction() {
    myVar = setTimeout(showPage, 3000);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}
</script>
</html>