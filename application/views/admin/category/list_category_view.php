<style>
    .show-catalogues-1{
        opacity: 0;
        height: 0px;
        width: 0px;
    }
</style>
<div class="container-fluid" id="category">
    <a href="<?php echo base_url('admin/event/index'); ?>" class="btn btn-outline-dark"><i class="fa fa-backward" aria-hidden="true"></i></a>
    <a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#createRoot" style="color: white"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tạo danh mục gốc</a>
    <br>
    <br>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?php echo strtoupper($event['name']); ?> / Danh mục</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 5%">STT</th>
                            <th style="text-align: center">Tên danh mục</th>
                            <th style="text-align: center">Tên danh mục tiếng Anh</th>
                            <th style="text-align: center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($categories){ ?>
                            <?php foreach($categories as $key => $item){ ?>
                                <tr>
                                    <td style="text-align: center"><?php echo $key + 1; ?></td>
                                    <td><?php echo $item['name']; ?></td>
                                    <td><?php echo $item['name_en']; ?></td>
                                    <td style="text-align: center">
                                        <?php if($item['level'] == 0){ ?>
                                            <a title="Cập nhật" href="javascript:void(0);" class="sub-category" data-id="<?php echo $item['id']; ?>" data-name="<?php echo $item['name']; ?>" data-require="<?php echo $item['require']; ?>" data-name_en="<?php echo $item['name_en']; ?>" data-toggle="modal" data-target="#editCategory" style="color: white">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            &nbsp;
                                            <a title="Tạo danh mục con" href="javascript:void(0);" class="sub-category" data-parent="<?php echo $item['id']; ?>" data-toggle="modal" data-target="#createSub" style="color: white">
                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                            </a>
                                            &nbsp;
                                            <a href="javascript:void(0);" title="Xóa danh mục" class="btn-delete-category" data-id="<?= $item['id']; ?>"><i class="fas fa-trash-alt"></i></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php foreach($item['sub'] as $keySub => $itemSub){ ?>
                                    <tr class="sub-item">
                                        <td>&#8627; <?php echo $keySub + 1; ?></td>
                                        <td><?php echo $itemSub['name']; ?></td>
                                        <td><?php echo $itemSub['name_en']; ?></td>
                                        <td style="text-align: center">
                                            <a title="Cập nhật" href="javascript:void(0);" class="sub-category" data-id="<?php echo $itemSub['id']; ?>" data-name="<?php echo $itemSub['name']; ?>" data-name_en="<?php echo $itemSub['name_en']; ?>" data-toggle="modal" data-target="#editCategory" style="color: white">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            &nbsp;
                                            <a title="Tạo danh mục con" href="javascript:void(0);" class="sub-category" data-parent="<?php echo $itemSub['id']; ?>" data-toggle="modal" data-target="#createSub" style="color: white">
                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                            </a>
                                            &nbsp;
                                            <a href="javascript:void(0);" title="Xóa danh mục" class="btn-delete-category" data-id="<?= $itemSub['id']; ?>"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    <?php foreach ($itemSub['sub'] as $k => $child): ?>
                                        <tr class="child-item" style="background: #ffffff; color: #66667a">
                                            <td>&#8627; <?php echo $k + 1; ?></td>
                                            <td><?php echo $child['name']; ?></td>
                                            <td><?php echo $child['name_en']; ?></td>
                                            <td style="text-align: center">
                                                <a title="Cập nhật" href="javascript:void(0);" class="sub-category" data-id="<?php echo $child['id']; ?>" data-name="<?php echo $child['name']; ?>" data-name_en="<?php echo $child['name_en']; ?>" data-toggle="modal" data-target="#editCategory" style="color: white">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true" style="color: #66667a !important"></i>
                                                </a>
                                                &nbsp;
                                                <a href="javascript:void(0);" title="Xóa danh mục" class="btn-delete-category" data-id="<?= $child['id']; ?>"><i class="fas fa-trash-alt" style="color: #66667a !important"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php } ?>
                            <?php } ?>
                        <?php }else{ ?>
                            <div class="post">Chưa có danh mục!</div>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<div id="createRoot" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                Tạo danh mục gốc
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="parent_id" id="rootParent" value="0" />
                <input type="hidden" name="level" id="rootLevel" value="0" />
                <input type="hidden" name="event_id" id="rootEvent" value="<?php echo $event_id; ?>" />
                Tên danh mục: <input type="text" name="name" id="rootName" class="form-control" />
                Tên danh mục (tiếng Anh): <input type="text" name="name_en" id="rootNameEn" class="form-control" />
                Bắt buộc chọn:  <select name="require" class="form-control" id="rootRequire">
                                    <option value="0" selected>Không bắt buộc</option>
                                    <option value="1">Bắt buộc</option>
                                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary create-root-category" data-dismiss="modal">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<div id="createSub" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                Tạo danh mục con
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="parent_id" id="subParent" value="0" />
                <input type="hidden" name="level" id="subLevel" value="1" />
                <input type="hidden" name="event_id" id="subEvent" value="<?php echo $event_id; ?>" />
                Tên danh mục: <input type="text" name="name" id="subName" class="form-control" />
                Tên danh mục (tiếng Anh): <input type="text" name="name_en" id="subNameEn" class="form-control" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary create-sub-category" data-dismiss="modal">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<div id="editCategory" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                Cập nhật danh mục
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="idUpdate" id="idUpdate" value="0" />
                Tên danh mục: <input type="text" name="nameUpdate" id="nameUpdate" class="form-control" />
                Tên danh mục (tiếng Anh): <input type="text" name="nameUpdateEn" id="nameUpdateEn" class="form-control" />
                <div class="show-catalogues-1">
                    Bắt buộc chọn:  <select name="require" id="requireUpdate" class="form-control">
                                        <option value="0" selected >Không bắt buộc</option>
                                        <option value="1">Bắt buộc</option>
                                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary update-category" data-dismiss="modal">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- /.container-fluid -->
<script>
    $('.create-root-category').click(function(){
        var name = $('#rootName').val();
        var name_en = $('#rootNameEn').val();
        var parent = $('#rootParent').val();
        var requires = $('#rootRequire').val();
        var level = $('#rootLevel').val();
        var event = $('#rootEvent').val();

        $.ajax({
            method: 'GET',
            url: '<?php echo base_url('admin/category/create') ?>',
            data: {
                name: name,
                name_en: name_en,
                parent: parent,
                require: requires,
                level: level,
                event: event,
            },
            success: function(res){
                var result = JSON.parse(res);
                if(result.message == 1){
                    alert('OK');
                    window.location.reload();
                }else{
                    alert('Không tạo được danh mục mới');
                    window.location.reload();
                }
            }
        });
    });

    $('.create-sub-category').click(function(){
        var name = $('#subName').val();
        var name_en = $('#subNameEn').val();
        var parent = $('#subParent').val();
        var level = $('#subLevel').val();
        var event = $('#subEvent').val();

        $.ajax({
           method: 'GET',
           url: '<?php echo base_url('admin/category/create') ?>',
           data: {
               name: name,
               name_en: name_en,
               parent: parent,
               level: level,
               event: event,
           },
           success: function(res){
               var result = JSON.parse(res);
               if(result.message == 1){
                   alert('OK');
                   window.location.reload();
               }else{
                   alert('Không tạo được danh mục mới');
                   window.location.reload();
               }
           }
        });
    });

    $('.update-category').click(function(){
        var id = $('#idUpdate').val();
        var name = $('#nameUpdate').val();
        var name_en = $('#nameUpdateEn').val();
        var requires = $('#requireUpdate').val();

        $.ajax({
            method: 'GET',
            url: '<?php echo base_url('admin/category/edit') ?>',
            data: {
                id: id,
                name: name,
                name_en: name_en,
                require: requires,
            },
            success: function(res){
                var result = JSON.parse(res);
                if(result.message == 1){
                    alert('OK');
                    window.location.reload();
                }else{
                    alert('Không cập nhật được danh mục');
                    window.location.reload();
                }
            }
        });
    });

    $('#createSub').on('shown.bs.modal', function(event) {
        var parent = $(event.relatedTarget).data('parent');
        $(this).find('input[name="parent_id"]').val(parent);
    });

    $('#editCategory').on('shown.bs.modal', function(event) {
        var id = $(event.relatedTarget).data('id');
        var name = $(event.relatedTarget).data('name');
        var name_en = $(event.relatedTarget).data('name_en');
        var requires = $(event.relatedTarget).data('require');
        $(this).find('input[name="idUpdate"]').val(id);
        $(this).find('input[name="nameUpdate"]').val(name);
        $(this).find('input[name="nameUpdateEn"]').val(name_en);
        $(this).find('[name="require"]').val(requires);
        if ($('.sub-category[data-id="'+id+'"]').parents('tr').attr('class') == undefined) {
            $('.show-catalogues-1').attr('style','opacity:1;height:auto;width:100%;')
        }else{
            $('.show-catalogues-1').attr('style','');
        }
    });

    $('.btn-delete-category').click(function(){
        id = $(this).data('id');
        if (confirm('Chăc chắn xóa danh mục này? Lưu ý: Khi thực hiện xóa danh mục nếu có danh mục con sẽ xóa cả danh mục con!')) {
            $.ajax({
                method: 'GET',
                url: '<?php echo base_url('admin/category/delete_category') ?>',
                data: {
                    id: id,
                },
                success: function(res){
                    var result = JSON.parse(res);
                    if (result.status == true) {
                        window.location.reload();
                    }else{
                        alert('Xảy ra lỗi trong quá trình xóa danh mục');
                        window.location.reload();
                    }
                }
            });
        }
    });
</script>