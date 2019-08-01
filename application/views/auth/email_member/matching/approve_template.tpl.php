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
        <tr class="tr-header"><td colspan="2">Email xác nhận cuộc hẹn thành công</td></tr>
        <tr class="tr-body">
            <td colspan="2">
                <h4>Kính gửi <?= $message['finder_name'] ?>!</h4>
                <p>Thư xác nhận lịch business matching 1:1 tại:</p>
                <p>Sự kiện: Diễn đàn Cấp cao CNTT-TT Việt Nam 2019</p>
            </td>
        </tr>
        <tr class="tr-body">
            <td colspan="2">
                <p>Business Matching: <?= $message['target_name'] . ' - ' . $message['finder_name'] ?></p>
                <p>Thời gian:<?= $message['date'] ?>.</p>
                <p>Địa điểm: Phòng Business Matching Area, Khách sạn Melia Hà Nội, 44 Lý Thường Kiệt</p>
            </td>
        </tr>
        <tr class="tr-body">
            <td colspan="2">
                <p>Để buổi làm việc đạt hiệu quả cao, Kính đề nghị Quý Đơn vị đến làm việc đúng giờ và tuân thủ theo thời gian meeting đã hẹn.</p>
                <p>Mọi thông tin thay đổi xin vui lòng báo lại cho Ban tổ chức</p>
                <p>Trân trọng cảm ơn Anh/Chị và mong được đón tiếp tại Vietnam ICT Summit 2019.</p>
                <p>Đầu mối hỗ trợ: Ms. Hoàng Minh Thư   (HP: 0385 796 096)
</p>
            </td>
        </tr>
        <tr class="tr-body">
            <td colspan="2">
                <p style="color: red; font-style: italic">Xin Vui Lòng Mang Theo Name Card/Profile Doanh nghiệp khi tham dự Giao Thương</p>
            </td>
        </tr>
        <tr class="tr-footer">
            <td colspan="2">
                <h6>Hiệp hội Phần mềm và dịch vụ CNTT Việt Nam (VINASA)</h6>
                <p>Địa chỉ: Tầng 11, tòa nhà Cung Trí thức, 01 Tôn Thất Thuyết, Cầu Giấy, Hà Nội</p>
                <p>Điện thoại: 024 35772336 - 024 35772338; Email: contact@vinasa.org.vn</p>
            </td>
        </tr>
    </table>
</div>
</body>
</html>