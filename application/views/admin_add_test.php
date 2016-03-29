<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm kỳ thi</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <?php $attributes = array('id' => 'post-form','class'=>'form-horizontal');
                echo form_open('admin/create_test', $attributes);
                ?>
                <div class="row">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Tên Kỳ Thi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="test_name" placeholder="Tên Kỳ Thi">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Môn Thi</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="subjectid">
                                <?php
                                for ($j = 0; $j < count($cate); $j++) {
                                    echo '<option value="' . $cate[$j]->subjectid . '">' . $cate[$j]->subject_name . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-4 control-label">Giới thiệu về kỳ thi</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name ="test_instructions" rows="6"></textarea>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-4 control-label">Thời gian làm bài</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="test_time" placeholder="Thời gian làm bài - Phút">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Kiểu Bài Thi</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="test_type">
                                <option value="">Vui lòng chọn</option>
                                <option value="0">Kiểu câu hỏi</option>
                                <option value="1">Lấy từ file PDF</option>
                            </select>
                        </div>
                    </div>
                    <!--<div id="question_link" style="display: none;">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Số lượng câu hỏi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="test_numanwsers" placeholder="Số lượng câu hỏi">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Link file</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="test_link" placeholder="Link file">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Chọn đáp án</label>
                            <div class="col-sm-8">

                            </div>
                        </div>
                        <div id="num_anwser" class="col-sm-offset-4 col-sm-8">
                           
                        </div>
                    </div>-->
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <button type="submit" class="btn btn-success">Tạo</button>
                        </div>
                        
                    </div>
                </div>
            </form>
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
        for(i=1; i<= num; i++){
            text = '<div class="form-group">'+
                                'Câu '+ i +' <label class="radio-inline">'+
                                    '<input type="radio" name="answer_'+ i +'"  value="a"> A'+
                                '</label>'+
                                '<label class="radio-inline">'+
                                    '<input type="radio" name="answer_'+ i +'" value="b"> B'+
                                '</label>'+
                                '<label class="radio-inline">'+
                                    '<input type="radio" name="answer_'+ i +'" value="c"> C'+
                                '</label>'+
                                '<label class="radio-inline">'+
                                    '<input type="radio" name="answer_'+ i +'" value="d"> D'+
                                '</label>'+
                            '</div>';
            $('#num_anwser').append(text);
        }
                    
    }
</script>
