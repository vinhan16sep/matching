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
        <tr class="tr-header"><td colspan="2">Email kích hoạt tài khoản</td></tr>
        <tr class="tr-body">
            <td colspan="2">
                <h4>Kính gửi Quý công ty!</h4>
                <p>Cảm ơn Quý Công ty đã đăng ký tham gia Business Matching Online. Quý Công ty đã sử dụng email: <a href="mailto: <?= $identity ?>"><?= $identity ?></a> để đăng ký tài khoản tham gia chương trình.</p>
            </td>
        </tr>
        <tr class="tr-body">
            <td colspan="2">Vui lòng bấm vào đường link <a href="<?php echo base_url('member/user/activate/'. $id .'/'. $activation . '/' . 'vi') ;?>">đây</a> để kích hoạt tài khoản và khai hồ sơ.</td>
        </tr>
        <tr class="tr-body">
            <td colspan="2">
                <p>Nếu cần hỗ trợ, vui lòng liên hệ: <b>Mr. Nguyễn Thế Anh</b></p>
                <p>Hiệp hội Phần mềm và Dịch vụ CNTT Việt Nam</p>
                <p>Tầng 11, tòa nhà Cung Trí thức thành phố, Số 1 Tôn Thất Thuyết, Cầu Giấy, Hà Nội</p>
                <p>Email: <a href="mailto: anhnt@vinasa.org.vn">anhnt@vinasa.org.vn</a></p>
                <p>Mobile: <b>+84 913196699
</b></p>
            </td>
        </tr>
        <tr class="tr-footer">
            <td colspan="2">
                <h6>Hiệp hội Phần mềm và dịch vụ CNTT Việt Nam (VINASA)</h6>
                <p>Địa chỉ: Tầng 11, tòa nhà Cung Trí thức, 01 Tôn Thất Thuyết, Cầu Giấy, Hà Nội</p>
                <p>Điện thoại: +8424 35772336 - +8424 35772338; Email: contact@vinasa.org.vn</p>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
