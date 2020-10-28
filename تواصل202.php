<?php
$token = "token";
$id = "id";

ob_start();
$API_KEY = $token;
$sudo = "$id";
define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
$url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch));
}else{return json_decode($res);}}
if(!file_exists("info.json")){
file_put_contents('info.json','{"chname":"sefoor","sended":"• تم استلام رسالتك ، ✅","churl":"t.me/sefoorhackeriraq","chat":"'.$sudo.'","start":"• اهلا بك في بوت التواصل للمحضورين ، 📮"}');}
$update = json_decode(file_get_contents('php://input'));
$info = json_decode(file_get_contents('info.json'),true);
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$mid = $message->message_id;
$text = $message->text;
$fn = $message->from->first_name;
$un = $message->from->username;
$cap = $message->caption;
$message_id = $update->callback_query->message->message_id;
$chat_id2 = $update->callback_query->message->chat->id;
$rpid = $message->reply_to_message->forward_from->id;
$fwd = $message->forward_from_chat->id;
$data = $update->callback_query->data;
if($message->photo){
if($message->photo[3]->file_id){
$ph = $message->photo[3]->file_id;}
elseif($message->photo[2]->file_id){
$ph = $message->photo[2]->file_id;}
elseif($message->photo[1]->file_id){
$ph = $message->photo[1]->file_id;}
elseif($message->photo[0]->file_id){
$ph = $message->photo[0]->file_id;}}
$helptext = "• حظر ، لحظر عضو بالرد
• الغاء الحظر ، لالغاء الحظر بالرد
• توجيه ، لارسال توجيه لشخص بالرد
• /setchat لتحدد مكان الاستلام ؛";
$setgroup = "• تم الحفظ ، ✅
• سوف تستلم الرسائل هنا ، ⚠️";
$stickersend = "• المرسل ، 🔽
- $fn
- $un";
$youban = "• تم حظرك ، ⚠️
• لايمكنك التواصل من خلال البوت ،";
$doneban = "• تم حظره ، ✅";
$youbaned = "• تم حظرك ، ⚠️
• لايمكنك التواصل من خلال البوت ،";
$doneunban = "• تم الغاء حظره ، ✅";
$youunbaned = "• تم الغاء حظرك ، ⚠️
• يمكنك التواصل من خلال البوت ،";
$fwdtoall = "• توجيه للكل ، ↪️";
$sendtoall = "• ارسال للكل ، 📮";
$chstart = "• تغير الـ /start ، 📜";
$chrd = "• تغير الرد ، 🏷";
$help = "• الاوامر ، 📃";
$sendtext = "• ارسل النص ، 📭";
$sendfwd = "• ارسل الرساله ، 📭";
$sendrd = "• ارسل الرد ، 🏷";
$sendst = "• ارسل الكليشه ، 📜";
$donech = "• تم الحفظ ، ✅";
$sendfwdto = "• ارسل الرساله ، 📭";
$donesend = "تم الارسال ، 📬";
$sudostart = "• اهلا بك في بوت التواصل الخاص بك ، 🔱
عدد الاعضاء 👥؛ ".count($info["users"]);
$back = "• رجوع ، ◀️";
$chlo = "• تغير الحقوق ، 🔘";
$chpr = "• تغير النبذه ، 📋";
$sendchlo = "• الان ارسل الحقوق مثل ، 
اسم القناه
الرابط
ك مثال ؛ 
sefoor
T.me/sefoorhackeriraq";
$sendchpr = "• الان ارسل نبذه قصيره ، 📇";
$pr = "• النبذه ، 💳";
if($info['bans']["$from_id"]=='ban' && $info["chat"] !== $chat_id){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"$youban",]);return false;}
if($text == "/start" && $info["chat"] !== ($chat_id or $from_id)){
if(!in_array($from_id,$info["users"])){
$info["users"][] = $from_id;
file_put_contents("info.json", json_encode($info));}
bot('sendMessage', [
'chat_id'=>$chat_id,
'text'=>$info['start'],
'reply_to_message_id'=>$msid,
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
'reply_markup' => json_encode(['inline_keyboard' => [
[['text' =>$info["chname"], 'url' =>$info["churl"]]],[['text'=>"$pr", 'callback_data'=>"pro"]],]])]);}
if($text == "/start" && $info["chat"] == $chat_id){
bot('sendMessage', [
'chat_id'=>$chat_id,
'text'=>"$sudostart",
'reply_to_message_id'=>$msid,
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"$fwdtoall", 'callback_data'=>"fwd"],['text'=>"$sendtoall", 'callback_data'=>"send"]],[['text'=>"$chstart", 'callback_data'=>"chst"],['text'=>"$chrd", 'callback_data'=>"chrd"]],[['text'=>"$chlo", 'callback_data'=>"chlo"],['text'=>"$chpr", 'callback_data'=>"chpr"]],[['text'=>"$help", 'callback_data'=>"help"]],]])]);}
if($text == "/setchat" && $from_id == $sudo){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"$setgroup",]);
$info["chat"] = $chat_id;
file_put_contents("info.json", json_encode($info));}
if($message && !$fwd && $info["chat"] !== $chat_id&& $text !== "/start"){
if($info['bans']["$from_id"]!=="ban"){
bot('forwardMessage',[
'chat_id'=>$info["chat"],
'from_chat_id'=>$chat_id,
'message_id'=>$mid]);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>$info["sended"],]);
if($message->sticker){
bot('sendMessage',[
'chat_id'=>$info["chat"],
'text'=>"$stickersend",]);}}
if($info['bans']["$from_id"]=='ban'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"$youban",]);}}
if($rpid && $info["chat"] == $chat_id && $text !== "حظر" && $text !== "الغاء الحظر" && $text !== "توجيه"){
if($text){
bot('sendMessage',['chat_id'=>$rpid,'text'=>$text]);}
if($message->photo){
bot('sendPhoto',['chat_id'=>$rpid,'photo'=>$ph,'caption'=>$cap,]);}
if($message->video){
bot('sendVideo',['chat_id'=>$rpid,'video'=>$message->video->file_id,'caption'=>$cap,]);}
if($message->document){
bot('senddocument',['chat_id'=>$rpid,'document'=>$message->document->file_id,'caption'=>$cap]);}
if($message->voice){
bot('sendvoice',['chat_id'=>$rpid,'voice'=>$message->voice->file_id,'caption'=>$cap,]);}
if($message->audio){
bot('sendaudio',['chat_id'=>$rpid,'audio'=>$message->audio->file_id,'caption'=>$cap,]);}
if($message->sticker){
bot('sendsticker',['chat_id'=>$rpid,'sticker'=>$message->sticker->file_id,]);}}
if($rpid && $text == 'توجيه' && $info["chat"] == $chat_id){
$info["step"] = "fwdto";
$info["id"] = "$rpid";
file_put_contents("info.json", json_encode($info));
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"$sendfwdto",
'reply_to_message_id'=>$mid]);return false;}
if($rpid && $text == 'حظر' && $info["chat"] == $chat_id){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"$doneban",
'reply_to_message_id'=>$mid]);
bot('sendMessage',[
'chat_id'=>$rpid,
'text'=>"$youbaned"]);
$info["bans"]["$rpid"] = "ban";
file_put_contents("info.json", json_encode($info));}
if($rpid and $text == 'الغاء الحظر' && $info["chat"] == $chat_id){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"$doneunban",
'reply_to_message_id'=>$mid]);
bot('sendMessage',[
'chat_id'=>$rpid,
'text'=>"$youunbaned"]);
$info["bans"]["$rpid"] = "unban";
file_put_contents("info.json", json_encode($info));}
if(preg_match('/(back)/',$data)){
$info["step"] = "off";
file_put_contents("info.json", json_encode($info));
bot('editMessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id,
'text'=>"$sudostart",
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"$fwdtoall", 'callback_data'=>"fwd"],['text'=>"$sendtoall", 'callback_data'=>"send"]],[['text'=>"$chstart", 'callback_data'=>"chst"],['text'=>"$chrd", 'callback_data'=>"chrd"]],[['text'=>"$chlo", 'callback_data'=>"chlo"],['text'=>"$chpr", 'callback_data'=>"chpr"]],[['text'=>"$help", 'callback_data'=>"help"]],]])]);}
if(preg_match('/(chst)/',$data)){
$info["step"] = "chst";
file_put_contents("info.json", json_encode($info));
bot('editMessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id,
'text'=>"$sendst",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"$back", 'callback_data'=>"back"]]]])]);return false;}
if(preg_match('/(chrd)/',$data)){
$info["step"] = "chrd";
file_put_contents("info.json", json_encode($info));
bot('editMessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id,
'text'=>"$sendrd",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"$back", 'callback_data'=>"back"]]]])]);return false;}
if(preg_match('/(fwd)/',$data)){
$info["step"] = "fwd";
file_put_contents("info.json", json_encode($info));
bot('editMessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id,
'text'=>"$sendfwd",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"$back", 'callback_data'=>"back"]]]])]);return false;}
if(preg_match('/(chpr)/',$data)){
$info["step"] = "chpr";
file_put_contents("info.json", json_encode($info));
bot('editMessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id,
'text'=>"$sendchpr",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"$back", 'callback_data'=>"back"]]]])]);return false;}
if(preg_match('/(chlo)/',$data)){
$info["step"] = "chlo";
file_put_contents("info.json", json_encode($info));
bot('editMessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id,
'text'=>"$sendchlo",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"$back", 'callback_data'=>"back"]]]])]);return false;}
if(preg_match('/(pro)/',$data)){
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>$info["pr"],
'show_alert'=>true]);}
if(preg_match('/(send)/',$data)){
$info["step"] = "send";
file_put_contents("info.json", json_encode($info));
bot('editMessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id,
'text'=>"$sendtext",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"$back", 'callback_data'=>"back"]]]])]);return false;}
if(preg_match('/(help)/',$data)){
bot('editMessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id,
'text'=>"$helptext",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"$back", 'callback_data'=>"back"]]]])]);return false;}
if($info['step'] == "chpr" && $info["chat"] == $chat_id){
$info["pr"] = "$text";
$info["step"] = "off";
file_put_contents("info.json", json_encode($info));
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"$donech"]);}
if($info['step'] == "chlo" && $info["chat"] == $chat_id){
$ex = explode("\n",$text);
$info["chname"] = "$ex[0]";
$info["churl"] = "$ex[1]";
$info["step"] = "off";
file_put_contents("info.json", json_encode($info));
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"$donech"]);}
if($info['step'] == "chst" && $info["chat"] == $chat_id){
$info["start"] = "$text";
$info["step"] = "off";
file_put_contents("info.json", json_encode($info));
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"$donech"]);}
if($info['step'] == "chrd" && $info["chat"] == $chat_id){
$info["sended"] = "$text";
$info["step"] = "off";
file_put_contents("info.json", json_encode($info));
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"$donech"]);}
if($info['step'] == "send" && $info["chat"] == $chat_id){
$mbs = $info['users'];
foreach($mbs as $mb){
$url = file_get_contents("https://api.telegram.org/bot$API_KEY/sendMessage?chat_id=".$mb."&parse_mode=markdown&disable_web_page_preview=true&text=".urlencode($text));}
$info["step"] = "off";
file_put_contents("info.json", json_encode($info));
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"$donesend"]);}
if($info['step'] == "fwd" && $info["chat"] == $chat_id){
$mbs = $info['users'];
foreach($mbs as $mb){
bot('forwardMessage',[
'chat_id'=>$mb,
'from_chat_id'=>$chat_id,
'message_id'=>$message->message_id]);}
$info["step"] = "off";
file_put_contents("info.json", json_encode($info));
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"$donesend"]);}
if($info['step'] == "fwdto" && $info["chat"] == $chat_id){
bot('forwardMessage',[
'chat_id'=>$info['id'],
'from_chat_id'=>$chat_id,
'message_id'=>$message->message_id]);
$info["step"] = "off";
file_put_contents("info.json", json_encode($info));
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"$donesend"]);}