<?php
require_once 'twilio/vendor/autoload.php';
use Twilio\Rest\Client;

$sid = "twilioSID";
$token = "twilioToken";
$client = new Client($sid, $token);
$twilio = "+twilioNumber";
$conferenceURL = "https://conferenceURL";

$number = $_POST['From'];
$body = $_POST['Body'];
$text = strtolower($body);

header('Content-Type: text/xml');
 ?>

 <Response>
   <?php
   if($text == "join"){
     echo "<Message>Thanks for texting Hack K-State ".$number."! We'll add you to the call shortly!</Message>";
     try {
       $call = $client->account->calls->create(
           $number,
           $twilio,
           array("url" => $conferenceURL)
       );
       echo "Started call: " . $call->sid;
     } catch (Exception $e) {
       echo "Error: " . $e->getMessage();
     }
   }
   else if ($text == "suh" || $text == "suh!" || $text == "suh dude" || $text == "suh dude!"){
     echo "<Message>Suh dude!</Message>";
   }
   else {
     echo "<Message>Hey ".$number."! You sent ".$body.". You should send the word 'Join' to be added to the call!</Message>";
   }
   ?>
</Response>
