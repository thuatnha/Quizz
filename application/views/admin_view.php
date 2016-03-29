<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản trị</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    Danh sách kỳ thi
                </div>
                <div class="panel-body">
                    <p></p>
                </div>
                <div class="panel-footer">
                    Footer
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Danh sách Môn Thi
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
                </div>
                <div class="panel-footer">
                    Footer
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Kết quả thi
                </div>
                <div class="panel-body">
                    <p></p>
                </div>
                <div class="panel-footer">
                    Footer
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    Danh sách thành viên
                </div>
                <div class="panel-body">
                    <?php
                    
                    for ($i=0;$i<count($user);$i++){
                        echo '<p>Tài khoản:<label class="text-info">'.$user[$i]->user_name.'</label> | Họ và tên:<label class="text-info">'.$user[$i]->user_title.'</label></p><hr>';
                    }                    
                    
                    ?>
                </div>
                <div class="panel-footer">
                    Footer
                </div>
            </div>
        </div>
    </div>
</div>