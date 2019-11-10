<?php 
include "class.phpmailer.php";
include "class.smtp.php";


function send_mail($email, $data, $layout = 'user',$lang = 'vi') {
    $CI =& get_instance();
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
    $name = 'bmo.vinasa.org.vn'; // Recipient's name
    $mail->From = $from;
    $mail->FromName = $name; // Name to indicate where the email came from when the recepient received
    $mail->AddAddress($to, $name);
    $mail->CharSet = 'UTF-8';
    $mail->WordWrap = 50; // set word wrap
    $mail->IsHTML(true); // send as HTML
    $mail->Subject = $CI->lang->line('Mail from Matching Platform');
    if ($layout == 'user_temp_register') {
        $data_send_mail['message'] = $data;
        if ($lang == 'vi') {
            $view = '';
        }else{
            $view = '_en';
        }
        $mail->Body = $CI->load->view('auth/email_member/matching/email_template' . $view . '.tpl.php',$data_send_mail,true);
    }
    if ($layout == 'admin') {
        $mail->Body = email_template_admin($data); //HTML Body
    }
    if ($layout == 'look') {
        $mail->Body = email_template_look_account($data); //HTML Body
    }
    if ($layout == 'active') {
        echo 1123;die;
        $mail->Body = email_template_active_account($data); //HTML Body
    }
    if ($layout == 'free') {
        $mail->Body = email_template_account_free($data); //HTML Body
    }
    

    // $mail->SMTPDebug = 2;

    if(!$mail->Send()){
        return false;
    } else {
        return true;
    }
}

function email_template($data){
    $CI =& get_instance();
    $data_send_mail['message'] = $data;
    return $CI->load->view('auth/email_member/matching/email_template.tpl.php',$data_send_mail,true);
}

function email_template_admin($data){
	$CI =& get_instance();
	$data_send_mail['message'] = $data;
	return $CI->load->view('auth/email_admin/matching/email_template_admin.tpl.php',$data_send_mail,true);
}

function email_template_look_account($data){
	$CI =& get_instance();
	$data_send_mail['message'] = $data;
	return $CI->load->view('auth/email_admin/look_account/email_template_look_account.tpl.php',$data_send_mail,true);
}
function email_template_active_account($data){
    $CI =& get_instance();
    $data_send_mail['message'] = $data;
    return $CI->load->view('auth/email_member/matching/email_template_active_account.tpl.php',$data_send_mail,true);
}
function email_template_account_free($data){
    $CI =& get_instance();
    $data_send_mail['message'] = $data;
    return $CI->load->view('auth/email_member/matching/email_template_account_free.tpl.php',$data_send_mail,true);
}

function send_mail_matching($email, $data, $matching = 'create', $role = 'admin'){
    $CI =& get_instance();
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
    $name = 'bmo.vinasa.org.vn'; // Recipient's name
    $mail->From = $from;
    $mail->FromName = $name; // Name to indicate where the email came from when the recepient received
    $mail->AddAddress($to, $name);
    $mail->CharSet = 'UTF-8';
    $mail->WordWrap = 50; // set word wrap
    $mail->IsHTML(true); // send as HTML
    $mail->Subject = $CI->lang->line('Mail from Matching Platform');

    if ($matching == 'create') {
        if ($role == 'admin') {
            $mail->Body = email_template_matching_create_role_admin($data); //HTML Body
        }else{
            $mail->Body = email_template_matching_create($data); //HTML Body
        }
    }
    if ($matching == 'approve') {
        if ($role == 'admin') {
            $mail->Body = email_template_matching_approve_role_admin($data); //HTML Body
        }else{
            $mail->Body = email_template_matching_approve($data); //HTML Body
        }
    }
    if ($matching == 'reject') {
        $mail->Body = email_template_matching_reject($data); //HTML Body
    }

    // $mail->SMTPDebug = 2;

    if(!$mail->Send()){
        return false;
    } else {
        return true;
    }
}

function email_template_matching_create($data){
    $CI =& get_instance();
    $data_send_mail['message'] = $data;

    if($CI->session->userdata('langAbbreviation') == 'vi'){
        return $CI->load->view('auth/email_member/matching/appointment_template.tpl.php',$data_send_mail,true);
    }else{
        return $CI->load->view('auth/email_member/matching/appointment_template_en.tpl.php',$data_send_mail,true);
    }
}

function email_template_matching_create_role_admin($data){
    $CI =& get_instance();
    $data_send_mail['message'] = $data;
    return $CI->load->view('auth/email_admin/matching/appointment_template.tpl.php',$data_send_mail,true);
}

function email_template_matching_approve($data){
    $CI =& get_instance();
    $data_send_mail['message'] = $data;

    if($CI->session->userdata('langAbbreviation') == 'vi'){
        return $CI->load->view('auth/email_member/matching/approve_template.tpl.php',$data_send_mail,true);
    }else{
        return $CI->load->view('auth/email_member/matching/approve_template_en.tpl.php',$data_send_mail,true);
    }
}

function email_template_matching_approve_role_admin($data){
    $CI =& get_instance();
    $data_send_mail['message'] = $data;
    return $CI->load->view('auth/email_admin/matching/approve_template.tpl.php',$data_send_mail,true);
}

function email_template_matching_reject($data){
    $CI =& get_instance();
    $data_send_mail['message'] = $data;

    if($CI->session->userdata('langAbbreviation') == 'vi'){
        return $CI->load->view('auth/email_member/matching/reject_template.tpl.php',$data_send_mail,true);
    }else{
        return $CI->load->view('auth/email_member/matching/reject_template_en.tpl.php',$data_send_mail,true);
    }
}