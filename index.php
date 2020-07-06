<?php 

$acces_token = "";

$request = file_get_contents("php://input");
$input = json_decode($request, true);
if($input['event'] == 'webhook') {
  $webhook_response['status']=0;
  $webhook_response['status_message']="ok";
  $webhook_response['event_types']='delivered';
  echo json_encode($webhook_response);
  die;
}
else if($input['event'] == "subscribed") {
  // when a user subscribes to the public account
}
else if($input['event'] == "conversation_started"){
  // when a conversation is started
}
elseif($input['event'] == "message") {
  /* when a user message is received */
  $type = $input['message']['type']; //type of message received (text/picture)
  $text = $input['message']['text']; //actual message the user has sent
  $sender_id = $input['sender']['id']; //unique viber id of user who sent the message
  $sender_name = $input['sender']['name']; //name of the user who sent the message
  
  // here goes the data to send message back to the user
if($text == 'Menu'){
    $message_to_reply = "Here is your menu"
    // message
    $data['auth_token'] = $acces_token;
    $data['reciver'] = $sender_id;
    $data['type'] = "text";
    $data['text'] = $message_to_reply;

    // Here will be keyboard menu creator
//   $data = getMainMenu($sender_id); 
}  
  
  //here goes the curl to send data to user
  $ch = curl_init("https://chatapi.viber.com/pa/send_message ");
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  $result = curl_exec($ch);
  curl_close($ch);
}
?>