<?php
/* @var $this AutoController */
/* @var $model Auto */

$this->breadcrumbs=array(
	'Автомобили'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Изменить',
);

$this->menu=array(
	array('label'=>'Список автомобилей', 'url'=>array('index')),
	array('label'=>'Создать автомобиль', 'url'=>array('create')),
	array('label'=>'Просмотр автомобиля', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Изменяем автомобиль <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>