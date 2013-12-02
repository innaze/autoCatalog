<?php
/* @var $this AutoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Все автомобили',
);

$this->menu=array(
	array('label'=>'Создать новый автомобиль', 'url'=>array('create')),
);
?>

<h1>Все автомобили</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
