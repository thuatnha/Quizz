<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Môn thi: <?php echo $infotest[0]->subject_name; ?></h1>
            <h5>Thời gian làm bài: <?php echo date('h:i:s', ($infotest[0]->test_time) - 3600); ?></h5>
        </div>

    </div>
    <?php if ($infotest[0]->test_type == 0) { ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php echo $infotest[0]->test_name; ?>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form role="form" action="quizz/result_quizz/question">
                                    <input type="hidden"name="user_id" value="<?php echo $userid ?>">

                                    <?php
                                    for ($i = 0; $i < count($query); $i++) {
                                        for ($j = 0; $j < count($query[$i][1]); $j++) {
                                            
                                        }
                                        echo '<div class="form-group">
                                        <label class="col-lg-12"> ' . $query[$i][0]->question_text . ' </label>';
                                        for ($j = 0; $j < count($query[$i][1]); $j++) {
                                            echo '<label class="radio-inline">
                                                <input type="radio" name="answer[' . $query[$i][0]->questionid . ']" value="' . $query[$i][0]->questionid . '_' . $query[$i][1][$j]->answerid . '" >' . $query[$i][1][$j]->answer_text . '
                                            </label>';
                                        }
                                        echo '</div><hr>';
                                    }
                                    ?>
                                    <button type="submit" class="btn btn-default">Nộp Bài</button>
                                    <button type="reset" class="btn btn-default">Bỏ kỳ thi</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    <?php } else { ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php echo $infotest[0]->test_name; ?>
                    </div>
                    <div class="panel-body">
                        <p>Kết quả</p>                                              
                        <p>Số câu trả lời đúng: <?php echo $num_result;?>/ <?php echo $num_arrayanwsers;?></p>
                        <h4>Đạt <?php echo $rerultuser;  ?> điểm</h4>
                    </div>

                </div>
            </div>
            
        </div>                
    <?php } ?>    
</div>

