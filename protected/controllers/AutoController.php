<?php

class AutoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','create','update','delete'),
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
	  $model = $this->loadModel($id);
	  $colorsDataProvider = new CActiveDataProvider('Colors', array(
            'criteria' => array(
            'with' => array('autos'),
                'together' => true,
                'condition' => 'id_auto=:id',
                'params' => array(':id' => $model->id),
                ),
	    ));
        $this->render('view', array(
            'model' => $model,
            'colorsDataProvider' => $colorsDataProvider
	    ));
	  }
	

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
	
		$model=new Auto;

		if(isset($_POST['Auto']))
		{
			$model->attributes=$_POST['Auto'];
			if (isset($_POST['Colors'])) {
			  //var_dump($_POST['Colors']);
			  //return;
			  $model->colors = AutoController::assignColors($model, $_POST['Colors']);
			  }
			$load_img=CUploadedFile::getInstance($model,'image');

			if($model->save()) {
      			  if($load_img) {
			      $fileName = $load_img->getName();
			      $load_img->saveAs(Yii::getPathOfAlias('webroot').'/tmp/'.$fileName);
			      Yii::app()->thumb->setThumbsDirectory('/images');                
			      Yii::app()->thumb->load(Yii::getPathOfAlias('webroot').'/tmp/'.$fileName)->resize(600,296)->save($model->id . '.jpg');
			      Yii::app()->thumb->setThumbsDirectory('/images/thumbs');                
			      Yii::app()->thumb->load(Yii::getPathOfAlias('webroot').'/tmp/'.$fileName)->resize(100,49)->save('th' . $model->id . '.jpg');
			      $model->image=Yii::getPathOfAlias('webroot.images'). '/' .$model->id .'.jpg';
			      }
			  $this->redirect(array('view','id'=>$model->id));
			  }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['Auto']))
		{               
			$model->attributes=$_POST['Auto'];
			//echo var_dump($_POST);
			//return;
			if (isset($_POST['Colors'])) {
			  $model->colors = AutoController::assignColors($model, $_POST['Colors']);
			  }
			//echo var_dump($model->colors);
			//return;
			$load_img=CUploadedFile::getInstance($model,'image');
	
			if($model->save()) {
			  if ($load_img) {
			    $fileName = $load_img->getName();
			    $load_img->saveAs(Yii::getPathOfAlias('webroot').'/tmp/'.$fileName);  
			    Yii::app()->thumb->setThumbsDirectory('/images');                
			    Yii::app()->thumb->load(Yii::getPathOfAlias('webroot').'/tmp/'.$fileName)->resize(600,296)->save($model->id . '.jpg');
			    Yii::app()->thumb->setThumbsDirectory('/images/thumbs');                
			    Yii::app()->thumb->load(Yii::getPathOfAlias('webroot').'/tmp/'.$fileName)->resize(100,49)->save('th' . $model->id . '.jpg');
			    $model->image=Yii::getPathOfAlias('webroot.images'). '/' .$model->id .'.jpg';
			    }  
			    
			  $this->redirect(array('view','id'=>$model->id));
			  }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Auto', array(
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['autosPerPage'],
			),));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Auto the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Auto::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Auto $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='auto-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	public static function assignColors($model, $items_posted) {
        $colors = array();
        foreach ($items_posted as $item_post) {
            $color = null;
            if (!empty($item_post['id'])) {
                $color = AutoController::findColor($model, $item_post['id']);
		}
            if (is_null($color)) {
                $color = new Colors();
		}
            unset($item_post['id']); // Remove primary key
            $color->attributes = $item_post;
            array_push($colors, $color);
	    }
        return $colors;
	}

	public static function findColor($model, $id) {
        $color = null;
        foreach ($model->colors as $cl) {
            if ($cl->id == $id) {
                $color = $cl;
		}
	    }
        return $color;
	}
	
}
