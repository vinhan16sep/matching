<?php 
include "class.phpmailer.php";
include "class.smtp.php";


function send_mail($email, $data) {
    $mail = new PHPMailer();
    $mail->IsSMTP(); // set mailer to use SMTP
    $mail->Host = "smtp.gmail.com"; // specify main and backup server
    $mail->Port = 465; // set the port to use
    $mail->SMTPAuth = true; // turn on SMTP authentication
    $mail->SMTPSecure = 'ssl';
    $mail->Username = "nghemalao@gmail.com"; // your SMTP username or your gmail username
    $mail->Password = "ghozqjiyuhyaocmx"; // your SMTP password or your gmail password
    $from = "nghemalao@gmail.com"; // Reply to this email
    $to = $email; // Recipients email ID
    $name = 'WEBMAIL'; // Recipient's name
    $mail->From = $from;
    $mail->FromName = $name; // Name to indicate where the email came from when the recepient received
    $mail->AddAddress($to, $name);
    $mail->CharSet = 'UTF-8';
    $mail->WordWrap = 50; // set word wrap
    $mail->IsHTML(true); // send as HTML
    $mail->Subject = "Mail từ Matching";

    $mail->Body = email_template($data); //HTML Body

    // $mail->SMTPDebug = 2;

    if(!$mail->Send()){
        return false;
    } else {
        return true;
    }
}

function email_template($data){
    $message = '<html><body>';
    $message .= '<p> Nhận tài khoản </p>';
    $message .= '<p>'. $data['company'] .'</p>';
    $message .= '<p>'. $data['connector'] .'</p>';
    $message .= '<p>'. $data['position'] .'</p>';
    $message .= '<p>'. $data['phone'] .'</p>';
    $message .= '<p>'. $data['address'] .'</p>';
    $message .= '<p> Mã code: <strong>'. $data['code'] .'</strong></p>';
    $message .= "</body></html>";

    return $message;
}