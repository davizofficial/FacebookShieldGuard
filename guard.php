<?php
echo "
      ___          __ _ _    ___                  _ 
     | _ \_ _ ___ / _(_) |  / __|_  _ __ _ _ _ __| |
     |  _/ '_/ _ \  _| | | | (_ | || / _` | '_/ _` |     Author : Daviz Official
     |_|_|_| \___/_| |_|_|  \___|\_,_\__,_|_| \__,_|     
     | __|_ _ __ ___| |__  ___  ___| |__                 Github : https://github.com/davizofficial
     | _/ _` / _/ -_) '_ \/ _ \/ _ \ / /            
     |_|\__,_\__\___|_.__/\___/\___/_\_\            
     
     \n";
     echo "[+] Your token Facebook : ";
     $token = trim(fgets(STDIN));
     echo "\nWaiting...";
     sleep(2);
     
$md5 = md5(time());
$hash = substr($md5, 0, 8)."-".substr($md5, 8, 4)."-".substr($md5, 12, 4)."-".substr($md5, 16, 4)."-".substr($md5, 20, 12);
function curl($url, $post=null) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    if($post != null) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $exec = curl_exec($ch);
    curl_close($ch);
    return $exec;
}
$me = json_decode(curl("https://graph.facebook.com/me?fields=id&access_token=".$token));
if($me && $me->id) {
    $var = "{\"0\":{\"is_shielded\":true,\"session_id\":\"$hash\",\"actor_id\":\"$me->id\",\"client_mutation_id\":\"$hash\"}}";
    $hajar = json_decode(curl("https://graph.facebook.com/graphql", array(
        "variables" => $var,
        "doc_id" => "1477043292367183",
        "query_name" => "IsShieldedSetMutation",
        "strip_defaults" => "true",
        "strip_nulls" => "true",
        "locale" => "en_US",
        "client_country_code" => "US",
        "fb_api_req_friendly_name" => "IsShieldedSetMutation",
        "fb_api_caller_class" => "IsShieldedSetMutation",
        "access_token" => $token
    )));
    if($hajar->data->is_shielded_set->is_shielded){
    
    echo "\n[+] Guard Profile Installed\n";
    }
    else{ 
    echo "\n[x] Guard Profile Failed\n";
    }
}
?>