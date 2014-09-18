<script type="text/javascript">
    $(document).ready(function() {
        var form = $('#' + 'form-login');
        form.submit(function(event) {
            $('#res').html('');

            var dulieu = form.serialize();
            $.ajax({
                beforeSend: function () {
                       $('#res').html('Loading...');             
                                },
                type: "POST",
                url: '<?php echo Yii::app()->createAbsoluteUrl('user/login'); ?>',
                data: dulieu,
                success: function(data) {
                    $('#res').html('');
                    $('#res').JSONView(data);
                    //$('#res').html(data)
                }
            });
        });
    });
</script>
<form action="javascript:void(0);" method="POST" class='form-horizontal' id="form-login">
    <div class="control-group">
        <label for="textfield" class="control-label">Tên đăng nhập</label>
        <div class="controls">
            <input type="text" name="user_email" id="textfield" class="input-xlarge">
            <span class="help-block">Dữ liệu để nhập tên đăng nhập, là email, kiểm tra tại client</span>
        </div>
    </div>
    <div class="control-group">
        <label for="password" class="control-label">Password</label>
        <div class="controls">
            <input type="password" name="user_password" id="password" placeholder="" class="input-xlarge">
            <span class="help-block">Mật khẩu, ràng buộc kiểm tra tại client</span>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Gửi</button>
    </div>
</form>

<div class="box-title">
    <h3>
        RESULT
    </h3>
    <code id="res"></code>
</div>

