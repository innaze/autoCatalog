<?php
/* @var $this AutoController */
/* @var $model Auto */

$this->breadcrumbs=array(
	'Автомобили'=>array('index'),
	$model->name,
);

$this->pageTitle=$model->name;

$this->menu=array(
	array('label'=>'Список автомобилей', 'url'=>array('index')),
	array('label'=>'Добавить новый автомобиль', 'url'=>array('create')),
	array('label'=>'Изменить автомобиль', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить автомобиль', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены, что хотите вот так сразу удалить этот автомобиль?')),
);
?>

<h1>Просмотр автомобиля <?php echo $model->name; ?></h1>

<?php 

$this->renderPartial('_viewsingle', array('data'=>$model,)); 

?>
