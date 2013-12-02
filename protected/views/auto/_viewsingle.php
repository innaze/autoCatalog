<?php
/* @var $this AutoController */
/* @var $data Auto */
?>

<div class="view">
	<b><?php echo CHtml::link(CHtml::encode($data->name), $data->url); ?></b>
	<br />

	<div class="bigimg">
	  <?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/'.$data->id.'.jpg','авто'); ?>
	</div>

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_body')); ?>:</b>
	<?php echo CHtml::encode($data->nameBody->name); ?>
	<br />
	<b><?php echo CHtml::encode('Цвета'); ?>:</b>
	<?php    
	    foreach($data->colors as $_color) {
	      echo CHtml::encode($_color->name . ", ");
	      }
	?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode(ltrim($data->price,'0') . ' руб.'); ?>
	<br />


</div>