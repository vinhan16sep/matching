<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">-->

<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">-->


<div class="container-fluid" id="matching">
    <div class="row">
        <!-- Area Chart -->
        <div class="left col-xl-4 col-lg-3">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $this->lang->line('Choose criteria') ?></h6>
                    <div class="dropdown no-arrow">
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <?php
                        echo form_open_multipart(base_url('member/matching/find?event_id=' . $event_id), array('class' => 'form-horizontal', 'method' => 'GET'));
                        echo form_hidden('event_id', $event_id);
                        ?>
                        <div class="row">
                            <?php if ($this->session->flashdata('error')): ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-warning"></i><?php echo $this->session->flashdata('error'); ?></h4>
                                </div>
                            <?php endif ?>

                            <div class="form-group col-lg-12">
                                <?php
                                echo form_label($this->lang->line('Matching category guide text'), 'category_id');
                                echo form_error('category_id[]');
                                ?>
                                <br>

                                <div class="tree-root">
                                    <ul>
                                        <?php if ($events): ?>
                                            <?php foreach ($events as $key => $value): ?>
                                                <li>
                                                    <?php
                                                    echo '<a href="#" class="expand"><i class="far fa-plus-square"></i></a>';
                                                    echo form_checkbox('category_id[]', $key, isset($_GET['category_id']) ? in_array($key, $_GET['category_id']) : false, 'class="btn-event event-'. $key .'" data-key=' . $key);
                                                    echo $value['name'];
                                                    ?>
                                                    <?php if ($value): ?>
                                                        <ul class="slide-service-<?php echo $key ?>"  data-key="<?php echo $key ?>">
                                                            <?php foreach ($value as $k => $val): ?>
                                                                    <?php if ($val): ?>
                                                                        <?php
                                                                        if (is_array($val)):
                                                                            echo '<li>';
                                                                            if (isset($val['name'])) {
                                                                                echo '<a href="#" class="expand"><i class="far fa-plus-square"></i></a>';
                                                                                echo form_checkbox('category_id[]', $k, isset($_GET['category_id']) ? in_array($k, $_GET['category_id']) : false, 'class="btn-service sub-event-' . $k .'"');
                                                                                echo $val['name'] . '<br>';
                                                                            }
                                                                            ?>
                                                                            <ul class="slide-service-sub-<?php echo $k ?>" data-key="<?php echo $k ?>">
                                                                                <?php foreach ($val as $item => $child): ?>
                                                                                    <?php if ($item != 'name'): ?>
                                                                                        <li>
                                                                                            <?php
                                                                                            //echo '<a href="#" class="expand"><i class="far fa-plus-square"></i></a>';
                                                                                            echo form_checkbox('category_id[]', $item, isset($_GET['category_id']) ? in_array($item, $_GET['category_id']) : false, 'class="btn-service btn-service-sub"');
                                                                                            echo $child . '<br>';
                                                                                            ?>
                                                                                        </li>
                                                                                    <?php endif ?>
                                                                                <?php endforeach ?>
                                                                            </ul>
                                                                            </li>
                                                                        <?php else: ?>
                                                                            <?php
                                                                            if ($k != 'name' && $val != $value['name']) {
                                                                                echo '<li>';
                                                                                echo form_checkbox('category_id[]', $k, isset($_GET['category_id']) ? in_array($k, $_GET['category_id']) : false, 'class="btn-service"');
                                                                                echo $val . '<br>';
                                                                                echo '</li>';
                                                                            }
                                                                            ?>
                                                                        <?php endif ?>
                                                                    <?php endif ?>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    <?php endif ?>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php endif ?>
                                    </ul>
                                </div>

