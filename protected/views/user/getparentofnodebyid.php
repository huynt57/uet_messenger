<script type="text/javascript">
    $(document).ready(function() {
        var form = $('#' + 'form-login');
        form.submit(function(event) {
            $('#res').html('');

            var dulieu = form.serialize();
            $.ajax({
                beforeSend: function() {
                    $('#res').html('Loading...');
                },
                type: "POST",
                url: '<?php echo Yii::app()->createAbsoluteUrl('index.php/user/getparentofnodebyid')?>',
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
        <label for="textfield" class="control-label">Tên Node</label>
        <div class="controls">
            <input type="text" name="node" id="textfield" class="input-xlarge">
           
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
