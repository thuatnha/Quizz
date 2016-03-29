    <!-- Navigation -->
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Đề Thi Mới</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <?php
            $ico = '';
            //var_dump($query);die;
            for ($i = 0; $i < count($query); $i++) {
                if ($i == 0) {
                    $ico = '<i class="fa fa-puzzle-piece fa-5x"></i>';
                    $bg = 'panel-primary';
                } else if ($i == 1) {
                    $ico = '<i class="fa fa-tasks fa-5x"></i>';
                    $bg = 'panel-green';
                } else if ($i == 2) {
                    $ico = '<i class="fa fa-university fa-5x"></i>';
                    $bg = 'panel-yellow';
                } else {
                    $ico = '<i class="fa fa-support fa-5x"></i>';
                    $bg = 'panel-red';
                }
                echo '<div class="col-lg-3 col-md-6">
                    <div class="panel ' . $bg . '">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">' .
                $ico
                . '
                                </div>
                                <div class="col-xs-9 text-right">' .
                $query[$i]->test_name . '<br>' .
                $query[$i]->subject_name
                . '</div>
                            </div>
                        </div>
                        <a href="'.  base_url().'quizz/intro/'.$query[$i]->testid.'">
                            <div class="panel-footer">
                                <span class="pull-left">Làm bài</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>';
            }
            ?>            
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-7">

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
                            for ($i = 0; $i < count($listtest); $i++) {
                                echo '<li>
                                <div class="media">                                    
                                    <div class="media-body">
                                        <h4 class="media-heading"><a href="'.  base_url().'quizz/intro/'.$listtest[$i]->testid.'">'.$listtest[$i]->test_name.'</a></h4>
                                        '. $listtest[$i]->test_instructions .'
                                        <h5 class="catename">Môn thi:  <a href="'.  base_url().'quizz/show_quizz/'.$listtest[$i]->subjectid.'">'.$listtest[$i]->subject_name.'</a></h5>
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
            <div class="col-lg-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bell fa-fw"></i>10 Học sinh điểm số cao
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="list-group">
                            <?php
                            if(!empty($topresult)){
                                for ($i=0;$i<count($topresult);$i++){
                                    echo '<a href="#" class="list-group-item">
                                <i class="fa fa-user fa-fw"></i> '.$topresult[$i]->user_title.' <br> Bài thi: '.$topresult[$i]->test_name.'
                                <span class="pull-right text-muted small">Đạt <em>'.$topresult[$i]->result_points.' điểm</em>
                                </span>
                            </a>';
                                }
                            }
                            
                            ?>
                            

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
        <!-- /.row -->
    </div>
