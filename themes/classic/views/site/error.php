<div class="code"><span><?php echo $error['code'];?></span><i class="icon-warning-sign"></i></div>
<div class="desc"><?php echo $error['message'];?></div>
<form action="more-searchresults.html" class='form-horizontal'>
	<div class="input-append">
		<input type="text" name="search" placeholder="Search a site..">
		<button type='submit' class='btn'><i class="icon-search"></i></button>
	</div>
</form>
<div class="buttons">
	<div class="pull-left"><a href="<?php echo Yii::app()->createUrl('');?>" class="btn"><i class="icon-arrow-left"></i> Back</a></div>
</div>