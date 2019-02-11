<?php 

require_once('lib/sdp_utils.php');

//create an instance of the service
$sdp_service=new SDPService();

//SMS parameters

//$kmp_recipients=array("254723624727","254720265145","254720471865",'254722000001','254722000002','254722000004','254722000005','254722000003','254722000006','254722000007','254722000008');
// '254722170907','254723657479','254717871036','254721719528','254719159454'
// $kmp_recipients=array('254725597552','254722510993');
// $kmp_recipients="254725597552";
// echo $kmp_message='This is a Test from Cosmere Web Engine';

//send SMS
// $result=$sdp_service->sendSms($kmp_spid,$kmp_sppwd,$kmp_service_id,$kmp_timestamp,$kmp_recipients,$kmp_correlator,$kmp_code,$kmp_message);

//$kmp_request_identifier="100001200401130316085356054521";
//get sms delivery status
//$result=$sdp_service->getSmsDeliveryStatus($kmp_spid,$kmp_sppwd,$kmp_service_id,$kmp_timestamp,$kmp_request_identifier);
// $kmp_criteria='';
// $kmp_notify_endpoint='http://10.65.12.12/kmp/kempes/notifyservice.php';
// $result=$sdp_service->startSmsNotification($kmp_spid,$kmp_sppwd,$kmp_service_id,$kmp_timestamp,$kmp_notify_endpoint,$kmp_correlator,$kmp_code,$kmp_criteria);
//print_r($result);

//$result=$sdp_service->stopSmsNotification($kmp_spid,$kmp_sppwd,$kmp_service_id,$kmp_timestamp,$kmp_correlator);
// print_r($result);
function messenger($kmp_spid,$kmp_sppwd,$kmp_service_id,$kmp_timestamp,$kmp_recipients,$kmp_correlator,$kmp_code,$kmp_message){
    global $sdp_service;
    $result=$sdp_service->sendSms($kmp_spid,$kmp_sppwd,$kmp_service_id,$kmp_timestamp,$kmp_recipients,$kmp_correlator,$kmp_code,$kmp_message);
    // print_r($result);
    return '{"ResultCode": 200, "ResultDesc": "The service was accepted successfully", "messageID": "1234567890"}';
}
?>