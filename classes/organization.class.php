<?php

class organization{
	
	var $id;
	var $name;
	var $address;
	var $city;
	var $state;
	var $zipcode;
	var $telephone;
	var $email;
	var $gmap;
	var $direction;
	var $note;
	var $contact_note;

	// constructors
	function __construct(){}
	
	public function organization($id){
		
		$query = sprintf("SELECT * FROM organization WHERE id=%s",$id);
				
		if($array = dbCon::get_fetch_array($query)){
			$this->id = $id;
			$this->name = $array['name'];
			$this->address = $array['address'];
			$this->city = $array['city'];
			$this->state = $array['state'];
			$this->zipcode = $array['zipcode'];
			$this->telephone = $array['telephone'];
			$this->email = $array['email'];
			$this->gmap = dbCon::removeslash($array['gmap']);
			$this->direction = dbCon::removeslash($array['direction']);
			$this->note = dbCon::removeslash($array['note']);
			$this->contact_note = dbCon::removeslash($array['contact_note']);
		}
	}
	
	// set methods
	public function setId($value){ $this->id = $value;}
	public function setName($value){ $this->name = $value;}
	public function setAddress($value){ $this->address = $value;}
	public function setCity($value){ $this->city = $value;}
	public function setState($value){ $this->state = $value;}	
	public function setZipCode($value){ $this->zipcode = $value;}
	public function setTelephone($value){ $this->telephone = $value;}
	public function setEmail($value){ $this->email = $value;}	
	public function setGmap($value){ $this->gmap = $value;}	
	public function setDirection($value){ $this->direction = $value;}
	public function setNote($value){ $this->note = $value;}
	public function setContactNote($value){ $this->contact_note = $value;}
	
	// get methods
	public function getId(){ return $this->id;}
	public function getName(){ return $this->name;}
	public function getAddress(){ return $this->address;}
	public function getCity(){ return $this->city;}
	public function getState(){ return $this->state;}	
	public function getZipCode(){ return $this->zipcode;}
	public function getTelephone(){ return $this->telephone;}
	public function getEmail(){ return $this->email;}	
	public function getGmap(){ return $this->gmap;}	
	public function getDirection(){ return $this->direction;}
	public function getNote(){ return $this->note;}
	public function getContactNote(){ return $this->contact_note;}
	
	
	
	// update record
	public function update(){
		
		$query = sprintf("	UPDATE organization SET name='%s', address='%s', city='%s', state='%s', zipcode='%s', 
						 	telephone='%s', email='%s', gmap='%s', direction='%s', note='%s', contact_note='%s'
						 	WHERE id='%s'",
							$this->getName(),
							$this->getAddress(),
							$this->getCity(),
							$this->getState(),
							$this->getZipCode(),
							$this->getTelephone(),
							$this->getEmail(),
							$this->getGmap(),
							$this->getDirection(),
							$this->getNote(),
							$this->getContactNote(),
							$this->getId());
		
		if($result = dbCon::execQuery($query)){
			return $result;	
		}
		else return false;
	}
	
		
}
?>