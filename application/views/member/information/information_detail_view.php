<style type="text/css">
    .error{
        color: red;
        position: relative;
        line-height: 1;
        width: 100%;
        font-size: 1rem !important;
    }
</style>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <?php if ($this->session->flashdata('message_error')): ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-warning"></i> <?= $this->lang->line('thongbao'); ?>!</h4>
                            <?php echo $this->session->flashdata('message_error'); ?>
                        </div>
                    <?php endif ?>
                    <?php if ($this->session->flashdata('message_success')): ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-success"></i> <?= $this->lang->line('thongbao'); ?>!</h4>
                            <?php echo $this->session->flashdata('message_success'); ?>
                        </div>
                    <?php endif ?>
                    <?php
                        function build_textarea($name, $value = ''){
                            return array(
                                'name' => $name,
                                'class' => 'form-control',
                                'rows' => '4',
                                'cols' => '40',
                                'value'=> $value
                            );
                        }
                    ?>
                    
                    <?php echo form_open_multipart('', array('class' => 'form-horizontal')); ?>
                    
                    <div class="form-group">
                        <?php echo form_label('Logo: ', 'logo'); ?><br>
                        <?php if (isset($temp) && !empty($temp['logo'])): ?>
                            <img src="<?= base_url('assets/upload/profile/' . $temp['logo']) ?>" width="30%">
                            <br>
                        <?php endif ?>
                        <?php echo form_error('logo', '<div class="error">', '</div>'); ?><br>
                        <?php echo form_upload('logo', '', 'class=""'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label($this->lang->line("Company name").': ', 'company'); ?>
                        <?php echo form_error('company', '<div class="error">', '</div>'); ?>
                        <?php echo form_input('company', $company, 'class="form-control" readonly'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label($this->lang->line('Is your company/ organization providing or applying IT?'), 'is_state'); ?>
                        <?php echo form_error('is_state', '<div class="error">', '</div>'); ?>
                        <br>
                        <?php echo form_checkbox('is_state', 1, (isset($temp) && !empty($temp['is_state']))? ($temp['is_state'] == 1) ? true : false : set_checkbox('is_state', 1), ''); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label($this->lang->line("Address (Vietnamese)").': ', 'address'); ?>
                        <?php echo form_error('address', '<div class="error">', '</div>'); ?>
                        <?php echo form_input('address', (isset($temp) && !empty($temp['address']))? $temp['address'] : set_value('address'), 'class="form-control"'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label($this->lang->line("Address (English)").': ', 'address_en'); ?>
                        <?php echo form_error('address_en', '<div class="error">', '</div>'); ?>
                        <?php echo form_input('address_en', (isset($temp) && !empty($temp['address_en']))? $temp['address_en'] : set_value('address_en'), 'class="form-control"'); ?>
                    </div>
                    <hr style="margin-top:1.2rem;">
                    <div class="form-group">
                        <?php echo form_label($this->lang->line('Legal Representative'), 'connector'); ?>
                        <?php echo form_error('connector', '<div class="error">', '</div>'); ?>
                        <?php echo form_input('connector', (isset($temp) && !empty($temp['connector']))? $temp['connector'] : set_value('connector'), 'class="form-control"'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('E-Mail: ', 'email'); ?>
                        <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                        <?php echo form_input('email', (isset($temp) && !empty($temp['email']))? $temp['email'] : set_value('email'), 'class="form-control"'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label($this->lang->line('Mobile'), 'phone'); ?>
                        <?php echo form_error('phone', '<div class="error">', '</div>'); ?>
                        <?php echo form_input('phone', (isset($temp) && !empty($temp['phone']))? $temp['phone'] : set_value('phone'), 'class="form-control"'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Website: ', 'website'); ?>
                        <?php echo form_error('website', '<div class="error">', '</div>'); ?>
                        <?php echo form_input('website', (isset($temp) && !empty($temp['website']))? $temp['website'] : set_value('website'), 'class="form-control"'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label($this->lang->line("sonhanluc").': ', 'manpower'); ?>
                        <?php echo form_error('manpower', '<div class="error">', '</div>'); ?>
                        <?php echo form_input('manpower', (isset($temp) && !empty($temp['manpower']))? $temp['manpower'] : set_value('manpower'), 'class="form-control"'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label($this->lang->line('doanhthunam').' ' . (date("Y") - 1) . ' ('.$this->lang->line('ghirodonvitiente').'):' , 'revenue'); ?>
                        <?php echo form_error('revenue', '<div class="error">', '</div>'); ?>
                        <?php echo form_input('revenue', (isset($temp) && !empty($temp['revenue']))? $temp['revenue'] : set_value('revenue'), 'class="form-control"'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label($this->lang->line('Product/Solution (Vietnamese name)'), 'product'); ?>
                        <?php echo form_error('product', '<div class="error">', '</div>'); ?>
                        <?php echo form_textarea('product', (isset($temp) && !empty($temp['product']))? $temp['product'] : set_value('product'), 'class="form-control tinymce-area"'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label($this->lang->line('Product/Solution (English name)'), 'product_en'); ?>
                        <?php echo form_error('product_en', '<div class="error">', '</div>'); ?>
                        <?php echo form_textarea('product_en', (isset($temp) && !empty($temp['product_en']))? $temp['product_en'] : set_value('product_en'), 'class="form-control tinymce-area"'); ?>
                    </div>
                    <hr style="margin-top:1.2rem;">
                    <div class="form-group">
                        <?php echo form_label($this->lang->line('Field of operation (Vietnamese)'), 'profile'); ?>
                        <?php echo form_error('profile', '<div class="error">', '</div>'); ?>
                        <?php echo form_textarea('profile', (isset($temp) && !empty($temp['profile']))? $temp['profile'] : set_value('profile'), 'class="form-control tinymce-area"'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label($this->lang->line('Field of operation (English)'), 'profile_en'); ?>
                        <?php echo form_error('profile_en', '<div class="error">', '</div>'); ?>
                        <?php echo form_textarea('profile_en', (isset($temp) && !empty($temp['profile_en']))? $temp['profile_en'] : set_value('profile_en'), 'class="form-control tinymce-area"'); ?>
                    </div>
                    <hr style="margin-top:1.2rem;">
                    <div class="form-group">
                        <?php echo form_label($this->lang->line('Targeted markets (Vietnamese)'), 'market'); ?>
                        <?php echo form_error('market', '<div class="error">', '</div>'); ?>
                        <?php echo form_textarea('market', (isset($temp) && !empty($temp['market']))? $temp['market'] : set_value('market'), 'class="form-control tinymce-area"'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label($this->lang->line('Targeted markets (English)'), 'market_en'); ?>
                        <?php echo form_error('market_en', '<div class="error">', '</div>'); ?>
                        <?php echo form_textarea('market_en', (isset($temp) && !empty($temp['market_en']))? $temp['market_en'] : set_value('market_en'), 'class="form-control tinymce-area"'); ?>
                    </div>
                    
                    <div class="form-group">
                        <?php echo form_label($this->lang->line('profiledn').': ', 'file'); ?>
                        <?php if (isset($temp) && !empty($temp['file'])): ?>
                            <embed src="<?= base_url('assets/upload/profile/' . $temp['file']) ?>" width="30%" />
                        <?php endif ?>
                        <?php echo form_error('file', '<div class="error">', '</div>'); ?><br>
                        <?php echo form_upload('file', '', 'class=""'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_submit('submit', $this->lang->line('hoanthanh'), 'class="btn btn-success" style="float: right"'); ?>
                        <?php if ($this->uri->segment(3) != 'edit'): ?>
                            <?php echo form_submit('submit', $this->lang->line('luuthongtin'), 'class="btn btn-primary"'); ?>
                        <?php endif ?>
                        <!-- <a href="javascript:history.back()" name="back" class="btn btn-default btn-lg btn-block">Quay lại</a> -->
                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    switch(window.location.origin){
        case 'http://localhost':
            var HOSTNAME = 'http://localhost/matching/';
            break;
        default:
            var HOSTNAME = 'http://bmo.vinasa.org.vn/';
    }
    $(document).ready(function(){
        "use strict";

        tinymce.init({
            selector: ".tinymce-area",
            theme: "modern",
            block_formats: 'Paragraph=p;Header 1=h1;Header 2=h2;Header 3=h3',
            height: 100,
            relative_urls: false,
            remove_script_host: false,
            forced_root_block : false,
            plugins: [

            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | print preview media fullpage | forecolor backcolor emoticons",
            style_formats: [
                {title: "Bold text", inline: "b"},
                {title: "Red text", inline: "span", styles: {color: "#ff0000"}},
                {title: "Red header", block: "h1", styles: {color: "#ff0000"}},
                {title: "Example 1", inline: "span", classes: "example1"},
                {title: "Example 2", inline: "span", classes: "example2"},
                {title: "Table styles"},
                {title: "Table row 1", selector: "tr", classes: "tablerow1"}
            ],
            external_filemanager_path: HOSTNAME + "filemanager/",
            filemanager_title: "Responsive Filemanager",
            external_plugins: {"filemanager": HOSTNAME + "filemanager/plugin.min.js"}
        });
    });
</script>