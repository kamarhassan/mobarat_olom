<?php /* @var $this Controller */ ?>
<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<?php $this->beginContent('//layouts/main_empty');
?>


<div  >
	<?php echo $content; ?>
</div><!-- content -->
<?php $this->endContent(); ?>