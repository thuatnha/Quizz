<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Chỉnh sửa kỳ thi</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <?php if(!empty($infotest[0])){ ?>
            <?php $attributes = array('id' => 'post-form','class'=>'form-horizontal');
                echo form_open('admin/edit_test/'.$infotest[0]->testid, $attributes);
                ?>
                <input type="hidden" value="<?php echo $infotest[0]->testid; ?>" name="testid">
                <div class="row">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Tên Kỳ Thi</label>
                        <div class="col-sm-8">
                            <input type="text" value="<?php echo $infotest[0]->test_name; ?>"class="form-control" name="test_name" placeholder="Tên Kỳ Thi">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Môn Thi</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="subjectid">
                                <?php
                                for ($j = 0; $j < count($cate); $j++) {
                                    $selected = '';
                                    if($cate[$j]->subjectid == $infotest[0]->subjectid){
                                        $selected = 'selected';
                                    }
                                    
                                    echo '<option value="' . $cate[$j]->subjectid . '" '.$selected.'>' . $cate[$j]->subject_name . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-4 control-label">Giới thiệu về kỳ thi</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" value="<?php echo $infotest[0]->test_instructions; ?>" name ="test_instructions" rows="6"><?php echo $infotest[0]->test_instructions; ?></textarea>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-4 control-label">Thời gian làm bài</label>
                        <div class="col-sm-8">
                            <input type="number" value="<?php echo floor($infotest[0]->test_time / 60); ?>" class="form-control" name="test_time" placeholder="Thời gian làm bài - Phút">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Kiểu Bài Thi</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="test_type">
                                <option value="">Vui lòng chọn</option>
                                <option value="0" <?php echo ($infotest[0]->test_type == '0') ? 'selected': '';?>>Kiểu câu hỏi</option>
                                <option value="1" <?php  echo ($infotest[0]->test_type == '1') ? 'selected': ''; ?>>Lấy từ file PDF</option>
                            </select>
                        </div>
                    </div>
                    <div id="question_link" <?php ($infotest[0]->test_type == '0') ? 'style="display: none;"': ''; ?> >
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Số lượng câu hỏi</label>
                            <div class="col-sm-8">
                                <input type="text" value="<?php echo $infotest[0]->test_numanwsers; ?>" class="form-control" name="test_numanwsers" placeholder="Số lượng câu hỏi">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Link file</label>
                            <div class="col-sm-8">
                                <input type="text" value="<?php echo $infotest[0]->test_link; ?>" class="form-control" name="test_link" placeholder="Link file">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Chọn đáp án</label>
                            <div class="col-sm-8">

                            </div>
                        </div>
                        <div id="num_anwser" class="col-sm-offset-4 col-sm-8">
                           
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <button type="submit" class="btn btn-success">Cập nhật kỳ thi</button>
                        </div>
                        
                    </div>
                </div>
            </form>
            <?php } else { ?>
            <div class="row">
                <div class="form-group">
                    <label class="col-sm-12 control-label">Không có dữ liệu. Bạn vui lòng kiểm tra lại</label>
                </div>
            </div>
            <?php }?>
        </div>
        <div class="col-lg-4">
            
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function () {
        $('select[name=test_type]').change(function(){
            var selected = $('select[name=test_type] option:selected').val();
            if(selected == 0){
                $('#question_link').hide();
            }else if(selected == 1) {
                $('#question_link').show();
            }else {
                $('#question_link').hide();
            }
        });
        $('input[name=test_numanwsers]').each(function (){
            var num = $('input[name=test_numanwsers]').val();
            if ($('input[name=test_numanwsers]').val() != '') {
                insert(num);
            }
        });
        
    });
    $(function () {
        $(document).on('keydown', '#cstoolAccountName input[type="text"]', function (e) {
            var keyCode = e.keyCode || e.which;
            var num = $('input[name=test_numanwsers]').val();

            if (keyCode == 9) {
                if ($('input[name=test_numanwsers]').val() != '') {
                    insert(num);
                }
            }
        });
        $(document).on('blur', 'input[name=test_numanwsers]', function (e) {
            var num = $('input[name=test_numanwsers]').val();
            if ($('input[name=test_numanwsers]').val() != '') {
                insert(num);
            }
        });
    });
    function insert(num){
        var i;
        $('#num_anwser').html('');
        <?php 
            
                  $datajson = array(); 
                  $datajson = json_decode($infotest[0]->test_json);
                  $answer = 'var answer = [';
                  for($i=0;$i<count($datajson);$i++){
                      $answer .= '"'.$datajson[$i].'",';
                  }
                  $answer .= '];';
                  echo $answer;
        ?>
                
        for(i= 0; i< num; i++){
            var se = '';
            var se1 = '';
            var se2 = '';
            var se3 = '';
            if(answer[i]== 'a'){
                se = 'checked';
            }else if(answer[i]== 'b'){
                se1 = 'checked';
            }else if(answer[i]== 'c'){
                se2 = 'checked';
            }else if(answer[i]== 'd'){
                se3 = 'checked';
            }
            
            text = '<div class="form-group">'+
                                'Câu '+ i +' <label class="radio-inline">'+
                                    '<input type="radio" name="answer_'+ (i+1) +'"  value="a" '+ se +' > A'+
                                '</label>'+
                                '<label class="radio-inline">'+
                                    '<input type="radio" name="answer_'+ (i+1) +'" value="b" '+ se1 +'> B'+
                                '</label>'+
                                '<label class="radio-inline">'+
                                    '<input type="radio" name="answer_'+ (i+1) +'" value="c" '+ se2 +'> C'+
                                '</label>'+
                                '<label class="radio-inline">'+
                                    '<input type="radio" name="answer_'+ (i+1) +'" value="d" '+ se3 +'> D'+
                                '</label>'+
                            '</div>';
            $('#num_anwser').append(text);
        }
                    
    }
</script>
