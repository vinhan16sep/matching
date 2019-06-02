<!doctype html>
<html><!-- InstanceBegin template="/Templates/temp.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Homepage</title>
    <link rel="shortcut icon" type="image/png" href="<?php echo site_url('assets/public/img/favicon.png'); ?>"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="<?php echo site_url('assets/scss/style.css') ?>">

</head>

<body id="homepage_landing">
    <header>
        <div class="nav-logo">
            <a href="<?php echo base_url('')?>">
                <img src="<?php echo site_url('assets/img/logo.png') ?>" alt="Logo Vinasa">
            </a>
        </div>

        <div class="nav-main">
            <ul>
                <li>
                    <a href="<?php echo base_url('member/user/login/') ?>" class="btn btn-default" role="button">
                        Đăng nhập
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('member/user/register/') ?>" class="btn btn-primary" role="button">
                        Đăng ký
                    </a>
                </li>
            </ul>
        </div>
    </header>

    <div class="cover-background" style="background-image: url('https://images.unsplash.com/photo-1528238646472-f2366160b6c1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1351&q=80')">
        <div class="wrapper">
            <div class="content">
                <h6>Matching Platform</h6>
                <h3>Be the Best for your business and client</h3>
                <ul>
                    <li>
                        <a href="<?php echo base_url('member/user/login/') ?>" class="btn btn-default" role="button">
                            Đăng nhập
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('member/user/register/') ?>" class="btn btn-primary" role="button">
                            Đăng ký
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</body>
</html>