<!--                                --><?php //if ($events): ?>
<!--                                    --><?php //foreach ($events as $key => $value): ?>
<!--                                        --><?php //
//                                            echo form_checkbox('category_id[]', $key, isset($_GET['category_id']) ? in_array($key, $_GET['category_id']) : false, 'class="btn-event event-'. $key .'" data-key=' . $key);
//                                            echo '<p>' . $value['name'] . '</p><br>';
//                                        ?>
<!--                                        --><?php //if ($value): ?>
<!--                                            <div style="margin-left: 20px" class="slide-service---><?php //echo $key ?><!--" data-key="--><?php //echo $key ?><!--">-->
<!--                                            --><?php //foreach ($value as $k => $val): ?>
<!--                                                --><?php //if ($val): ?>
<!--                                                    --><?php //
//                                                        if (is_array($val)):
//                                                            if (isset($val['name'])) {
//                                                                echo form_checkbox('category_id[]', $k, isset($_GET['category_id']) ? in_array($k, $_GET['category_id']) : false, 'class="btn-service sub-event-' . $k .'"');
//                                                                echo $val['name'] . '<br>';
//                                                            }
//                                                    ?>
<!--                                                        <div style="margin-left: 40px" class="slide-service-sub---><?php //echo $k ?><!--" data-key="--><?php //echo $k ?><!--">-->
<!--                                                            --><?php //foreach ($val as $item => $child): ?>
<!--                                                                --><?php //if ($item != 'name'): ?>
<!--                                                                    --><?php //
//                                                                        echo form_checkbox('category_id[]', $item, isset($_GET['category_id']) ? in_array($item, $_GET['category_id']) : false, 'class="btn-service btn-service-sub"');
//                                                                        echo $child . '<br>';
//                                                                    ?>
<!--                                                                --><?php //endif ?>
<!--                                                            --><?php //endforeach ?>
<!--                                                        </div>-->
<!--                                                    --><?php //else: ?>
<!--                                                        --><?php
//                                                            if ($k != 'name') {
//                                                                echo form_checkbox('category_id[]', $k, isset($_GET['category_id']) ? in_array($k, $_GET['category_id']) : false, 'class="btn-service"');
//                                                                echo $val . '<br>';
//                                                            }
//                                                        ?>
<!--                                                    --><?php //endif ?>
<!--                                                --><?php //endif ?>
<!--                                            --><?php //endforeach; ?>
<!--                                            </div>-->
<!--                                        --><?php //endif ?>
<!--                                    --><?php //endforeach ?>
<!--                                --><?php //endif ?>
                            </div>

                            <br>
                            <div class="col-sm-12 text-right" style="padding-left: 0 !important;">
                                <div class="pull-right">
                                    <?php
                                    echo form_submit('submit', $this->lang->line('Search'), 'class="btn btn-primary"');
                                    echo form_close();
                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class=" right col-xl-8 col-lg-9">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $this->lang->line('List') ?></h6>
                    <div class="dropdown no-arrow">
                        <a title="Xem toàn bộ" class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-arrow-alt-circle-right text-primary"></i>
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th style="text-align: center"><?= $this->lang->line('No.') ?></th>
                                <th style="text-align: center"><?= $this->lang->line('Company') ?></th>
                                <th style="text-align: center">Email</th>
                                <th style="text-align: center"><?= $this->lang->line('Mobile') ?></th>
                                <th style="text-align: center"><?= $this->lang->line('Action') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!empty($matched_setting)){
                                foreach($matched_setting as $key => $item) {
                            ?>
                                <tr id="<?= $item['id'] ?>">
                                    <td style="text-align: center"><?php echo $key + 1; ?></td>
                                    <td class="reg-client-company"><?php echo $item['register_info']['company']; ?></td>
                                    <td><?php echo $item['register_info']['email']; ?></td>
                                    <td><?php echo $item['register_info']['phone']; ?></td>
                                    <td style="text-align: center">
                                        <a title="<?= $this->lang->line('Send Request') ?>" class="btn-reg-client"
                                           href="<?php echo base_url('member/matching/create?target=' . $item['register_info']['id'] . '&event=' . $event_id) ?>"
                                        >
                                            <i class="fa fa-calendar-check" aria-hidden="true"></i>
                                        </a>
                                        &nbsp;&nbsp;
                                        <a href="javascript:void(0)"
                                            class="btn-reg-info" 
                                            data-id="<?php echo $item['register_info']['id'] ?>" 
                                            data-event="<?php echo $event_id ?>"
                                            title="<?= $this->lang->line('Show information') ?>"
                                        >
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="chart-area pt-4 pb-2">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End of Main Content -->

    <div class="popup" id="companyInfo">
        <div class="popup-content">
            <div class="popup-header">
                <h6 style="font-size: 1.1rem;">
                    <?= $this->lang->line('Company | Organization Information') ?>: <strong id="title-info"></strong>
                </h6>

                <button type="button" class="popup-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="popup-body check-height">
                <ul class="nav nav-tabs" id="companyInfomation" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="info-tab" data-toggle="tab" href="#infoTab" role="tab" aria-controls="info" aria-selected="true"><?= $this->lang->line('Company | Organization Information') ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-tab" data-toggle="tab" href="#productTab" role="tab" aria-controls="product" aria-selected="false"><?= $this->lang->line('Product/Solution') ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profileTab" role="tab" aria-controls="profile" aria-selected="false"><?= $this->lang->line('Field of operation') ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="market-tab" data-toggle="tab" href="#marketTab" role="tab" aria-controls="market" aria-selected="false"><?= $this->lang->line('Targeted markets') ?></a>
                    </li>
                </ul>
                <div class="tab-content" id="companyInfomationContent">
                    <div class="tab-pane fade show active" id="infoTab" role="tabpanel" aria-labelledby="info-tab">
                        <div class="row no-gutters">
                            <div class="left col-xs-12 col-lg-4">
                                <div class="wrapper">
                                    <label><?= $this->lang->line('Company') ?></label>
                                    <p id="company">No data</p>
                                </div>
                                <div class="wrapper">
                                    <label><?= $this->lang->line('Address') ?></label>
                                    <h6 id="address">No data</h6>
                                </div>
                                <div class="wrapper">
                                    <label><?= $this->lang->line('Legal Representative') ?></label>
                                    <h6 id="connector">No data</h6>
                                </div>
                            </div>

                            <div class="right col-xs-12 col-lg-4">
                                <div class="wrapper">
                                    <label>Website</label>
                                    <h6 id="website">No data</h6>
                                </div>
                                <div class="wrapper">
                                    <label>Email</label>
                                    <h6 id="email">No data</h6>
                                </div>
                                <div class="wrapper">
                                    <label><?= $this->lang->line('Mobile') ?></label>
                                    <h6 id="phone">No data</h6>
                                </div>
                            </div>
                            <div class="right col-xs-12 col-lg-4">
                                <div class="wrapper">
                                    <label><?= $this->lang->line("sonhanluc") ?></label>
                                    <h6 id="manpower">No data</h6>
                                </div>
                                <div class="wrapper">
                                    <label><?= $this->lang->line('doanhthunam') ?> 2018</label>
                                    <h6 id="revenue">No data</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane tab-text fade" id="productTab" role="tabpanel" aria-labelledby="product-tab">
                        <p id="product">No data</p>
                    </div>
                    <div class="tab-pane tab-text fade" id="profileTab" role="tabpanel" aria-labelledby="profile-tab">
                        <p id="profile">No data</p>
                    </div>
                    <div class="tab-pane tab-text fade" id="marketTab" role="tabpanel" aria-labelledby="market-tab">
                        <p id="market">No data</p>
                    </div>
                </div>
            </div>
            <div class="popup-footer">
                <a type="" class="btn btn-sm btn-primary" id="file-pdf" download><i class="fas fa-file-download"></i> <?= $this->lang->line('Download file PDF of company/organization') ?></a>
                <a title="<?= $this->lang->line('Send Request') ?>" class="btn btn-sm btn-success" id="btnMatching"
                   href="#"
                >
                    <?= $this->lang->line('Send Request') ?>
                </a>
                <button type="button" class="btn btn-sm btn-secondary popup-close" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
            </div>
        </div>
    </div>
</div>
<script>
</script>
<script type="text/javascript">
    $('.btn-event').click(function(){
        key = $(this).data('key');
        if($(this).prop("checked") == true){
            // $('.slide-service-' + key).slideDown();
            $('.slide-service-' + key).find('input').prop('checked',true);
        }else{
            // $('.slide-service-' + key).slideUp();
            $('.slide-service-' + key).find('input').prop('checked',false);
        }
        
    });
    $('.btn-service').click(function(){
        key = $(this).parent('div').data('key');
        if ($(this).prop("checked") == true) {
            // console.log($(this).parent('div').children('.btn-service:checkbox:not(:checked)').length);
            $('.event-' + key).prop('checked',true);
            
        }else{
            input_checked = $(this).parent('div').children('input').length;
            if ($(this).parent('div').children('.btn-service:checkbox:not(:checked)').length == input_checked) {
                $('.event-' + key).prop('checked',false);
            }
        }
    });

    $('.btn-service').click(function(){
        key = $(this).val();
        if($(this).prop("checked") == true){
            $('.slide-service-sub-' + key).find('input').prop('checked',true);
        }else{
            $('.slide-service-sub-' + key).find('input').prop('checked',false);
        }
    });

    $('.btn-service-sub').click(function(){
        key = $(this).parent('div').data('key');
        if ($(this).prop("checked") == true) {
            $('.sub-event-' + key).prop('checked',true);
            
        }else{
            input_checked = $(this).parent('div').children('input').length;
            console.log(input_checked + '---' + $(this).parent('div').children('.btn-service-sub:checkbox:not(:checked)').length);
            if ($(this).parent('div').children('.btn-service-sub:checkbox:not(:checked)').length == input_checked) {
                $('.sub-event-' + key).prop('checked',false);
            }
        }
    });

    $('.btn-reg-info').click(function(){
        var id = $(this).data('id');
        var event = $(this).data('event');
        var url = "<?php echo base_url('member/matching/create') ?>";
        var btnMatching = url + "?target=" + id + "&event=" + event;
        $.ajax({
            method: 'GET',
            url: '<?php echo base_url('member/matching/get_info') ?>',
            data: {
                id: id,
            },
            success: function(res){
                result = JSON.parse(res);

                if (result.status == true) {
                    console.log(result.info);
                    $('.popup').addClass('show');
                    //$('#btn-reg-info-modal').modal('show');
                    $('#title-info').html(result.info.company);
                    $('#company').html(result.info.company);
                    $('#website').html(result.info.website);
                    $('#connector').html(result.info.connector);
                    $('#position').html(result.info.position);
                    $('#address').html(result.info.address);
                    $('#file-pdf').attr('href', '<?php echo base_url('assets/upload/profile/') ?>' + result.info.file);

                    $('#email').html(result.info.email);
                    $('#phone').html(result.info.phone);

                    $('#manpower').html(result.info.manpower);
                    $('#revenue').html(result.info.revenue);

                    $('#product').html(result.info.product);
                    $('#profile').html(result.info.profile);
                    $('#market').html(result.info.market);

                    $("#btnMatching").attr("href", btnMatching);

                    if(result.info.file === null){
                        $('#file-pdf').hide();
                    }


    var popup_content = $('#companyInfo > .popup-content').height();
    var popup_header = $('#companyInfo .popup-header').height();
    var popup_body = $('#companyInfo .popup-body').height();
    var popup_footer = $('#companyInfo .popup-footer').height();
    console.log(popup_header);
    console.log(popup_body);
    console.log(popup_content-(popup_header+popup_footer));
    $('.popup-body.check-height').height(popup_content-(popup_header+popup_footer+10));



                }else{
                    alert('Doanh nghiệp không tồn tại hoặc đã hủy tham gia sự kiện');
                }

                closePopup(); //Close Popup
            }
        });
    });

    function closePopup(){
        const $btnClose = $('.popup').find('.popup-close');

        $btnClose.on('click', function(){
            $(this).closest('.popup').removeClass('show');
        })
    }

    $(document).ready(function (){
        treeView();
    });

    function treeView(){
        const $ul = $('.tree-root ul');

        if ( $ul.children('li').length > 0 ){
            $(this).each(function(){
                $ul.children('li').children('a.expand').unbind().on('click', function(e){
                    e.preventDefault();
                    $(this).siblings('ul').slideToggle();
                    $(this).children('i').toggleClass('fa-minus-square fa-plus-square');
                })
            })
        }

        $ul.find('li').find('a.epxand').unbind().on('click', function(e){
            e.preventDefault();
            $(this).addClass('target');
            $('.tree-root ul li a').not($(this)).removeClass('target');
        });

        $ul.find('li').find('a.head').on('click', function(e){
            e.preventDefault();
            $(this).addClass('selected');
            $('.tree-root ul li a').not($(this)).removeClass('selected');
        });
    }
</script>
