<?php

class faq{
	
	var $id;
	var $title;
	var $answer;

	// constructors
	function __construct(){}
	
	public function faq($id){
		
		$query = sprintf("SELECT * FROM faq WHERE faq_id=%s",$id);
				
		if($array = dbCon::getFetchArray($query)){
			$this->id = $id;
			$this->title = dbCon::removeslash($array['faq_title']);
			$this->answer = dbCon::removeslash($array['faq_answer']);
		}
	}
	
	// set methods
	public function setId($value){ $this->id = $value;}
	public function setTitle($value){ $this->title = $value;}
	public function setFAQAnswer($value){ $this->answer = $value;}
	
	// get methods
	public function getId(){ return $this->id;}
	public function getTitle(){ return $this->title;}
	public function getFAQAnswer(){ return $this->answer;}
	
	
	// save the record
	public function save(){
		
		$query = sprintf("	INSERT INTO faq (faq_title,faq_answer) values ('%s','%s')",
							$this->getTitle(),
							$this->getFAQAnswer());
		
		if($result = dbCon::execQuery($query)){
			return true;
		}
		else return false;
	}
	
	// filter records
	public function filterRecords($date){
		$query = sprintf("SELECT * FROM faq WHERE date='%s'",$date);
		if($result = dbCon::execQuery($query)){
			return $result;	
		}
		else return false;
	}
	
	// get records
	public function getRecords(){
		$query = sprintf("SELECT * FROM faq ORDER BY faq_id");
		if($result = dbCon::execQuery($query)){
			return $result;	
		}
		else return false;
	}
		
	// update records
	public function update(){
		$query = sprintf("	UPDATE faq SET faq_title='%s', faq_answer='%s' WHERE faq_id='%s'",
							$this->getTitle(),
							$this->getFAQAnswer(),
							$this->getId());
		if($result = dbCon::execQuery($query)){
			return true;	
		}
		else return false;
	}
	
	
	// delete records
	public function delete(){
	
		$query = sprintf("DELETE FROM faq WHERE faq_id='%s'",$this->getId());
		if($result = dbCon::execQuery($query)){
			return true;	
		}
		else return false;
	}
}
?>