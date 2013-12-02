<?php

/**
 * This is the model class for table "auto".
 *
 * The followings are the available columns in table 'auto':
 * @property string $id
 * @property string $id_body
 * @property string $description
 * @property string $price
 *
 * The followings are the available model relations:
 * @property Body $idBody
 * @property Autocolor[] $autocolors
 */
class Auto extends CActiveRecord
{

	public $image;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'auto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		
		return array(
			array('name,id_body,price','required'),
			array('price', 'length', 'max'=>11),
			array('price', 'match', 'pattern'=>'/^[1-9][0-9]*\.?[0-9][0-9]$/', 'message'=>'То, что Вы ввели не похоже на цену в рублях :)'),
			array('name','length','max'=>200),
			array('description', 'safe'),
			array('image', 'file', 'types' => 'jpg,jpeg,JPG,JPEG','allowEmpty'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('name,price', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'nameBody' => array(self::BELONGS_TO, 'Body', 'id_body'),
			'colors' => array(self::MANY_MANY, 'Colors', 'autocolor(id_auto,id_color)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
		//	'id' => 'ID',
			'name' => 'Название',
			'id_body' => 'Тип кузова',
			'description' => 'Описание',
			'price' => 'Цена',
			'image' => 'Большая картинка'
		);
	}

	public function getUrl()
	{
		return Yii::app()->createUrl('auto/view', array(
			'id'=>$this->id,
			'name'=>$this->name,
		));
	}
	
	/** 
	* урезать описание для главной страницы
	*/
	public function cutDescr()
	{
	  if(Yii::app()->params['cutDescr'])
		  return mb_substr($this->description,0,Yii::app()->params['cutDescr'],'utf-8');
		else
		  return mb_substr($this->description, 0,75,'utf-8');
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		
		$criteria->compare('name',$this->name,true);
		$criteria->compare('id_body',$this->id_body,true);
		$criteria->compare('price',$this->price,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Auto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	

	public function behaviors() {
        return array('EAdvancedArBehavior' => array(
                'class' => 'application.extensions.EAdvancedArBehavior'));
	}

	
	
	public function validate($attributes = null, $clearErrors = true) {
        $isValid = parent::validate($attributes, $clearErrors);
        if ($attributes == null) {
            foreach ($this->colors as $_color) {
                if ($_color->validate() == false) {
                    $isValid = false;
                    $this->addErrors($_color->getErrors());
		    }
		}
	    }
        return $isValid;
	}
	
    /**
     * Overide save to save associated records
     */
	public function save($runValidation = true, $attributes = null) {
	  if ($runValidation) {
            if ($this->validate($attributes) == false)
                return false;
	    }
	    foreach ($this->colors as $_color) {
	      $_color->save(false);
	      }
	    return parent::save(false, $attributes);
	    }
	
}
