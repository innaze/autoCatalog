<?php
/* @var $this AutoController */
/* @var $model Auto */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerCoreScript('jquery'); 
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'auto-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data',),)); ?>

	<p class="note">Поля, отмеченные <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_body'); ?>
		<?php echo $form->dropDownList($model,'id_body',Body::items()); ?>
		<?php echo $form->error($model,'id_body'); ?>
	</div>

	  <h2>Цвета модели:</h2>
	    
	      <table>
		<thead>
		  <tr><td>
		  <?php echo CHtml::link('Добавить цвет', '', array('onClick' => 'addColor($(this))')); ?>
		  </td></tr>
		</thead>  
	      <tbody>
               <?php
                  foreach ($model->colors as $id => $color) {
                  $this->renderPartial('rowColor', array('id' => $id, 'model' => $color, 'form' => $form, 'this' => $this), false, true);
                  }
               ?>
              </tbody>
	      </table>
		
		<?php //echo var_dump($model->relations()["colors"]);
		// echo $form->dropDownList($model, 'colors', CHtml::listData(Colors::model()->findAll(), 
		//'id', 'name'), array('multiple'=>'multiple', 'size'=>'7', 'encode'=>true)); ?>
		<?php //echo $form->error($model,'colors'); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php // echo $form->textField($model,'price',array('size'=>10,'maxlength'=>11)); ?>
		<?php echo $form->textField($model, 'price',array('size'=>10,'maxlength'=>11,'value'=>ltrim($model->price,'0'))); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model, 'image'); ?>
		<?php if (!$model->isNewRecord) echo 'Загрузите новую картинку, если хотите заменить ее.'; ?>
                <?php echo $form->fileField($model, 'image') .
                " <b>Пожалуйста в формате jpg</b>"; ?>
                <?php echo $form->error($model, 'image'); ?>
        </div>

	<div class="row buttons">
		<?php $this->renderPartial('colorJs', array( 'form' => $form, 'this' => $this),false,true); ?>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->