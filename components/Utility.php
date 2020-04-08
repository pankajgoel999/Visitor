<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\db\Query;
use yii\web\Session;
use app\models\LoginLog;
use yii\db\mssql\PDO;
class Utility extends Component {
     public function getdocumentpath($filepath){
        if(!empty($filepath)){
            $ext = pathinfo(getcwd()."/".$filepath, PATHINFO_EXTENSION);
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $p = getcwd()."/".$filepath;
            if(file_exists($p)){
                $mime = finfo_file($finfo, $p);
                $ext = Yii::$app->Utility->encryptString($ext);
                $mime = Yii::$app->Utility->encryptString($mime);
                $fileurl = Yii::$app->Utility->encryptString($filepath);
                $url = Yii::$app->homeUrl."viewdocument/encryption?key=$fileurl&key1=$ext&key2=$mime";
                return $url;
            }
        }
        
    }
    
    public function encryptString($encrypt){
        $string = base64_encode($encrypt);
        $key = Encrypt_Key;
        if(isset(Yii::$app->user->identity) AND !empty(Yii::$app->user->identity)){
            if(!empty(Yii::$app->user->identity->role_id)){
            $key = $key.Yii::$app->user->identity->role_id;
            }
        }
        $encrypted = base64_encode(Yii::$app->security->encryptByKey($string, $key));
        $encrypted = rawurlencode($encrypted);
        return $encrypted;
    }
    
    public function decryptString($string){
        $string = rawurldecode($string);
        $key = Encrypt_Key;
        if(isset(Yii::$app->user->identity) AND !empty(Yii::$app->user->identity)){
            if(!empty(Yii::$app->user->identity->role_id)){
            $key = $key.Yii::$app->user->identity->role_id;
            }
        }
        
        $decrypted = Yii::$app->security->decryptByKey(base64_decode($string), $key);
        $decrypted = base64_decode($decrypted);
        return $decrypted;
    }
    
    function DecryptPasswordToNormalData($passphrase, $jsonString) 
    {
        $jsondata = json_decode($jsonString, true);
        try 
        {
            $salt = hex2bin($jsondata["s"]);
            $iv = hex2bin($jsondata["iv"]);
        } 
        catch (Exception $e) 
        {
            return null;
        }
        $ct = base64_decode($jsondata["ct"]);
        $concatedPassphrase = $passphrase . $salt;
        $md5 = array();
        $md5[0] = md5($concatedPassphrase, true);
        $result = $md5[0];
        for ($i = 1; $i < 3; $i++) 
        {
            $md5[$i] = md5($md5[$i - 1] . $concatedPassphrase, true);
            $result .= $md5[$i];
        }
        $key = substr($result, 0, 32);
        $data = openssl_decrypt($ct, 'aes-256-cbc', $key, true, $iv);
        return json_decode($data, true);
    }
    
    static function initLogin($email) {
       $session = Yii::$app->session;
        $session->open();
       // echo "<pre>==";print_r($session);die;
         
		//die('22');
        $RID =$email;
        $ua = $_SERVER['HTTP_USER_AGENT'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $session['uniquecookieid'] = uniqid('', true);
        $uniquecookieid = $session['uniquecookieid'];
        $hash = $ua . "_" . $ip . "_" . $RID."_".$uniquecookieid;
        $hash = hash_hmac("sha1", $hash, DEPATRMENT);        
        $cOptions = array("secure" => true, "httpOnly" => true);
        $cookies = Yii::$app->response->cookies;
    	$cookies->add(new \yii\web\Cookie([
        'name' => 'cluster_cookie',
        'value' => $hash,
         'httpOnly' => true,
             'expire' => time() + 86400 * 365,   /*To chk logout issue -- 07-Nov-2017 */
        // 'secure' => true,
    ]));
        $session->close();
    //return true;
       
    }
    
    public function insertlog(){
		    $logs = new LoginLog();
        //echo "<pre>"; print_r(Yii::$app->user->identity);die;
            $logs->user_id = Yii::$app->user->identity->user_id;
            $logs->action = $_SERVER['REQUEST_URI'];
            $logs->IP = Yii::$app->getRequest()->getUserIP();
            $logs->user_agent = $_SERVER['HTTP_USER_AGENT'];//$this->headers->get('User-Agent');
            $logs->date_time = date('Y-m-d H:i:s');
            $logs->save(); 
		}
    
}
    
