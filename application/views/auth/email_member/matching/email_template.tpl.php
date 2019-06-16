<!DOCTYPE html>
<html>
<head>
	<title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0 " />
	<style>
        .email-wrapper{
            max-width: 700px;
            overflow: auto;

            margin: 0 auto;

            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
        }

        .email-wrapper table{
            width: 100%;
            border-spacing: 0
        }

        .email-wrapper table tr.tr-header{
            width: 100%;
            height: 70px;
            background-image: linear-gradient(to bottom right, #2477AD, #72BCE0);
            font-weight: 700;
            text-transform: uppercase;
        }

        .email-wrapper table tr.tr-header td{
            text-align: center;
            color: #fff;
        }

        .email-wrapper table tr.tr-body{
            background-color: #fff;
        }

        .email-wrapper table tr.tr-body td{
            padding: 7px 15px;
        }

        .email-wrapper table tr.tr-body td h4{
            font-size: 1.125rem;
            margin: 0 0 7px;
        }

        .email-wrapper table tr.tr-body td p{
            font-size: 1rem;
            color: #A3A3A3;
        }

        .email-wrapper table tr.tr-body td a{
            color: #007DFF;
        }

        .email-wrapper table tr.tr-footer{
            width: 100%;
            height: 100px;
            background-color: #E0E0E0;
        }

        .email-wrapper table tr.tr-footer td{
            text-align: center;
        }

        .email-wrapper table tr.tr-footer td ul{
            list-style: none;
            padding-left: 0;
        }

        .email-wrapper table tr.tr-footer td ul li{
            display: inline-block;
            margin: 0 7px;
        }

        .email-wrapper table tr.tr-footer td ul li a{
            font-size: 10px;
            color: #666;
        }

        .email-wrapper table tr.tr-footer h6{
            font-size: 1rem;

            margin: 0 0 7px;
        }

        .email-wrapper table tr.tr-footer p{
            font-size: 0.75rem;
            color: #A3A3A3;
        }
    </style>
</head>
<body>
<div class="email-wrapper">
    <table>
        <tr class="tr-header"><td colspan="2">Email xác nhận đăng ký thành công</td></tr>
        <tr class="tr-body">
            <td colspan="2">
                <h4>Kính gửi Quý công ty!</h4>
                <p>Quý công ty đã sử dụng mail: <a href="mailto:<?php echo $message['email']; ?>"><?php echo $message['email']; ?></a> để đăng ký tài khoản trên hệ thống Business Matching Online của VINASA.</p>
            </td>
        </tr>
        <tr class="tr-body">
            <td>Mã code</td>
            <td><?php echo $message['code']; ?></td>
        </tr>
        <tr class="tr-body">
            <td colspan="2">
                <p>Xin vui lòng thanh toán phí tham gia matching là 1500USD với nội dung như sau: <b>Mã code + matching ictsummit</b></p>
                <p>Sau khi nhận được phí chuyển khoản, hệ thống sẽ gửi email cung cấp password để Quý công ty đăng nhập và thực hiện tìm kiếm đối tác.</p>
                <p>Trường hợp không đăng ký được vui lòng liên hệ: Anh Mạc Công Minh, mobile: 0936 136 696, email: minhmc@vinasa.org.vn để được hỗ trợ.</p>
            </td>
        </tr>
        <tr class="tr-body">
            <td colspan="2">
                <h4>Thông tin tài khoản:</h4>
            </td>
        </tr>
        <tr class="tr-body">
            <td>Tên Tài khoản:</td>
            <td>Hiệp hội Phần mềm và Dịch vụ CNTT Việt Nam</td>
        </tr>
        <tr class="tr-body">
            <td>Ngân hàng:</td>
            <td>TMCP Ngoại Thương</td>
        </tr>
        <tr class="tr-body">
            <td>Số Tài khoản:</td>
            <td>049.100.004.8212<br>Tại Ngân hàng TMCP Ngoại Thương chi nhánh Thăng Long</td>
        </tr>
        <tr class="tr-footer">
            <td colspan="2">
                <h6>Công ty VINASA</h6>
                <p>Trường hợp không đăng nhập được vui lòng liên hệ: Anh Mạc Công Minh, mobile: 0936 136 696, email: minhmc@vinasa.org.vn để được hỗ trợ</p>
            </td>
        </tr>
    </table>
</div>
</body>
</html>