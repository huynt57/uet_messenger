<?php

/**
 * This is the MongoDB Document model class based on table "tbl_message".
 */
class Message extends EMongoDocument
{
	public $id;
	public $from;
	public $to;
	public $sent_date;
	public $message;

	/**
	 * Returns the static model of the specified AR class.
	 * @return Message the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * returns the primary key field for this model
	 */
	public function primaryKey()
	{
		return NULL;
	}

	/**
	 * @return string the associated collection name
	 */
	public function getCollectionName()
	{
		return 'Message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, from, to, sent_date, message', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('from, to, sent_date', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, from, to, sent_date, message', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'from' => 'From',
			'to' => 'To',
			'sent_date' => 'Sent Date',
			'message' => 'Message',
		);
	}
}