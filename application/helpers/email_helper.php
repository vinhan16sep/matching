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
    $name = 'bmo.vinasa.org.vn'; // Recipient's name
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
    $CI =& get_instance();

    $message = '<table>';
	$message .= '<tr class="tr-header"><td colspan="2">Email xác nhận đăng ký thành công</td></tr>';
	$message .= '<tr class="tr-body">';
	$message .= '<td colspan="2">';
	$message .= '<h4>Kính gửi Quý công ty!</h4>';
	$message .= '<p>Quý công ty đã sử dụng mail: <a href="mailto:abc@xyz.me">abc@xyz.me</a> để đăng ký tài khoản trên hệ thống Business Matching Online của VINASA.</p>';
	$message .= '</td>';
	$message .= '</tr>';
	$message .= '<tr class="tr-body">';
	$message .= '<td>Mã code</td>';
	$message .= '<td>'. $data['code'] .'</td>';
	$message .= '</tr>';
	$message .= '<tr class="tr-body">';
	$message .= '<td colspan="2">';
	$message .= '<p>Xin vui lòng thanh toán phí tham gia matching là 1500USD với nội dung như sau: <b>Mã code + matching ictsummit</b></p>';
	$message .= '<p>Sau khi nhận được phí chuyển khoản, hệ thống sẽ gửi email cung cấp password để Quý công ty đăng nhập và thực hiện tìm kiếm đối tác.</p>';
	$message .= '<p>Trường hợp không đăng ký được vui lòng liên hệ: Anh Mạc Công Minh, mobile: 0936 136 696, email: minhmc@vinasa.org.vn để được hỗ trợ.</p>';
	$message .= '</td>';
	$message .= '</tr>';
	$message .= '<tr class="tr-body">';
	$message .= '<td colspan="2">';
	$message .= '<h4>Thông tin tài khoản:</h4>';
	$message .= '</td>';
	$message .= '</tr>';
	$message .= '<tr class="tr-body">';
	$message .= '<td>Tên Tài khoản:</td>';
	$message .= '<td>Hiệp hội Phần mềm và Dịch vụ CNTT Việt Nam</td>';
	$message .= '</tr>';
	$message .= '<tr class="tr-body">';
	$message .= '<td>Ngân hàng:</td>';
	$message .= '<td>TMCP Ngoại Thương</td>';
	$message .= '</tr>';
	$message .= '<tr class="tr-body">';
	$message .= '<td>Số Tài khoản:</td>';
	$message .= '<td>049.100.004.8212<br>Tại Ngân hàng TMCP Ngoại Thương chi nhánh Thăng Long</td>';
	$message .= '</tr>';
	$message .= '<tr class="tr-footer">';
	$message .= '<td colspan="2">';
	$message .= '<ul>';
	$message .= '<li><a href="#" target="_blank">Facebook</a></li>';
	$message .= '<li><a href="#" target="_blank">Twitter</a></li>';
	$message .= '<li><a href="#" target="_blank">Instagram</a></li>';
	$message .= '</ul>';
	$message .= '<h6>Cong ty VINASA</h6>';
	$message .= '<p>Trường hợp không đăng nhập được vui lòng liên hệ: Anh Mạc Công Minh, mobile: 0936 136 696, email: minhmc@vinasa.org.vn để được hỗ trợ</p>';
	$message .= '</td>';
	$message .= '</tr>';
	$message .= '</table>';

//    $message .= '<p> Nhận tài khoản </p>';
//    $message .= '<p>'. $data['company'] .'</p>';
//    $message .= '<p>'. $data['connector'] .'</p>';
//    $message .= '<p>'. $data['position'] .'</p>';
//    $message .= '<p>'. $data['phone'] .'</p>';
//    $message .= '<p>'. $data['address'] .'</p>';
//    $message .= '<p> Mã code: <strong>'. $data['code'] .'</strong></p>';
//    $message .= "</body></html>";
    $data_send_mail['message'] = $data;
    return $CI->load->view('auth/email_member/matching/email_template.tpl.php',$data_send_mail,true);
    return $message;
}

function email_template_admin($data){
	$CI =& get_instance();

	$message = '<table>';
	$message .= '<tr class="tr-header"><td colspan="2">Email cung cấp mật khẩu</td></tr>';
	$message .= '<tr class="tr-body">';
	$message .= '<td colspan="2">';
	$message .= '<h4>Tài khoản đăng nhập:</h4>';
	$message .= '</td>';
	$message .= '</tr>';
	$message .= '<tr class="tr-body">';
	$message .= '<td>Email:</td>';
	$message .= '<td>support3@vinasa.org.vn</td>';
	$message .= '</tr>';
	$message .= '<tr class="tr-body">';
	$message .= '<td>Mật Khẩu:</td>';
	$message .= '<td>0m5ndzl0</td>';
	$message .= '</tr>';
	$message .= '<tr class="tr-footer">';
	$message .= '<td colspan="2">';
	$message .= '<ul>';
	$message .= '<li><a href="#" target="_blank">Facebook</a></li>';
	$message .= '<li><a href="#" target="_blank">Twitter</a></li>';
	$message .= '<li><a href="#" target="_blank">Instagram</a></li>';
	$message .= '</ul>';
	$message .= '<h6>Cong ty VINASA</h6>';
	$message .= '<p>Trường hợp không đăng nhập được vui lòng liên hệ: Anh Mạc Công Minh, mobile: 0936 136 696, email: minhmc@vinasa.org.vn để được hỗ trợ</p>';
	$message .= '</td>';
	$message .= '</tr>';
	$message .= '</table>';

//    $message = '<html><body>';
//    $message .= '<p> Nhận tài khoản </p>';
//    $message .= '<p>'. $data['company'] .'</p>';
//    $message .= '<p>'. $data['connector'] .'</p>';
//    $message .= '<p>'. $data['position'] .'</p>';
//    $message .= '<p>'. $data['phone'] .'</p>';
//    $message .= '<p>'. $data['address'] .'</p>';
//    $message .= '<p> Mã code: <strong>'. $data['code'] .'</strong></p>';
//    $message .= "</body></html>";

	$data_send_mail['message'] = $data;
	return $CI->load->view('auth/email_member/matching/email_template.tpl.php',$data_send_mail,true);
	return $message;
}

function email_template_look_account($data){
    $message = '<html><body>';
    $message .= '<p> Sự kiện: <strong>'. $data['event_name'] .'</strong> đã kết thúc</p>';
    $message .= '<p> Tk này sẽ khóa</p>';
    $message .= "</body></html>";

    return $message;
}

function send_mail_matching($email, $data, $matching = 'create', $role = 'admin'){
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
    $mail->Subject = "Mail từ Matching Platform";

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

function email_template_matching_create(){
    return 'email hẹn gặp của member';
}

function email_template_matching_create_role_admin(){
    return 'email hẹn gặp của member gửi cho admin';
}

function email_template_matching_approve(){
    return 'email đồng ý hẹn gặp của member';
}

function email_template_matching_approve_role_admin(){
    return 'email đồng ý hẹn gặp của member gửi cho admin';
}

function email_template_matching_reject(){
    return 'email từ chối hẹn gặp của member';
}