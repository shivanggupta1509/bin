<?php
#AUTHOR-sh1vxng
#dont change the credits mf
$input=file_get_contents('php://input');
$data=json_decode($input);
$uname=$data->message->from->first_name;
$chat_id=$data->message->chat->id;
$text=$data->message->text;
$message_id=$data->message->message_id;
if (strpos($text,'/bin') !== false) {
$cctwo = substr("$text", 5, 6);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$cctwo.'');
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  'Host: lookup.binlist.net',

'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',

'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '');

$fim = curl_exec($ch);

$fim = json_decode($fim,true);
$bank = $fim['bank']['name'];
$country = $fim['country']['alpha2'];
$type = strtoupper($fim['type']);
$level = strtoupper($fim['brand']);
$visa = strtoupper($fim['scheme']);
if(isset($fim['scheme'])){
 $msg="*BIN INFORMATION⚡*%0A*VALID BIN  ✅*%0A*BIN* ➨ `$cctwo`%0A*Scheme ➨ $visa*%0A*Level ➨ $level*%0A*type ➨ $type%0Acountry ➨ $country%0Abank ➨ $bank*%0A*Checked By ➨ $uname*%0A*Bot By ➨ @livinghumanoid*";
}else{
$msg="*INVALID BIN❗*%0A*BIN* ➨ `$cctwo`%0A*Checked By ➨ $uname*%0A*Bot By ➨ @livinghumanoid*";
}
curl_close($ch);
$url="https://api.telegram.org/bot5699499694:AAGd52V0mLeb_X56gqc5YvFq5105hBoPJSQ/sendMessage?chat_id=$chat_id&text=$msg&reply_to_message_id=$message_id&parse_mode=MarkDown";

file_get_contents($url);
}
if($text=='/id'){
$text6="User Info🔰";
$bhaikaname="User Name:$uname";
$bhaikiid="User Id:$chat_id";
$botby="*Bot By @livinghumanoid*";
$msg="$text6%0A%0A$bhaikaname%0A$bhaikiid%0A$botby";

if($chat_id=='1863273613'){
  $msg="$text6%0A$bhaikaname%0A$bhaikiid%0A(CREATOR)%0A*$botby*";
}else {
  $msg="$text6%0A$bhaikaname%0A$bhaikiid%0A(NORMAL USER)%0A*$botby*";
}
$url="https://api.telegram.org/bot5699499694:AAGd52V0mLeb_X56gqc5YvFq5105hBoPJSQ/sendMessage?chat_id=$chat_id&text=*$msg*&reply_to_message_id=$message_id&parse_mode=MarkDown";
file_get_contents($url);
}

?>
