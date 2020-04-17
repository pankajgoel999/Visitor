<?php

namespace app\controllers;

use Yii;
use app\models\UserProfile;
use app\models\UserProfileSearch;
use app\models\Users;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RegistrationController implements the CRUD actions for UserProfile model.
 */
class RegistrationController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all UserProfile models.
     * @return mixed
     */
    
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
}
    public function actionNew()
    {
        echo "**";
        $response = array();
        $data = parse_str($_POST['formdata'], $info);        
         print_r($info); die;
    }
    public function actionIndex()
    {
        $model = new UserProfile();
        $model1 = new Users();
        @session_start();

        
        if ($model->load(Yii::$app->request->post())) {
            
//            echo "##<pre>"; print_r($_POST);
//            echo "@@<pre>"; print_r($_FILES);
//            echo "%%<pre>"; print_r($_SESSION); die("**");
           
             
			$UserProfile = $_POST['UserProfile'];
            
            $captcha = $UserProfile['captcha'];
            $session = $_SESSION['register_captcha'];
			$session = strtoupper($session);
			$captcha = strtoupper($captcha);
            
            if($session != $captcha){
				Yii::$app->getSession()->setFlash('danger', 'Invalid Captcha'); 
				return $this->render('create', [
                    'model' => $model,
                ]);
			}
            
            
           /************ Photo Upload ************/
            
           if((isset($_POST['Photo']['Image_type']) && !empty($_POST['Photo']['Image_type'])) && (isset($_POST['Photo']['Image_Ext']) && !empty($_POST['Photo']['Image_Ext'])) && (isset($_POST['tblCandidateImage']) && !empty($_POST['tblCandidateImage']))) {
            
            $tblCandidateImage = $_POST['tblCandidateImage'];

            if((isset($tblCandidateImage['Image_Content']) && !empty($tblCandidateImage['Image_Content']))){
            
                $Image_type = trim($_POST['Photo']['Image_type']);
                $Image_Ext = trim($_POST['Photo']['Image_Ext']);
        
                    if( (($Image_type =="data:image/jpeg" || $Image_type =="data:image/jpg") && ($Image_Ext =="jpeg" || $Image_Ext =="jpg")) || ($Image_type =="data:image/png" && $Image_Ext =="png")) {
                        
                    $Image_Content = $tblCandidateImage['Image_Content'];
                    $Image_type_Final = $Image_type.";base64,";
                    $Image_ContentArray = explode($Image_type_Final,$Image_Content);
        
                        if(count($Image_ContentArray)=="2" && isset($Image_ContentArray[1]) && !empty($Image_ContentArray[1])) {
                            
                        $validateString  = strpos($Image_Content,$Image_type_Final);
        
                            if($validateString !== false) {            
                                
                                $imageContent1 = $Image_ContentArray[1];
                                $validateImage_Content = base64_decode($imageContent1);
        
                                if($validateImage_Content !== false){
                                   // echo "<pre>1";print_r($Image_ContentArray);die("@@@@@");
                                    $fileSize = strlen($validateImage_Content)/1000;         
                                    
                                    if($fileSize<=FILEUPLOADSIZE) {
                                        $im = imagecreatefromstring($validateImage_Content);
                                        $is_process = false;
                                        
                                        if ($im !== false){
                                            if( ($Image_type =="data:image/jpeg" || $Image_type =="data:image/jpg") && ($Image_Ext =="jpeg" || $Image_Ext =="jpg")) {       
                                                //header('Content-Type: image/jpeg');
                                                $imageext='.jpg';
                                                $final_imageName= $this->generatePath($imageext);
                                                $path = PROFILE_PHOTO_PATH.$final_imageName;       
                                                $is_process = true;
                                                imagejpeg($im,$path);            
                                                chmod($path, 0777);
                                            } else {
                                                 $imageext='.png';
                                                 $final_imageName= $this->generatePath($imageext);
                                                 $path = PROFILE_PHOTO_PATH.$final_imageName;
                                                 $is_process = true;
                                                 imagepng($im, $path);
                                                 chmod($path, 0777);
                                            }
                                            imagedestroy($im);
        
                                            if($is_process){
                                               $UserProfile['personal_photo'] = $final_imageName;
                                            }
                                        }
                                      }
                                }
                            }
                        }
                    }
            }
        }
            
            
          /*------Address Proof Upload---------*/    
         if((isset($_FILES['UserProfile']['name']['id_file'])) && !empty($_FILES['UserProfile']['name']['id_file'])){   
                
                $folderName = getcwd()."/uploads/visitor_id/";
				if(!file_exists($folderName)){
					mkdir($folderName, 0777, true);
                    chmod($folderName, 0777);
				}
             
                $addressFileTempName = $_FILES['UserProfile']['tmp_name']['id_file'];
				$addressFileName = $_FILES['UserProfile']['name']['id_file'];
				$addressinfo = new \SplFileInfo($addressFileName);
                $extaddress = $addressinfo->getExtension();
                $newaddressFileName = strtotime(date('Y-m-d H:i:s')).rand().'.'.$extaddress;
                $finaladdressName = $folderName.$newaddressFileName;
                $address_path = NULL;
                if(move_uploaded_file($addressFileTempName,$finaladdressName)){
					chmod($finaladdressName, 0777);
					$address_path = "/".$newaddressFileName;
                    $UserProfile['id_file'] = $address_path;
				}
         }       
            
            
                 $connection = Yii::$app->db;
			     $transaction = $connection->beginTransaction();
			
            try {
                $secret='#_ZII_#';
                $password = Yii::$app->Utility->DecryptPasswordToNormalData($secret,$UserProfile['password']);  
                $password = md5($password);
                
                $model1->username = $UserProfile['email'];
                $model1->Role_Id = "4";
                $model1->password = $password;
                $model1->is_active = "Y";
                $model1->date_modified = date('Y-m-d');
                
                if(!$model1->validate()){
                    echo "herere11!!!!"; $errors11 = $model1->errors; echo "<pre>"; print_r($errors11);die;
                    $errors = $model->errors;
					Yii::$app->getSession()->setFlash('danger', $errors11);
				    return $this->render('create', [
                        'model' => $model,
                        
                    ]);
					exit;			
                }else{
                    $model1->save();        
                }
                $id =$model1->user_id;
             
                 $model->user_id = $id;
                 $model->id_file = $address_path;
                 $model->personal_photo = $final_imageName;
                 $model->date_modified = date('Y-m-d');
                 $model->dob = date('Y-m-d', strtotime($UserProfile['dob']));
                
                if(!$model->validate()){
                     echo "herere%%%!!!!"; $errors = $model->errors; echo "<pre>"; print_r($errors); die;
                    $errors = $model->errors;
					Yii::$app->getSession()->setFlash('danger', $error);
				    return $this->render('create', [
                        'model' => $model,
                        
                    ]);
					exit;			
                }else{
                    $model->save();        
                }
                $url = Yii::$app->homeUrl."registration";
                $transaction->commit();
                Yii::$app->getSession()->setFlash('success', "Visitor Registered Successfully");
				return $this->redirect($url);
				exit;
				
			}catch (\Exception $e) {
				$transaction->rollBack();
				throw $e;
				$error = $e;
				Yii::$app->getSession()->setFlash('danger', $error);
				return $this->redirect($url);
				exit;
			}  

            die("123");
           
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    
      private function generatePath($imageext)
    {
        $finalUser =  $userId = "111";
        $validateString  = strpos($userId,'@');
        if($validateString !== false)
        { 
          $userStr = explode('@',$userId);
          $finalUser = $userStr[0];          
        }
          $finalUser = str_replace('-','',$finalUser);
          $finalUser = str_replace('.','',$finalUser);
          $finalUser = str_replace('_','',$finalUser);
          $finalUser = strtoupper($finalUser);
          $randomNumber = md5(uniqid(rand(), true));
          $finalUser = $finalUser."_".$randomNumber;
          $finalUser = $finalUser.$imageext;
          return $finalUser;
        
    }
    
    
    /**
     * Displays a single UserProfile model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
//    public function actionView($id)
//    {
//        return $this->render('view', [
//            'model' => $this->findModel($id),
//        ]);
//    }
//
//    /**
//     * Creates a new UserProfile model.
//     * If creation is successful, the browser will be redirected to the 'view' page.
//     * @return mixed
//     */
//    public function actionCreate()
//    {
//        $model = new UserProfile();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        return $this->render('create', [
//            'model' => $model,
//        ]);
//    }
//
//    /**
//     * Updates an existing UserProfile model.
//     * If update is successful, the browser will be redirected to the 'view' page.
//     * @param integer $id
//     * @return mixed
//     * @throws NotFoundHttpException if the model cannot be found
//     */
//    public function actionUpdate($id)
//    {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        return $this->render('update', [
//            'model' => $model,
//        ]);
//    }
//
//    /**
//     * Deletes an existing UserProfile model.
//     * If deletion is successful, the browser will be redirected to the 'index' page.
//     * @param integer $id
//     * @return mixed
//     * @throws NotFoundHttpException if the model cannot be found
//     */
//    public function actionDelete($id)
//    {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }
//
//    /**
//     * Finds the UserProfile model based on its primary key value.
//     * If the model is not found, a 404 HTTP exception will be thrown.
//     * @param integer $id
//     * @return UserProfile the loaded model
//     * @throws NotFoundHttpException if the model cannot be found
//     */
//    protected function findModel($id)
//    {
//        if (($model = UserProfile::findOne($id)) !== null) {
//            return $model;
//        }
//
//        throw new NotFoundHttpException('The requested page does not exist.');
//    }
    
    
    public function actionGetdistsbystateid()
    {
       // die("11111");
        $return['STATUS_ID']="111";   
        $return['STATUS_MSG']="FAILURE";
        $return['STATUS_RESPONSE']="Invalid Request";
        if((isset($_POST['state_id']) && !empty($_POST['state_id'])))   
        {
            $stateid = $_POST['state_id'];
            $html="There is no city in Database, Contact Admin";
            $STATUS_ID = "111";
            $USP_ExtractCity = Yii::$app->Utility->ExtractDistReg($stateid);
           // echo "<pre>"; print_r($USP_ExtractCity);die;
            if(!empty($USP_ExtractCity)){
                $html="<option value=''>Select District</option>";
                $STATUS_ID = "000";
                foreach($USP_ExtractCity as $USP_ExtractCityK=>$USP_ExtractCityV){
                    $dist_id = $USP_ExtractCityV['DistrictId'];
                    $dist_name = Yii::$app->Utility->getupperstring($USP_ExtractCityV['DistrictName']);
                    $html.="<option value='$dist_id'>$dist_name</option>";   
                }
                    //$html.="<option value='999'>Other</option>";   
        }
        $return['STATUS_ID']=$STATUS_ID;   
        $return['STATUS_MSG']="SUCCESS";
        $return['STATUS_RESPONSE']=$html;
         
        }

        echo json_encode($return); die;

    }
    
    
        public function actionGetcitiesbydistid()
    {
        $return['STATUS_ID']="111";   
        $return['STATUS_MSG']="FAILURE";
        $return['STATUS_RESPONSE']="Invalid Request";
        if((isset($_POST['dist']) && !empty($_POST['dist'])))   
        {
            $dist_id = $_POST['dist'];
            $html="There is no city in Database, Contact Admin";
            $STATUS_ID = "111";
            $USP_ExtractCityReg = Yii::$app->Utility->ExtractCityReg($dist_id);
           // echo "<pre>"; print_r($USP_ExtractCity);die;
            if(!empty($USP_ExtractCityReg)){
                $html="<option value=''>Select City</option>";
                $STATUS_ID = "000";
                foreach($USP_ExtractCityReg as $USP_ExtractCityRegK=>$USP_ExtractCityRegV){
                    $city_id = $USP_ExtractCityRegV['CityId'];
                    $city_name = Yii::$app->Utility->getupperstring($USP_ExtractCityRegV['CityName']);
                    $html.="<option value='$city_id'>$city_name</option>";   
                }
                    //$html.="<option value='999'>Other</option>";   
        }
        $return['STATUS_ID']=$STATUS_ID;   
        $return['STATUS_MSG']="SUCCESS";
        $return['STATUS_RESPONSE']=$html;
         
        }

        echo json_encode($return); die;

    }
    
}
