<?php

namespace app\services;
/**
 * Service is the customized base Service class.
 * All Service classes for this application should extend from this base class.
 */
class Service
{

	public static function load() {
        $class = get_class();
        return new $class;
    }

   	function curl_post($url, $post = NULL, array $options = []) 
	{
	    $defaults = [
	        CURLOPT_POST => 1, 
	        CURLOPT_HEADER => 0, 
	        CURLOPT_URL => $url, 
	        CURLOPT_FRESH_CONNECT => 1, 
	        CURLOPT_RETURNTRANSFER => 1, 
	        CURLOPT_FORBID_REUSE => 1, 
	        CURLOPT_TIMEOUT => 0, 
	        CURLOPT_POSTFIELDS => $post,
	        CURLOPT_SSL_VERIFYPEER => 0
	    ];
	    $ch = curl_init(); 
	    curl_setopt_array($ch, ($options + $defaults));

	    if( ! $result = curl_exec($ch)) { 
	        $result = curl_error($ch); 
	    } 
	    curl_close($ch); 
	    return $result; 
	}

	function curlExec($url, $post = NULL, array $header = array()){
        $ch = curl_init($url);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        if(count($header) > 0) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        if($post !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post, '', '&'));
        }
    
        //Ignore SSL
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

	function curl_get($url, array $params = [], array $options = []) 
	{ 

		if(count($params))
			$url .= "/?".http_build_query($params);

	    $defaults = [
	        CURLOPT_CUSTOMREQUEST => "GET", 
	        CURLOPT_URL => $url, 
	        CURLOPT_RETURNTRANSFER => true, 
	        CURLOPT_SSL_VERIFYPEER => false,
	        CURLOPT_TIMEOUT => 1000, 
	    ]; 

	    $ch = curl_init(); 	
	    curl_setopt_array($ch, ($options + $defaults)); 

	    if(!$result = curl_exec($ch)) {
	        trigger_error(curl_error($ch)); 
	    }

	    curl_close($ch);
	    return $result; 
	} 

}
