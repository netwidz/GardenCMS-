<?php

class portal{
	
	var $id;
	var $contact_email;	
	var $popup_text;
	var $popup_text_status;
	var $rates_doc;

	// constructors
	function __construct(){}
	
	public function portal($id){
		
		$query = sprintf("SELECT * FROM portal_settings WHERE id=%s",$id);
				
		if($array = dbCon::getFetchArray($query)){
			$this->id = $id;
			$this->contact_email = $array['contact_email'];
			/*$this->popup_text = dbCon::removeslash($array['pop_text']);
			$this->popup_text_status = $array['pop_text_status'];
			$this->rates_doc = $array['rates_doc'];*/
		}
	}
	
	// set methods
	public function setId($value){ $this->id = $value;}
	public function setContactEmail($value){ $this->contact_email = $value;}
	public function setPopupText($value){ $this->popup_text = $value;}
	public function setRatesDoc($value){ $this->rates_doc = $value;}
	
	// get methods
	public function getId(){ return $this->id;}
	public function getContactEmail(){ return $this->contact_email;}
	public function getPopupText(){ return $this->popup_text;}
	public function getPopupTextStatus(){ return $this->popup_text_status;}
	public function getRatesDoc(){ return $this->rates_doc;}
	
	
	
	// update record
	public function updateField($field,$value){
		
		$query = sprintf("	UPDATE portal_settings SET $field='%s'
						 	WHERE id='%s'",
							$value,
							$this->getId());
		
		if($result = dbCon::execQuery($query)){
			return $result;	
		}
		else return false;
	}
	
	// get particular field record 
	public function retrieveRecord($field){
		$query = sprintf("SELECT $field FROM portal_settings WHERE id=1");
		if($array = dbCon::getFetchArray($query)){
			return $array[$field];	
		}
		else return false;
	}
	
	// upload document
	public function uploadDoc($array){
		//echo "<pre>";print_r($array);echo "</pre>";
		global $cosmetic;
		$path = $cosmetic->dirroot.'/images/files/';
		$doc_name = 'rates.pdf';
		//return $array["file"]["type"].'--'.$array["file"]["size"];
		
		if ((($array["file"]["type"] == "application/pdf") || ($array["file"]["type"] == "application/octet")) && ($array["file"]["size"] < 200000)){
				
			if ($array["file"]["error"] > 0) {
				return "<div class='warning'>Return Code: " . $array["file"]["error"] . "</div><br />";
			}
			else{
				copy($array["file"]["tmp_name"],$path.$doc_name);
				return true;
			}
		}
		else{
			return false;//"<div class='warning'>Invalid file type or file size exceeded</div>";
		}
	}
	
}
?>