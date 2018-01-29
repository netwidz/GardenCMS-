<?php

class testimonials{
	
	var $id;
	var $name;
	var $email;
	var $title;
	var $note;
	var $date;
	var $status;

	// constructors
	function __construct(){}
	
	public function testimonials($id){
		
		$query = sprintf("SELECT * FROM testimonials WHERE id=%s",$id);
				
		if($array = dbCon::getFetchArray($query)){
			$this->id = $id;
			$this->name = dbCon::removeslash($array['name']);
			$this->email = $array['email'];
			$this->title = dbCon::removeslash($array['title']);
			$this->note = dbCon::removeslash($array['note']);
			$this->date = $array['date'];
			$this->status = $array['status'];
		}
	}
	
	// set methods
	public function setId($value){ $this->id = $value;}
	public function setName($value){ $this->name = $value;}
	public function setEmail($value){ $this->email = $value;}
	public function setTitle($value){ $this->title = $value;}
	public function setNote($value){ $this->note = $value;}	
	public function setDate(){ $this->date = date('Y-m-d H:i:s');}	
	public function setStatus($value){ $this->status = $value;}	
	
	// get methods
	public function getId(){ return $this->id;}
	public function getName(){ return $this->name;}
	public function getEmail(){ return $this->email;}
	public function getTitle(){ return $this->title;}
	public function getNote(){ return $this->note;}	
	public function getDate(){ return $this->date;}
	public function getStatus(){ return $this->status;}	
	
	
	
	// save the record
	public function save(){
		
		$query = sprintf("	INSERT INTO testimonials (name,email,note,date) values ('%s','%s','%s','%s')",
							$this->getName(),
							$this->getEmail(),
							$this->getNote(),
							$this->getDate());
		//return $query;
		if($result = dbCon::execQuery($query)){
			$this->sendEmail();
			return true;
		}
		else return false;
	}
	
	
	// send email
	public function sendEmail(){
	
		$email = portal::retrieveRecord('email');
		//echo $email;
	
		$to = $email; //'shafraz.mhmd@gmail.com';
		$subject = 'New Testimonial';
		
		$name = stripslashes($this->getName());
		$from_email =  $this->getEmail();
		$testimonial =  stripslashes($this->getNote());
		
		// To send HTML mail, the Content-type header must be set
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From: $from_email\r\n";
		
		// Additional headers
		//$headers .= "To:<$name>\r\n";
		
		$content = '<table width="100%" border="0">
				  <tr>
					<td colspan="2"><strong>New Testimonial</strong></td>
				  </tr>
				  <tr>
					<td width="30%">Name</td>
					<td>'.$name.'</td>
				  </tr>
				  <tr>
					<td width="30%">From</td>
					<td>'.$from_email.'</td>
				  </tr>
				  <tr>
					<td colspan="2">Testimonial</td>
				  </tr>
				  <tr>
					<td colspan="2">'.$testimonial.'</td>
				  </tr>
				</table>';
		//return $content;
		if($x = mail($to,$subject,$content,$headers)){
			return true;
		}
		else return false;
		//return "true";
	}
	
	// get records
	public function getRecords($status=NULL){
		
		$clause = (empty($status)) ? '' : 'WHERE status='.$status;
		
		$query = sprintf("SELECT * FROM testimonials $clause ORDER BY date DESC");
		//return $query;
		if($result = dbCon::execQuery($query)){
			return $result;	
		}
		else return false;
	}
	
	// home page testimonial randomly
	public function getHomeTestimonial(){
	
		$testimonial = array();
	
		$query = sprintf("SELECT name, note FROM testimonials WHERE status=2 ORDER BY RAND() LIMIT 1");
		
		if($array = dbCon::getFetchArray($query)){
			
			$name = $array['name'];
			
			if(strlen($array['note']) > 100)
				$note = substr($array['note'],0,300).'...';
			else $note = $array['note'];
			
			$testimonial['note'] = dbCon::removeslash($note);
			$testimonial['name'] = $name;
		}
		
		return $testimonial;
			
	}
	
	// filter records
	public function filterRecords($date){
		$query = sprintf("SELECT * FROM testimonials WHERE date='%s'",$date);
		if($result = dbCon::execQuery($query)){
			return $result;	
		}
		else return false;
	}
	
	// update records
	public function update(){
		$query = sprintf("	UPDATE testimonials SET name='%s', title='%s', note='%s', status='%s' WHERE id='%s'",
							$this->getName(),
							$this->getTitle(),
							$this->getNote(),
							$this->getStatus(),
							$this->getId());
		if($result = dbCon::execQuery($query)){
			return true;	
		}
		else return false;
	}
	
	// delete records
	public function delete(){
		$query = sprintf("DELETE FROM testimonials WHERE id='%s'",$this->getId());
		if($result = dbCon::execQuery($query)){
			return $result;	
		}
		else return false;
	}
}
?>