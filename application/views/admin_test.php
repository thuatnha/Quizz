<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản lý Kỳ Thi</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Môn Thi
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        <?php
                        for ($j = 0; $j < count($cate); $j++) {
                            echo '<a href="' . base_url() . 'admin/test/' . $cate[$j]->subjectid . '" class="list-group-item">
                                ' . $cate[$j]->subject_name . '                            
                            </a>';
                        }
                        ?>

                    </div>
                    <?php if ($groupid == 1) { ?>
                        <a href="add_category_test" class="btn btn-success">Thêm Môn Thi</a>  
                    <?php } ?>
                </div>

            </div>

        </div>
        <div class="col-lg-9">

            <?php if (isset($test)) { ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Quản lý các kỳ thi
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <a href="<?php echo base_url(); ?>admin/create_test" class="">Thêm kỳ thi</a> | <a href="<?php echo base_url(); ?>admin/create_entry" class="">Thêm đề thi</a>
                        <?php
                        if (isset($text)) {
                            echo '<span class="pull-right red">' . $text . '</span>';
                        }
                        ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Kỳ Thi</th>
                                        <th>Môn Thi</th>
                                        <th>Thời gian làm bài</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < count($test); $i++) {
                                        $stt = $i + 1;
                                        $time = floor($test[$i]->test_time / 60);
                                        echo '<tr>
                                    <td>' . $stt . '</td>
                                    <td>' . $test[$i]->test_name . '</td>
                                    <td>' . $test[$i]->subject_name . '</td>
                                    <td>' . $time . ' phút</td>
                                    <td>
                                        <a class="btn btn-info btn-xs" href="' . base_url() . 'admin/edit_test/' . $test[$i]->testid . '">Sửa</a>
                                        <a class="btn btn-danger btn-xs" href="' . base_url() . 'admin/delete_test/' . $test[$i]->testid . '">Xóa</a>
                                        <a class="btn btn-warning btn-xs" onclick="showentry(this,' . $test[$i]->testid . ',0);">Lấy đề</a>
                                    </td>
                                </tr>';
                                    }
                                    ?>


                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
            <?php } else { ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Môn thi: <?php echo $catename[0]->subject_name; ?>
                    </div>
                    <div class="panel-body">
                        <a href="<?php echo base_url(); ?>admin/create_test" class="">Thêm kỳ thi</a> | <a href="<?php echo base_url(); ?>admin/create_entry" class="">Thêm đề thi</a>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Kỳ Thi</th>
                                        <th>Thời gian làm bài</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < count($test_cate); $i++) {
                                        $stt = $i + 1;
                                        $time = floor($test_cate[$i]->test_time / 60);
                                        echo '<tr>
                                    <td>' . $stt . '</td>
                                    <td>' . $test_cate[$i]->test_name . '</td>
                                    <td>' . $time . ' phút</td>
                                    <td>
                                        <a class="btn btn-info btn-xs" href="' . base_url() . 'admin/edit_test/' . $test_cate[$i]->testid . '">Sửa</a>
                                        <a class="btn btn-danger btn-xs" href="' . base_url() . 'admin/delete_test/' . $test_cate[$i]->testid . '">Xóa</a>
                                        <a class="btn btn-warning btn-xs" onclick="showentry(this,' . $test_cate[$i]->testid . ', ' . $catename[0]->subjectid . ');">Lấy đề</a>
                                    </td>
                                </tr>';
                                    }
                                    ?>


                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                </div>
            <?php } ?>

        </div>    
    </div>
</div>
<script type="text/javascript">
    function showentry(control, testid, subjectid) {
        var Objecttr = $(control).parent().parent();
        if ($('tr.' + testid).html() != undefined) {
            if (!$('.' + testid).is(':visible'))
                $('.' + testid).show();
            else
                $('.' + testid).hide();
        } else {
            $.ajax({
                type: "POST",
                async: true,
                cache: false,
                url: '<?php echo base_url(); ?>index.php/entry/show_entry',
                beforeSend: function () {
                    $("#loading").show();
                },
                data: {
                    testid: testid,
                    subjectid: subjectid
                },
                success: function (result) {
                    if ($.trim(result) != '') {
                        $(Objecttr).after(result);
                    }
                }
            });
        }
    }
    function add_entry_test(testid) {
        var val = '';
        $('input[name="' + testid + '"]').each(
                function () {
                    if ($(this).is(':checked'))
                        val = val + '_' + $(this).val();
                }
        );
        $.ajax({
            type: "POST",
            async: true,
            cache: false,
            url: '<?php echo base_url(); ?>index.php/entry/update_entry',
            data: {
                testid: testid,
                val: val,
            },
            success: function (result) {
                if ($.trim(result) != '' && $.trim(result) == '1') {
                   location.reload();
                }else {
                    alert('Cập nhật thất bại!');
                }
            }
        });
    }
</script>