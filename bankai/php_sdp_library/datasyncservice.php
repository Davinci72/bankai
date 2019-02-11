<?php
/* 
@author: Samuel Kamochu (skamochu@safaricom.co.ke or kamochu@gmail.com)
@created on: 13-03-2013
@version: 1
@description: The code allows to process syncOrderRelation requests from SDP. The code just extracts the critical parameters from the request. The programmer should adapt the code to process the data.
@required: PHP 5 server
*/

require("lib/server_inc.php");

/*
* Class that handles all soap requests sent to DataSyncService
*/
class DataSyncService{
	
	/*
	 * Method to process the syncOrderRelation SOAP request from the client
	 * The programmer must save some code to record the parameters received into the database/file for further processing
	 */
	function syncOrderRelation($userID,$spID,$productID,$serviceID,$serviceList,$updateType,$updateTime,$updateDesc,$effectiveTime,$expiryTime){
	  	  
		$msg_msisdn=$userID->ID;
		$msg_spID=$spID;
		$msg_productID=$productID;
		$msg_serviceID=$serviceID;
		$msg_serviceList=$serviceList;
		$msg_updateType=$updateType;
		$msg_updateTime=$updateTime;
		$msg_updateDesc=$updateDesc;
		$msg_effectiveTime=$effectiveTime;
		$msg_expiryTime=$expiryTime;
		
		 /*
		  * Code to use the data received will appear here. 
		  * You can connect save the data in a database and have it polled by another service.
		  */		
	  
		return array("result"=>0,"resultDescription"=>"OK");
	}
}

//Create server object and pass the location of the WSDL file
$server = new SoapServer("wsdl/datasyncservice.wsdl");

//set the class to handle various operations
$server->setClass("DataSyncService");

//handle the request
$server->handle($post);

?>