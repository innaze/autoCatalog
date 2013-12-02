<?php
/* @var $this AutoController */
/* @var $model Auto */

$this->breadcrumbs=array(
	'Автомобили'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список автомобилей', 'url'=>array('index')),
);
?>

<h1>Создать автомобиль</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>