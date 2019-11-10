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
        <tr class="tr-header"><td colspan="2">Email confirmation of successful registration</td></tr>
        <tr class="tr-body">
            <td colspan="2">
                <h4>Dear esteemed Company! </h4>
                <p>Your email: <a href="mailto:<?php echo $message['email']; ?>"><?php echo $message['email']; ?></a> has been used for registration on VINASA's Business Matching Online system.</p>
            </td>
        </tr>
        <tr class="tr-body">
            <td>Code</td>
            <td><?php echo $message['code']; ?></td>
        </tr>
        <tr class="tr-body">
            <td colspan="2">
                <p>After the admin approves the account to register the event, the system will activate for you a function to search partner for business matching and will have a notification via your email.</p>
                <p>If any problem araises, please contact Ms. Hoàng Minh Thư, mobile: 0385 796 096, email: <a href="mailto:minhmc@vinasa.org.vn">minhmc@vinasa.org.vn</a> for further support.</p>
            </td>
        </tr>
        <tr class="tr-body">
            <td colspan="2">
                <h4>Bank account information:</h4>
            </td>
        </tr>
        <tr class="tr-body">
            <td>Account name:</td>
            <td>Vietnam Software and IT Services Association</td>
        </tr>
        <tr class="tr-body">
            <td>Bank:</td>
            <td>Joint Stock Commercial Bank for Foreign Trade of Vietnam</td>
        </tr>
        <tr class="tr-body">
            <td>Account number:</td>
            <td>049.100.004.8212<br>At Joint Stock Commercial Bank for Foreign Trade of Vietnam, Thang Long branch</td>
        </tr>
        <tr class="tr-footer">
            <td colspan="2">
                <h6>Vietnam Software and IT Services Association(VINASA)</h6>
                <p>Address: Tầng 11, tòa nhà Cung Trí thức, 01 Tôn Thất Thuyết, Cầu Giấy, Hà Nội</p>
                <p>Phone: 024 35772336 - 024 35772338; Email: contact@vinasa.org.vn</p>
            </td>
        </tr>
    </table>
</div>
</body>
</html>