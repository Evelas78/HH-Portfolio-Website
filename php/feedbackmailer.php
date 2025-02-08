

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$mail = new PHPMailer(true);
    $mail->SMTPDebug = 1;                                       
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com;';                    
    $mail->SMTPAuth   = true;                             
    $mail->SMTPSecure = 'tls';                              
    $mail->Port       = 587;  
    $mail->Username = "homelesshobowebsitemailer@gmail.com";
    $mail->Password = 'censored';
    $mail->addAddress("thehomelesshobogames@gmail.com");
$f_name_err = $f_email_err = $f_topic_err = $f_feedback_err = "";
$f_name = $f_email = $f_topic = $f_feedback = $message = "";
$send_email = false;

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $send_email = true;
    if(empty($_POST["f_name"]))
    {
        $f_name_err = "Name is a required field";
        $send_email = false;
    }
    else{
        $f_name = test_input($_POST["f_name"]);
    }
    if(empty($_POST["f_email"]))
    {
        $f_email_err = "Email is a required field";
    }
    else{
        $f_email = test_input($_POST["f_email"]);
        if (!filter_var($f_email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $send_email = false;
        }
    }
    if(empty($_POST["f_topic"]))
    {
        $f_topic_err = "Topic is a required field";
        $send_email = false;
    }
    else{
        $f_topic = test_input($_POST["f_topic"]);
    }
    if(empty($_POST["f_feedback"]))
    {
        $f_feedback_err = "Feedback is a required field";
        $send_email = false;
    }
    else{
        $f_feedback = test_input($_POST["f_feedback"]);
    }

    //Code to send the email to thehomelesshobogames@gmail.com 
    //then reset all fields and email
    if($send_email)
    {
        $mail->Subject = $f_topic;

        $message = $f_name . "\n" . $f_email . "\n\n" . $f_feedback;

        $mail->Body = $message;

        $mail->send();

        $f_name = $f_email = $f_topic = $f_feedback = $message = "";
    }
}

//Credit: GeekForGeeks
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>