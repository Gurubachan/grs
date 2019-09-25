<?php
/**
 * Created by PhpStorm.
 * User: Gurubachan-Asus
 * Date: 9/24/2019
 * Time: 2:06 PM
 */

 defined('BASEPATH') OR exit('no direct access');

 function isLogin($sessionType)
 {
	 if(empty($_SESSION[$sessionType])){
		 redirect(base_url('Welcome'));
	 }

 }

?>
