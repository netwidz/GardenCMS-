<?php

class contact{
	
	var $id;
	var $name;
	var $email;
	var $subject;
	var $telephone;
	var $message;
	var $date;

	// constructors
	function __construct(){}
	
	public function contact($id){
		
		$query = sprintf("SELECT * FROM messages WHERE id=%s ORDER BY date DESC",$id);
				
		if($array = dbCon::getFetchArray($query)){
			$this->id = $id;
			$this->name = $array['name'];
			$this->email = $array['email'];
			$this->telephone = $array['telephone'];
			$this->message = $array['message'];
			$this->date = $array['date'];
		}
	}
	
	// set methods
	public function setId($value){ $this->id = $value;}
	public function setName($value){ $this->name = $value;}
	public function setEmail($value){ $this->email = $value;}
	public function setTelephone($value){ $this->telephone = $value;}
	public function setMessage($value){ $this->message = $value;}	
	public function setDate(){ $this->date = date('Y-m-d H:i:s');}	
	
	public function setSubject($value){ $this->subject = $value;}	
	
	// get methods
	public function getId(){ return $this->id;}
	public function getName(){ return $this->name;}
	public function getEmail(){ return $this->email;}
	public function getTelephone(){ return $this->telephone;}
	public function getMessage(){ return $this->message;}	
	public function getDate(){ return $this->date;}
	
	public function getSubject(){ return $this->subject;}
	
	
	// save the record
	public function save(){
		
		$query = sprintf("	INSERT INTO messages (name,email,telephone,message,date) values ('%s','%s','%s','%s','%s')",
							$this->getName(),
							$this->getEmail(),
							$this->getTelephone(),
							$this->getMessage(),
							$this->getDate());
		
		if($result = dbCon::execQuery($query)){
			if($this->sendEmail()){
				return true;	
			}
			else return false;
			//return true;
		}
		else return false;
	}
	
	// get records
	public function getRecords(){
		$query = sprintf("SELECT * FROM messages ORDER BY date DESC");
		if($result = dbCon::execQuery($query)){
			return $result;	
		}
		else return false;
	}
	
	// filter records
	public function filterRecords($date){
		$query = sprintf("SELECT * FROM messages WHERE date='%s'",$date);
		if($result = dbCon::execQuery($query)){
			return $result;	
		}
		else return false;
	}
	
	
	//
	public function generate_contacts($table, $separator=';'){
		
		$contacts = '';
		
		$query = sprintf("SELECT email FROM $table");
		
		if(dbCon::getRowCount($query) > 0){
			$result = dbCon::execQuery($query);
			while($array = mysql_fetch_assoc($result)){
				$contacts .= $array['email'].$separator.' ';
			}
			
			return $contacts;
		}
		else return false;
	}
	
	
	public function sendEmail(){
	
		$email = portal::retrieveRecord('contact_email');
		//echo $email;
	
		$to = $email;//'shafraz.mhmd@gmail.com';
		$subject = 'New Inquiry';
		
		$name = $this->getName();
		$from_email = $this->getEmail();
		
		// To send HTML mail, the Content-type header must be set
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From: $from_email\r\n";
		
		// Additional headers
		//$headers .= "To:<$name>\r\n";
		
		$content = '<table width="100%" border="0">
				  <tr>
					<td colspan="2"><strong>New Inquiry</strong></td>
				  </tr>
				  <tr>
					<td width="30%">Name</td>
					<td>'.$this->getName().'</td>
				  </tr>
				  <tr>
					<td width="30%">E-mail</td>
					<td>'.$this->getEmail().'</td>
				  </tr>
				  <tr>
					<td width="30%">Telephone</td>
					<td>'.$this->getTelephone().'</td>
				  </tr>
				  <tr>
					<td width="30%">&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="2"><em>Message</em></td>
				  </tr>
				  <tr>
					<td colspan="2">'.$this->getMessage().'</td>
				  </tr>
				</table>';
		
		if($x = mail($to,$subject,$content,$headers)){
			return $x;
		}
		else return false;
		//return "true";
	}
	
	// reply email
	public function replyEmail(){
	
		$to = $this->getEmail();
		$subject = $this->getSubject();
		
		
		// To send HTML mail, the Content-type header must be set
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From: noreply@vertpoint.com\r\n";
		
		// Additional headers
		//$headers .= "To:<$name>\r\n";
		
		$content = '<table width="100%" border="0">
				  <tr>
					<td colspan="2"><strong>'.$subject.'</strong></td>
				  </tr>
				  <tr>
					<td colspan="2"><em>Message</em></td>
				  </tr>
				  <tr>
					<td colspan="2">'.$this->getMessage().'</td>
				  </tr>
				</table>';
		//return true;
		if($x = mail($to,$subject,$content,$headers)){
			return $x;
		}
		else return false;
	}
	
	// delete records
	public function delete(){
		$query = sprintf("DELETE FROM messages WHERE id='%s'",$this->getId());
		if($result = dbCon::execQuery($query)){
			return $result;	
		}
		else return false;
	}
}
?>