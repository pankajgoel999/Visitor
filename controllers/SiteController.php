<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        
        return $this->render('index');
    }
    
    public function actionRegistration()
    {
        
        return $this->render('registration');
    }
    
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
//        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }
@session_start();
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) ) {
               
       //  echo "<pre>"; print_r($_POST);print_r($_SESSION); die;
            
            $captcha = $_POST['LoginForm']['entercaptcha'];
			
			$session = $_SESSION['register_captcha'];
			$session = strtoupper($session);
// 			$captcha = strtoupper($captcha);
		
			$url = Yii::$app->homeUrl."site/login";
            
			if($session != $captcha){
				Yii::$app->getSession()->setFlash('danger', 'Invalid Captcha'); 
				return $this->redirect($url);
			}
           
            
            
            $secret='#_ZII_#';
            //require("PhpEncodeFormContents.inc.php");
           
            //$obj=new \PhpEncodeFormContents($secret);
            $LoginForm = $_POST['LoginForm'];
            //$post=$obj->decodeDataArray($LoginForm);
			$password = Yii::$app->Utility->DecryptPasswordToNormalData($secret,$LoginForm['password']);  
            $_POST['LoginForm']['password'] = $password;
            
            if($model->login()){
             //  echo "<pre>"; print_r(Yii::$app->user->identity); die("@@");
            
                if (Yii::$app->user->identity->Role_Id == "1" || Yii::$app->user->identity->Role_Id == "2")
				{
					$id = Yii::$app->Boutility->encryptString("2");
                    $url = Yii::$app->homeUrl."admin/default/index?securekey=$id"; 
							//echo $url; die;
                }else if (Yii::$app->user->identity->Role_Id == "4"){
                    
                   // die("12322");
                    $url = Yii::$app->homeUrl."publicvisitor";
                }else {
                    $url = Yii::$app->homeUrl."district";    
                }
				
			}else{
				Yii::$app->getSession()->setFlash('danger', 'Invalid Username/Password'); 
				$url = Yii::$app->homeUrl."site/login";
			}
          // echo $url; die;
            Yii::$app->Utility->insertlog();
			return  $this->redirect($url); 
            //return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        
        return $this->render('about');
    }
}
