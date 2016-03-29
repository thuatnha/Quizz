<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Đăng nhập</h3>
                    </div>
                    <?php echo validation_errors(); ?>
                    
                    <div class="panel-body">
                        <?php echo form_open('verifylogin'); ?>
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Tên tài khoản" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Mật khẩu" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Ghi nhớ
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-success btn-block">Đăng nhập</button>
                                <a href="<?php echo base_url();?>user/register">Đăng ký thành viên</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>