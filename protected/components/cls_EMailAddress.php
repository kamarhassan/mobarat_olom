<?php
class cls_EMailAddress{
	public $email;
	public $label;
	
	function __construct($emailstr,$labelstr){
		$this->email=$emailstr;
		$this->label=$labelstr;
	}
}
?>
