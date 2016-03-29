<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Đề thi môn: <?php echo $catename[0]->subject_name;?></h1>
        </div>
    </div>
    <div class="row">
            <div class="col-lg-8">

                <!-- /.panel -->

                <!-- /.panel -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-clock-o fa-fw"></i> Kỳ thi đang diễn ra
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <ul class="listtest">
                            <?php                            
                            for ($i = 0; $i < count($query); $i++) {
                                echo '<li>
                                <div class="media">                                    
                                    <div class="media-body">
                                        <h4 class="media-heading"><a href="'.  base_url().'quizz/intro/'.$query[$i]->testid.'">'.$query[$i]->test_name.'</a></h4>
                                        '. $query[$i]->test_instructions .'
                                       
                                    </div>
                                </div>
                            </li>';
                            }
                            ?> 
                        </ul>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-8 -->
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bell fa-fw"></i> Học sinh điểm số cao
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item">
                                <i class="fa fa-user fa-fw"></i> Lý Hoàng Ngọc Hiếu
                                <span class="pull-right text-muted small"><em>10 điểm</em>
                                </span>
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="fa fa-user fa-fw"></i> Lý Hoàng Ngọc Hiếu
                                <span class="pull-right text-muted small"><em>10 điểm</em>
                                </span>
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="fa fa-user fa-fw"></i> Lý Hoàng Ngọc Hiếu
                                <span class="pull-right text-muted small"><em>10 điểm</em>
                                </span>
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="fa fa-user fa-fw"></i> Lý Hoàng Ngọc Hiếu
                                <span class="pull-right text-muted small"><em>10 điểm</em>
                                </span>
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="fa fa-user fa-fw"></i> Lý Hoàng Ngọc Hiếu
                                <span class="pull-right text-muted small"><em>10 điểm</em>
                                </span>
                            </a>

                        </div>
                        <!-- /.list-group -->

                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->

                <!-- /.panel -->

                <!-- /.panel .chat-panel -->
            </div>
            <!-- /.col-lg-4 -->
        </div>
</div>