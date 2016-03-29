<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản lý Thành Viên</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Danh sách lớp
                </div>
                <div class="panel-body">
                    <h5> Chức năng này đang cập nhật</h5>
                    
                    <?php if ($groupid <= 2) { ?>
                        <a href="add_category_test" class="btn btn-success">Thêm Lớp</a>
                    <?php } ?>
                </div>

            </div>

        </div>
        <div class="col-lg-9">
            
            <?php if (isset($test)) { ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Danh sách thành viên
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">                       
                        <?php if(isset($text)){
                            echo '<span class="pull-right red">'.$text.'</span>';
                        } ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Họ tên</th>
                                        <th>Tên đăng nhập</th>
                                        <th>Email</th>
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
                                        <a class="btn btn-info" href="' . base_url() . 'admin/edit_user/'. $test[$i]->testid .'">Sửa</a>
                                        <a class="btn btn-danger" href="' . base_url() . 'admin/delete_user/'. $test[$i]->testid .'">Xóa</a>
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
                        <a href="create_test" class="">Thêm kỳ thi</a>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
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
                                        <a class="btn btn-info" href="edit_test/'. $test_cate[$i]->testid .'">Sửa</a>
                                        <a class="btn btn-danger" href="delete_test/'. $test_cate[$i]->testid .'">Xóa</a>
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