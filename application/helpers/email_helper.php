<?php 
include "class.phpmailer.php";
include "class.smtp.php";


function send_mail($email, $data, $layout = 'user') {
    $mail = new PHPMailer();
    $mail->IsSMTP(); // set mailer to use SMTP
    $mail->Host = "smtp.gmail.com"; // specify main and backup server
    $mail->Port = 465; // set the port to use
    $mail->SMTPAuth = true; // turn on SMTP authentication
    $mail->SMTPSecure = 'ssl';
    $mail->Username = "support@vinasa.org.vn"; // your SMTP username or your gmail username
    $mail->Password = "kcirpkmdlgbcobcv"; // your SMTP password or your gmail password
    $from = "support@vinasa.org.vn"; // Reply to this email
    $to = $email; // Recipients email ID
    $name = 'http://bmo.vinasa.org.vn/'; // Recipient's name
    $mail->From = $from;
    $mail->FromName = $name; // Name to indicate where the email came from when the recepient received
    $mail->AddAddress($to, $name);
    $mail->CharSet = 'UTF-8';
    $mail->WordWrap = 50; // set word wrap
    $mail->IsHTML(true); // send as HTML
    $mail->Subject = "Mail từ Matching Platform";

    if ($layout == 'user') {
        $mail->Body = email_template($data); //HTML Body
    }
    if ($layout == 'admin') {
        $mail->Body = email_template_admin($data); //HTML Body
    }
    if ($layout == 'look') {
        $mail->Body = email_template_look_account($data); //HTML Body
    }
    

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

function email_template_admin($data){
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

function email_template_look_account($data){
    $message = '<html><body>';
    $message .= '<p> Sự kiện: <strong>'. $data['event_name'] .'</strong> đã kết thúc</p>';
    $message .= '<p> Tk này sẽ khóa</p>';
    $message .= "</body></html>";

    return $message;
}