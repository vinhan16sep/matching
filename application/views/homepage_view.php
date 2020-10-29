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

    <script src="<?php echo site_url('assets/vendor/jquery/jquery.min.js'); ?>" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="<?php echo site_url('assets/scss/style.css') ?>">

</head>

<body id="homepage_landing">
    <header>
        <div class="nav-logo">
            <a href="<?php echo base_url('')?>">
                <img src="<?php echo site_url('assets/img/logo-w.svg') ?>" alt="Logo Vinasa">
            </a>
        </div>
        <div class="nav-main">
            <ul style="float: left;background-color: white;">
                <li style="background-color: white;" class="nav-item dropdown no-arrow li-lang <?php echo ($this->session->userdata('langAbbreviation') == 'vi') ? 'active' : '' ?>">
                    <a style="padding:8px 8px;font-weight: bold;padding-left: 10px;" class="nav-link change-language" data-language="vi" href="javascript:void(0)" href="<?php echo base_url('member/user/login') ?>">
                        Vi
                    </a>
                </li>
                <li style="background-color: white;" class="nav-item dropdown no-arrow li-lang <?php echo ($this->session->userdata('langAbbreviation') == 'en') ? 'active' : '' ?>">
                    <a style="padding:8px 8px;font-weight: bold;padding-right: 10px;" class="nav-link change-language" data-language="en" href="javascript:void(0)" href="<?php echo base_url('member/user/login') ?>">
                        En
                    </a>
                </li>
            </ul>
            <ul style="float: left;">
                <li>
                    <a href="<?php echo base_url('member/user/login/') ?>" class="btn btn-default" role="button">
                        <?= $this->lang->line('Login') ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('member/user/register/') ?>" class="btn btn-primary" role="button">
                        <?= $this->lang->line('Register') ?>
                    </a>
                </li>
            </ul>
        </div>
    </header>

    <div class="cover-background" style="background-image: url('assets/img/63a9d1ff855679082047.jpg')">
        <div class="wrapper">
            <div class="content">
                <h6>VINASA Business Matching Online Platform</h6>
                <h3>VIETNAM DX DAY 2020</h3>
                <ul>
                    <li>
                        <a href="<?php echo base_url('member/user/login/') ?>" class="btn btn-default" role="button">
                            <?= $this->lang->line('Login') ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('member/user/register/') ?>" class="btn btn-primary" role="button">
                            <?= $this->lang->line('Register') ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</body>
<script>
    var url = window.location.protocol + '//' + window.location.hostname;

    $(".change-language").click(function(){
        $.ajax({
            method: "GET",
            url: "<?php echo base_url(); ?>homepage/change_language",
            data: {
                lang: $(this).data('language')
            },
            async:false,
            success: function(res){
                if(res.message == 'changed'){
                    window.location.reload();
                }
            },
            error: function(){

            }
        });
    });
</script>
</html>