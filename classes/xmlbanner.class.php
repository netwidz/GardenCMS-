<?php

class xmlbanner{
	
	var $id;
	var $name;
	var $text;
	var $link;
	var $target;
	var $imgname;
	var $duration;
	var $status;

	// constructors
	function __construct(){}
	
	public function xmlbanner($id){
		
		$query = sprintf("SELECT * FROM xmlbanner WHERE id=%s",$id);
				
		if($array = dbCon::getFetchArray($query)){
			$this->id = $id;
			$this->name = $array['name'];
			$this->text = $array['text'];
			$this->link = $array['link'];
			$this->target = $array['target'];
			$this->imgname = $array['imgname'];
			$this->duration = $array['duration'];
			$this->status = $array['status'];
		}
	}
	
	// set methods
	public function setId($value){ $this->id = $value;}
	public function setName($value){ $this->name = $value;}
	public function setText($value){ $this->text = $value;}
	public function setLink($value){ $this->link = $value;}
	public function setTarget($value){ $this->target = $value;}
	public function setImgName($value){ $this->imgname = $value;}
	public function setImgDuration($value){ $this->duration = $value;}
	public function setStatus($value){ $this->status = $value;}
	
	// get methods
	public function getId(){ return $this->id;}
	public function getName(){ return $this->name;}
	public function getText(){ return $this->text;}
	public function getLink(){ return $this->link;}
	public function getTarget(){ return $this->target;}
	public function getImgName(){ return $this->imgname;}
	public function getImgDuration(){ return $this->duration;}
	public function getStatus(){ return $this->status;}
	
	
	// save the record
	public function save(){
		
		$query = sprintf("	INSERT INTO xmlbanner (name,text,link,target,imgname,duration,status) 
							VALUES ('%s','%s','%s','%s','%s','%s','%s')",
							$this->getName(),
							$this->getText(),
							$this->getLink(),
							$this->getTarget(),
							$this->getImgName(),
							$this->getImgDuration(),
							$this->getStatus());
		//return $query;
		if($result = dbCon::execQuery($query)){
			
			self::writeXML();
			
			return true;
		}
		else return false;
	}
	
	// get records
	public function getRecords($status=null){
	
		$clause = ($status==null) ? "" : " WHERE status=$status";
		
		$query = sprintf("SELECT * FROM xmlbanner $clause ORDER BY name");
		if($result = dbCon::execQuery($query)){
			return $result;	
		}
		else return false;
	}
	
	
	// write the xml
	public function writeXML(){
		
		global $cosmetic;
		$file_path = $cosmetic->dirroot;
		
		$result = self::getRecords(1); // get only active images
		
		$fopen = fopen($file_path.'/settings.xml','w');
		
		if($fopen){
		
			$xml_string = '<?xml version="1.0" encoding="iso-8859-1"?>'."\n";
			
			$xml_string .= '<bannerrotator width="668" height="288"	random="no"	transition="mask5" easing="regular">'."\n";
			
			while($array = mysql_fetch_assoc($result)){
				
				$source = 'source="xml-banner/'.$array['imgname'].'"';
				$link = ($array['link']) ? 'hyperlink="'.$array['link'].'"' : '';
				$target = ($array['target']) ? 'target="'.$array['target'].'"' : '';
				$displaytime = 'displaytime="'.$array['duration'].'"';
				
				$xml_string .= "<banner $source $link $target $displaytime>"."\n";
					
					if($array['name'] && $array['text']){
						$xml_string .= '<title><![CDATA['.$array['name'].']]></title>'."\n";
					//if($array['text'])
						$xml_string .= '<text><![CDATA['.$array['text'].']]></text>'."\n";
					}
				
				$xml_string .= '</banner>'."\n";
				
			}
			
			$xml_string .= '</bannerrotator>';
			
			fwrite($fopen, $xml_string);
			
			fclose($fopen);
			
			return true;
		}
		else return false;

	}
	
	// update records
	public function update(){
		$query = sprintf("	UPDATE xmlbanner SET name='%s', text='%s', link='%s', target='%s', duration='%s', status='%s' 
							WHERE id='%s'",
							$this->getName(),
							$this->getText(),
							$this->getLink(),
							$this->getTarget(),
							$this->getImgDuration(),
							$this->getStatus(),
							$this->getId());
		if($result = dbCon::execQuery($query)){
			
			self::writeXML();
			
			return true;	
		}
		else return false;
	}
	
	// upload footer picture
	public function uploadPic($array){
		
		global $cosmetic;
		$imgpath= $cosmetic->dirroot.'/xml-banner/';
		
		//return $array["picture"]["type"].'--'.$array["picture"]["size"];
				
		if ((($array["picture"]["type"] == "image/jpeg") || ($array["picture"]["type"] == "image/pjpeg")
				 || ($array["picture"]["type"] == "application/x-shockwave-flash") || ($array["picture"]["type"] == "image/gif")) 
				&& ($array["picture"]["size"] < 200000)){
				
				if ($array["picture"]["error"] > 0) {
					return "<div class='warning'>Return Code: " . $array["picture"]["error"] . "</div><br/>";
				}
				else{
					if (file_exists($imgpath.$array["picture"]["name"])){
						return "<div class='warning'>".$array["picture"]["name"] . " already exists.</div>";
					}
					else{
						copy($array["picture"]["tmp_name"],$imgpath.$array["picture"]["name"]);
					  	return true;
					}
				}
		}
		else{
			return "<div class='warning'>Invalid file type or file size exceeded</div>";
		}
	}
	
	// delete records
	public function delete(){
	
		global $cosmetic;
		$imgpath = $cosmetic->dirroot.'/xml-banner/';
		
		
		$array = dbCon::getFetchArray("SELECT imgname FROM xmlbanner WHERE id=".$this->getId());
		//$this->flash($this->getId());
		$image = $imgpath.$array['imgname'];
		//return $image;
		$query = sprintf("DELETE FROM xmlbanner WHERE id='%s'",$this->getId());
		if($result = dbCon::execQuery($query)){
			
			self::writeXML();
			
			if(file_exists($image)){
				unlink($image);
			}
			return true;	
		}
		else return false;
	}
}
?>