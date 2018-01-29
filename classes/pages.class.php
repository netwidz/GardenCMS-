<?php

class pages{
	
	var $id;
	var $title;
	var $mode;
	var $banner;
	var $text;
	var $keywords;
	var $description;
	
	var $link;

	// constructors
	function __construct(){}
	
	public function pages($id){
		
		$query = sprintf("SELECT * FROM pages WHERE id=%s",$id);
				
		if($array = dbCon::get_fetch_array($query)){
			$this->id = $id;
			$this->title = dbCon::removeslash($array['title']);
			$this->mode = $array['mode'];
			$this->banner = $array['banner'];
			$this->text = dbCon::removeslash($array['text']);
			$this->keywords = dbCon::removeslash($array['keywords']);
			$this->description = dbCon::removeslash($array['description']);
			
			//$this->link = 'content.php?cid='.$id;
			
		}
	}
	
	// set methods
	public function setId($value){ $this->id = $value;}
	public function setTitle($value){ $this->title = $value;}
	public function setMode($value){ $this->mode = $value;}
	public function setBanner($value){ $this->banner = $value;}
	public function setText($value){ $this->text = $value;}
	public function setKeywords($value){ $this->keywords = $value;}	
	public function setDescription($value){ $this->description = $value;}
	
	// get methods
	public function getId(){ return $this->id;}
	public function getTitle(){ return $this->title;}
	public function getMode(){ return $this->mode;}
	public function getBanner(){ return $this->banner;}
	public function getText(){ return $this->text;}
	public function getKeywords(){ return $this->keywords;}	
	public function getDescription(){ return $this->description;}
	
	public function getLink(){ return $this->link;}
	
	
	// save the record
	public function save(){
		
		$query = sprintf("	INSERT INTO pages (title,mode,banner,text,keywords,description) VALUES ('%s','%s','%s','%s','%s','%s')",
							$this->getTitle(),
							$this->getMode(),
							$this->getBanner(),
							$this->getText(),
							$this->getKeywords(),
							$this->getDescription());
		
		if($result = dbCon::execute_query($query)){
			return true;
		}
		else return false;
	}
	
	// save the record
	public function update(){
		
		$query = sprintf("	UPDATE pages SET title='%s', mode='%s', banner='%s', text='%s', keywords='%s', description='%s' 
							WHERE id='%s'",
							$this->getTitle(),
							$this->getMode(),
							$this->getBanner(),
							$this->getText(),
							$this->getKeywords(),
							$this->getDescription(),
							$this->getId());
		//return $query;
		if($result = dbCon::execute_query($query)){
			return true;
		}
		else return false;
	}
		
	// get records
	public function getRecords($type=null){
		
		$clause = ($type==null) ? "" : " WHERE type=$type";
		
		$query = sprintf("SELECT * FROM pages $clause ORDER BY type");
		if($result = dbCon::execute_query($query)){
			return $result;	
		}
		else return false;
	}
	
	// get left image list
	public function leftImgList($page_id){
		$query = sprintf("SELECT * FROM footerimage WHERE page='%s' ORDER BY id",$page_id);
		
		if(dbCon::getRowCount($query) > 0){
		
			if($result = dbCon::execute_query($query)){
				return $result;	
			}
			else return false;
		}
		else  return false;
	}
	// filter records
	public function searchPages($field,$value){
		$query = sprintf("SELECT * FROM pages WHERE ".$field." LIKE '%s'",$value."%");
		if($result = dbCon::execute_query($query)){
			return $result;	
		}
		else return false;
	}
	
	// upload footer picture
	public function uploadPic($array){
		
		global $bronx;
		$imgpath = $bronx->dirroot.'/images/page-banners/';
		//return $array["picture"]["type"].'--'.$array["picture"]["size"];
		
		if ((($array["picture"]["type"] == "image/jpeg") || ($array["picture"]["type"] == "image/pjpeg") || ($array["picture"]["type"] == "image/gif")) && ($array["picture"]["size"] < 200000)){
				
				if ($array["picture"]["error"] > 0) {
					return "Return Code: " . $array["picture"]["error"] . "<br />";
				}
				else{
					if (file_exists($imgpath.$array["picture"]["name"])){
						return $array["picture"]["name"] . " already exists. ";
					}
					else{
						copy($array["picture"]["tmp_name"],$imgpath.$array["picture"]["name"]);
					  	return true;
					}
				}
		}
		else{
			return "Invalid file type or file size exceeded";
		}
	}
	
	// delete records
	public function delete(){
		$query = sprintf("DELETE FROM pages WHERE id='%s'",$this->getId());
		if($result = dbCon::execute_query($query)){
			return $result;	
		}
		else return false;
	}
	
	// remove banner
	public function remove_banner(){
		
		global $bronx;
		$imgpath = $bronx->dirroot.'/images/page-banners/';
		
		$query = sprintf("SELECT banner FROM pages WHERE id='%s'",$this->getId());
		$array = dbCon::get_fetch_array($query);
		$image = $array['banner'];
		if($image && (file_exists($imgpath.$image))){
			
			dbCon::execute_query("UPDATE pages SET banner=0 WHERE id=".$this->getId());
			
			unlink($imgpath.$image);
			return true;
		}
		else return false;
	}
}
?>