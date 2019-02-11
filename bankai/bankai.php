<?php
error_reporting(0);
require_once('config.php');
require_once('db_class.php');
require_once('php_sdp_library/test_utils.php');

$db = new Database();
$db->connect();
function ignite()
{
	echo 'Starting'.PHP_EOL;
	global $db;
	//get all from incoming where processed is 0 and shortcode is 	20506
	$sql='SELECT * FROM sms WHERE status=0';
	$emp_det = $db->sql('SELECT * FROM sms WHERE status=0');
	echo $num = $db->numRows();
	// var_dump($row = $db->getResult());
	// exit();
	if($num===0){
		echo 'No Rows'.PHP_EOL;
	//$this->db->pushError('');
	}
	else
	{
		$row = $db->getResult();
		foreach($row as $res)
		{
			echo 'Processing....'.PHP_EOL;
			$id = $res['id'];
			$phone = $res['to'];
			$fphone = trim($phone,"+");
			$message = $res['message'];

			$kmp_recipients = $fphone;

			//sdp variables
			$kmp_service_endpoint="http://svc.safaricom.com:8310/SendSmsService/services/SendSms";
			$kmp_spid="601954";
			$kmp_password="*David123#";
			$kmp_service_id="6019542000169037";
			$kmp_timestamp=date("Ymd");
			$kmp_correlator="7257011";
			$kmp_code="725701";
			$kmp_sppwd=md5($kmp_spid.$kmp_password.$kmp_timestamp);

			$response = messenger($kmp_spid,$kmp_sppwd,$kmp_service_id,$kmp_timestamp,$kmp_recipients,$kmp_correlator,$kmp_code,$message);
			// $r2 = json_decode($response,true);
			// $raw = array(
            //     'username'=>'davido',
            //     'password'=>'davido123',
			// 	'msisdn'=>$fphone,
			// 	'message'=>$message,
			// );
			// call their endpoints
			// echo $response = caller($raw);
			$status =  decoder($response);
			echo $status['ResultCode'];
			if($status['ResultCode']==200)
			{
				//update the table incoming sms processed to 0
				 updateField('sms','status','1',$id,'id');
				 echo 'Success'.PHP_EOL;
			}
			else
			{
				//log error
				echo 'Failed '.$response.PHP_EOL;
			}
		}
	}
	//fire to their end

	//update to one
}

function updateField($table,$field,$value,$where,$whereField)
{
	global $db;
	$sql='UPDATE '.$table.' SET '.$field.' = '.$value.' WHERE '.$whereField.' ='.$where.'';
	$res = $db->sql($sql);
}

function caller($data)
{
 	$url = 'http://197.248.2.3/smsapi/bulk/smsblast';
    $ch=curl_init($url);
    echo $data_string = json_encode($data);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	    'Content-Type: application/json',
	    'Content-Length: ' . strlen($data_string))
	);

	 return $result = curl_exec($ch);
	 // var_dump($result);
	 // exit();
}
function decoder($string)
{
	return $res = json_decode($string,true);

}
// $res = decoder();
// var_dump($res['status']);
while(true){
ignite();
}
