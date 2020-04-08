<?php

namespace app\controllers;
use Yii;
class ViewdocumentController extends \yii\web\Controller
{
    public function actionEncryption()
    {
      //  die("123");
        if(isset($_GET['key']) AND !empty($_GET['key']) AND isset($_GET['key1']) AND !empty($_GET['key1']) AND isset($_GET['key2']) AND !empty($_GET['key2'])){
            $file = Yii::$app->Utility->decryptString($_GET['key']);
            $ext = Yii::$app->Utility->decryptString($_GET['key1']);
            $mime_type = Yii::$app->Utility->decryptString($_GET['key2']);
            
            if(empty($file) OR empty($ext) OR empty($mime_type)){
                header("Location: ".Yii::$app->homeUrl);
                exit;
            }
            
            $FileName = mt_rand().".$ext";
            header("Content-Type: $mime_type");
            header("Content-Disposition: inline; filename=$FileName");           
            header("Cache-Control: max-age=0");
            readfile($file);
        }
        
    }
    
    

}
 