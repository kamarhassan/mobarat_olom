<?php


class forguetMail extends CFormModel
{
	public $email;
	public $result;
	/**
	 * @return string the associated database table name
	 */
	 /*
	public function tableName()
	{
		return '';
	}*/

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('email', 'email'),
			
		);
	}

	/**
	 * @return array relational rules.
	 */
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'email' => 'enter email',
			
		);
	}


}
