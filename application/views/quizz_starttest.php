<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Môn thi: <?php echo $infotest[0]->subject_name; ?></h1>
            <h5>Thời gian làm bài: <span id="vtimer"><?php echo date('h:i:s', ($infotest[0]->test_time) - 3600); ?></span></h5>
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
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php echo $infotest[0]->test_name; ?>
                    </div>
                    <div class="panel-body">
                        <iframe class="documentViewer" width="100%" height="800" src="<?php echo base_url(); ?>resource/third_party/pdfjs/web/viewer.html?file=<?php echo $infojson[0]->test_link ?>"></iframe>
                    </div>

                </div>
            </div>
            <div class="col-lg-4">

                <?php $attributes = array('id' => 'post-form');
                    echo form_open('quizz/result_quizz/questionlink', $attributes);
                ?>
                <div class="panel panel-green">
                    <div class="panel-heading">
                        PHẦN TRẢ LỜI: <span id='numanswer'>0</span>/<?php echo $infojson[0]->test_numanwsers; ?>
                        <button type="submit" class="btn btn-default">Nộp Bài</button>
                    </div>
                    <div class="panel-body" style=" position: relative;height: 800px;overflow-y: scroll;overflow-x: hidden;">

                        <!--                        <form role="form" action="quizz/result_quizz/questionlink">-->
                        <input type="hidden"name="user_id" value="<?php echo $userid ?>">
                        <input type="hidden"name="test_id" value="<?php echo $infotest[0]->testid ?>">
                        <input type="hidden"name="link_id" value="<?php echo $infojson[0]->linkid ?>">
                        <input type="hidden"name="numanwsers" value="<?php echo $infojson[0]->test_numanwsers ?>">
                        <?php
                        for ($i = 1; $i <= $infojson[0]->test_numanwsers; $i++) {
                            echo '<div class="form-group" data-question-id="' . $i . '" rel="unanswered">
                                            <label style="margin-right:20px;">Câu ' . $i . '</label>
                                            <label class="radio-inline">
                                                <input type="radio" id="answer_' . $i . '_a" name="answer_' . $i . '" value="a">A
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" id="answer_' . $i . '_b" name="answer_' . $i . '" value="b">B
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" id="answer_' . $i . '_c" name="answer_' . $i . '" value="c">C
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" id="answer_' . $i . '_c" name="answer_' . $i . '" value="d">D
                                            </label>
                                        </div><hr>';
                        }
                        ?>



                    </div>
                </div>
                </form>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {

                var _tickAnswer = function (row, testId, questionId, answer) {
                    if (answer.length > 0 && row.attr('rel') == 'unanswered') {
                        var count = parseInt($('#numanswer').html()) + 1;
                        $('#numanswer').html(count);
                        row.attr('rel', 'answered');
                    }
                    var userId = $("input[name=user_id]").val();
                    //$.post("/contest/testexam/answer", {user_test_id: userId, question: questionId, answer: answerid}, function (resp) {
                    //});
                };

                $(".form-group").click(function () {
                    var questionId = $(this).attr('data-question-id');
                    var answer = $('input[name=answer_' + questionId + ']').val();
                    var testId = $('input[name=test_id]').val();
                    _tickAnswer($(this), testId, questionId, answer);
                });
            });
        </script>
        <script>
            var dStopTime = new Date();
            dStopTime.setHours(
                    dStopTime.getHours() <?php if($infotest[0]->test_time >= 3600){ echo '+'. floor($infotest[0]->test_time/3600);} ?>, 
                    dStopTime.getMinutes() <?php if($infotest[0]->test_time > 3600){echo '+'. floor(($infotest[0]->test_time % 3600)/60);}else {
                        echo '+'. floor($infotest[0]->test_time/60);
                    } ?>, 
                    dStopTime.getSeconds());
            var clockID = 0;
            function UpdateClock() {
                if (clockID) {
                    clearTimeout(clockID);
                    clockID = 0;
                }
                var dNow = new Date();
                if (dNow < dStopTime) {
                    dNow.setHours(dStopTime.getHours() - dNow.getHours(), dStopTime.getMinutes() - dNow.getMinutes(), dStopTime.getSeconds() - dNow.getSeconds());
                    strContent = "&nbsp;<b>" + setLeadingZero(dNow.getHours()) + ":" + setLeadingZero(dNow.getMinutes()) + ":" + setLeadingZero(dNow.getSeconds()) + "</b>&nbsp;";
                    if (dNow.getMinutes() < 1)
                        strContent = "<font color=#ff0000>" + strContent + "</font>";
                    document.getElementById("vtimer").innerHTML = strContent;
                    clockID = setTimeout("UpdateClock()", 500);
                } else {
                    clearTimeout(clockID);
                    clockID = 0;
                    document.getElementById("vtimer").innerHTML = "<b>00:00:00</b>";
                    $('form').submit();

                }
            }
            function setLeadingZero(i) {
                return (i < 10) ? "0" + i : i;
            }
            clockID = setTimeout("UpdateClock()", 500);
        </script>
<?php } ?>    
</div>

