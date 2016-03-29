<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Môn thi: <?php echo $infotest[0]->subject_name; ?></h1>
            
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php echo $infotest[0]->test_name; ?>
                </div>
                <div class="panel-body">
                        <h5>Thời gian làm bài: <?php echo date('h:i:s', ($infotest[0]->test_time)); ?> phút</h5>
                        <p><?php echo $infotest[0]->test_instructions?></p>
                        
                </div>
                <div class="panel-footer">
                    <a class="btn btn-success" href="<?php echo base_url().'quizz/start_quizz/'.$infotest[0]->testid; ?>">Bắt đầu làm bài</a>
                </div>
            </div>
        </div>

    </div>

</div>

