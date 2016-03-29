<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Đăng ký thành viên</h3>
                </div>
                <?php echo validation_errors(); ?>                    
                <div class="panel-body">
                    <?php echo form_open('user/register'); ?>
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="Tên tài khoản" name="username" type="text" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Mật khẩu" name="password" type="password" value="">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Email" name="email" type="text" value="">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Họ và tên" name="fullname" type="text" value="">
                        </div>
                        <div class="form-group">

                            <select class="form-control" name="class">
                                <option value="">Vui lòng chọn lớp học</option>
                                <?php
                                for ($j = 0; $j < count($class); $j++) {
                                    echo '<option value="' . $class[$j]->classid . '" ' . $selected . '>' . $class[$j]->class_name . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-lg btn-success btn-block">Đăng ký thành viên</button>

                    </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function validEmail(email) {
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return (filter.test(email));
    }
</script>