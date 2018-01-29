<?php
/*
* This file contains code for product searching and filtering options
*/

require_once '../config.inc.php';

global $cosmetic;
$abs_path = $cosmetic->wwwroot;
$img_path = $cosmetic->wwwroot.'images/';

if(isset($_POST)){
	//echo '<pre>'; print_r($_POST); echo '</pre>';
	
	$objProduct = new product();
	
	if((isset($_POST['_task'])) && ($_POST['_task']=='signout')){
	
		session_destroy();
		$location = $abs_path.'index.php';
		echo true;
		exit(0);
	}
	
	if((isset($_POST['_task'])) && ($_POST['_task']=='sortbybrand')){
		
		$cid = $_POST['cid']; // category id
		$bid = $_POST['bid']; // brand id
		
		$category_list = array($cid);
		if(category::checkSubCategory($cid)){				
			$sub_category = category::getSubCategory($cid);
		}
		
		if($sub_category){
			foreach($sub_category as $cat_id=>$array){
				$category_list[] = $cat_id;	
			}
		}
		//echo '<pre>'; print_r($category_list); echo '</pre>';
		
		if(count($category_list) > 0){
			
			$products = array(); // product_ids list of selected category and and its sub categories
						
			$array_filter = array();
			
			foreach($category_list as $category_id){
			
				$array_filter['category_id'] = $category_id;
				$array_filter['brand_id'] = $bid;
			
				$rows = product::filterProductsByCategory($array_filter);
			
				//echo $rows;
				if($rows){
					foreach($rows as $product){
						if(!in_array($product['product_id'],$products))	
							$products[] = $product['product_id'];
					}
				}
			}
			//echo '<pre>'; print_r($products); echo '</pre>';
			
			if(count($products) > 0){
			
				$result .= '<div id="hiddenresult" style="display:none;">';
			
				foreach($products as $product_list){
					
					//echo '<pre>'; print_r($product_list); echo '</pre>';	
					$product = $objProduct -> product($product_list);
					//echo $product;
					
					$product_id = $product['product_id']; //echo $product_id; // product id
					$name = $product['name']; // product name
					$retail_price = $product['retail_price']; // product retail price
					
					$price = price::get_product_price($product_id);
					
					$result .= '<div class="category-product result">
									<a href="'.$abs_path.'product.php?pid='.$product_id.'"> 
										<img src="'.$img_path.'product/thumb/160x140/'.$product['image'].'"  
											width="160" height="140" alt="'.$name.'"/>
									</a>
									<div class="cat-prod-title">
										<a href="'.$abs_path.'product.php?pid='.$product_id.'&cid='.$cid.'">'.$name.'</a>
									</div>';
					
					if($retail_price!=0){
					
						$result .= '<div class="cat-prod-retail-price">Retail Price : 
										<span class="retail-price">$ '.$retail_price.'</span>
									</div>';
					}
					
					$result .= '<div class="cat-prod-our-price">Our Price : 
										<span class="our-price">$ '.$price[0]['sell_price'].'</span>
									</div>
								</div>';
				
				}
				
				$result .= '</div>';
			}
			else {
				$result .= '<div style="padding-left:12px;">Not Available !</div>';
			}
		}
		echo $result;
	
		//echo '<pre>'; print_r($rows); echo '</pre>';		
	
		exit(0);
	}
	
	/* contact page form */
	if(isset($_POST['_task']) && ($_POST['_task']=='send')){
	
		//include("utils/securimage/securimage.php");	
		//echo '<pre>'; print_r($_POST); echo '</pre>';
		
		$objContact =  new contact();
			
		/*$img = new Securimage();
		$valid = $img->check($_POST['security']);*/
		
		$cryptinstall = "../utils/crypt/cryptographp.fct.php";
		include $cryptinstall;
		$valid = chk_crypt($_POST['security']);// echo $valid;

		if($valid){
		 	//echo $valid;
			//echo "This is OK";
			
			$objContact -> setName(dbCon::addslash($_POST['name']));
			$objContact -> setEmail(dbCon::addslash($_POST['email']));
			$objContact -> setTelephone(dbCon::addslash($_POST['telephone']));
			$objContact -> setMessage(dbCon::addslash($_POST['message']));
			$objContact -> setDate();
			
			//$x=$objContact -> sendEmail(); echo $x;
			
			if($x=$objContact -> save()){
				echo '1';//'<div class="success">Message Sent.</div>';
			}
			else echo '2';//'<div class="warning">Unable to send your message.</div>';
		}
		else echo '3';//'<div class="warning">Invalid Security Code.</div>';
		//echo "OK";
		exit(0);
	
	}
}

?>