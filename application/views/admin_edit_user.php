<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản trị thành viên</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <?php if (!empty($userinfo[0])) { ?>
            <?php $attributes = array('id' => 'post-form','class'=>'form-horizontal');
                echo form_open('admin/edit_user/'.$userinfo[0]->userid, $attributes);
                ?>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Phân quyền thành viên</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="groupid">
                            <option value="4">Học sinh</option>
                            <option value="1">Quản trị site</option>
                            <option value="2">Giáo viên</option>
                            
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Họ tên:</label>
                    <div class="col-sm-8">
                        <input type="text" value="<?php echo $userinfo[0]->user_title; ?>" class="form-control" name="user_title">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Email:</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" value="<?php echo $userinfo[0]->user_email; ?>" name="user_email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label class="col-sm-4 control-label"></label>
                        <label class="col-sm-8">
                        <input type="checkbox" name="user_enabled" value="1" <?php if($userinfo[0]->user_enabled == 1){ echo 'checked';}?>> Kích hoạt
                        </label>
                    </div>
                    
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" value="submit" class="btn btn-success">Cập nhật</button>
                    </div>                        
                </div>
                </form>
            <?php } else { ?>
                <div class="row">
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Không có dữ liệu. Bạn vui lòng kiểm tra lại</label>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
