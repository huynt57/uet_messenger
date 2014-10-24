<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $user_id
 * @property string $user_email
 * @property string $user_password
 * @property string $user_token
 * @property integer $user_active
 * @property string $user_phone
 * @property string $user_dob
 * @property string $user_gender
 * @property string $user_course
 * @property string $user_study_field
 * @property string $user_forte
 * @property string $user_archivement
 * @property string $user_facebook
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 * @property integer $root
 * @property string $user_name
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_active, lft, rgt, level, root', 'numerical', 'integerOnly'=>true),
			array('user_email, user_password, user_token, user_phone, user_dob, user_gender, user_facebook, user_name', 'length', 'max'=>100),
			array('user_course, user_study_field', 'length', 'max'=>300),
			array('user_forte, user_archivement', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, user_email, user_password, user_token, user_active, user_phone, user_dob, user_gender, user_course, user_study_field, user_forte, user_archivement, user_facebook, lft, rgt, level, root, user_name', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'user_email' => 'User Email',
			'user_password' => 'User Password',
			'user_token' => 'User Token',
			'user_active' => 'User Active',
			'user_phone' => 'User Phone',
			'user_dob' => 'User Dob',
			'user_gender' => 'User Gender',
			'user_course' => 'User Course',
			'user_study_field' => 'User Study Field',
			'user_forte' => 'User Forte',
			'user_archivement' => 'User Archivement',
			'user_facebook' => 'User Facebook',
			'lft' => 'Lft',
			'rgt' => 'Rgt',
			'level' => 'Level',
			'root' => 'Root',
			'user_name' => 'User Name',
		);
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('user_password',$this->user_password,true);
		$criteria->compare('user_token',$this->user_token,true);
		$criteria->compare('user_active',$this->user_active);
		$criteria->compare('user_phone',$this->user_phone,true);
		$criteria->compare('user_dob',$this->user_dob,true);
		$criteria->compare('user_gender',$this->user_gender,true);
		$criteria->compare('user_course',$this->user_course,true);
		$criteria->compare('user_study_field',$this->user_study_field,true);
		$criteria->compare('user_forte',$this->user_forte,true);
		$criteria->compare('user_archivement',$this->user_archivement,true);
		$criteria->compare('user_facebook',$this->user_facebook,true);
		$criteria->compare('lft',$this->lft);
		$criteria->compare('rgt',$this->rgt);
		$criteria->compare('level',$this->level);
		$criteria->compare('root',$this->root);
		$criteria->compare('user_name',$this->user_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function behaviors() {
        return array(
            'NestedSetBehavior' => array(
                'class' => 'ext.yiiext.behaviors.trees.NestedSetBehavior',
                'leftAttribute' => 'lft',
                'rightAttribute' => 'rgt',
                'levelAttribute' => 'level',
                'rootAttribute' => 'root',
                'hasManyRoots' => 'true',
        ));
    }
}
