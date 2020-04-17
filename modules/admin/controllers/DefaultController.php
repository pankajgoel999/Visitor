<?php
namespace app\modules\admin\controllers;
use yii\web\Controller;
use Yii;
/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
	public function beforeAction($action)
	{
		
        if (!\Yii::$app->user->isGuest) 
		{
            if(isset($_GET['securekey']) AND !empty($_GET['securekey']))
			{
                $menuid = Yii::$app->Boutility->decryptString($_GET['securekey']);
				
                if(empty($menuid))
				{ 
					return $this->redirect(Yii::$app->homeUrl); 
				}
                /*$chkValid = Yii::$app->Boutility->validate_url($menuid);
                if(empty($chkValid))
				{ 
					return $this->redirect(Yii::$app->homeUrl); 
				}*/
                return true;                
            }
			else
			{ 
				return $this->redirect(Yii::$app->homeUrl); 
			}
        }
		else
		{
            return $this->redirect(Yii::$app->homeUrl);
        }
        parent::beforeAction($action);
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
		if (\Yii::$app->user->isGuest) 
		{
            return $this->redirect(Yii::$app->homeUrl);
        }
		$menuid = Yii::$app->Boutility->decryptString($_GET['securekey']);
        $menuid = Yii::$app->Boutility->encryptString($menuid);
		$this->layout = '@app/views/layouts/after_login.php';
        return $this->render('/default/index',['menuid'=>$menuid]);
    }
	
	public function actionUsers()
    {
		if (\Yii::$app->user->isGuest) 
		{
            return $this->redirect(Yii::$app->homeUrl);
        }
		$users= Yii::$app->Boutility->getDepartmentuser(null,null);
		$menuid = Yii::$app->Boutility->decryptString($_GET['securekey']);
        $menuid = Yii::$app->Boutility->encryptString($menuid);
		$this->layout = '@app/views/layouts/after_login.php';
        return $this->render('userlist',array('users'=>$users,'menuid'=>$menuid));
    }
	public function actionRegistration()
	{
		if (\Yii::$app->user->isGuest) 
		{
            return $this->redirect(Yii::$app->homeUrl);
        }
		$menuid = Yii::$app->Boutility->decryptString($_GET['securekey']);
        $menuid = Yii::$app->Boutility->encryptString($menuid);
		$url  = Yii::$app->homeUrl."admin/default/registration";
		$connection=   Yii::$app->db;
		if(isset($_POST) && !empty($_POST))
		{
			$transaction = $connection->beginTransaction();
			try 
			{
			//echo "<pre>";print_r($_POST); die;
			if(isset($_POST["dname"]) && !empty($_POST["dname"]) && isset($_POST["demail"]) && !empty($_POST["demail"]) && isset($_POST["dcontactno"]) && !empty($_POST["dcontactno"]) && isset($_POST["address"]) && !empty($_POST["address"]) && isset($_POST["nodalname"]) && !empty($_POST["nodalname"]) && isset($_POST["nodalemail"]) && !empty($_POST["nodalemail"]) && isset($_POST["nodalno"]) && !empty($_POST["nodalno"]) && isset($_POST["roles"]) && !empty($_POST["roles"]))
			{
				$dname=$_POST["dname"];
				$demail=$_POST["demail"];
				$dcontactno=$_POST["dcontactno"];
				$address=$_POST["address"];
				$nodalname=$_POST["nodalname"];
				$nodalemail=$_POST["nodalemail"];
				$nodalno=$_POST["nodalno"];
				$roles=$_POST["roles"];
				$empcode=$_POST["empcode"];
				$designation=$_POST["designation"];
				$password= md5($_POST["password"]);
				$userId= Yii::$app->Boutility->createDeptUser($demail,$roles,$password);
				if($userId)
				{
					$data= Yii::$app->Boutility->createDeptuserindepartmenttable($dname,$demail,$dcontactno,$address,$nodalname,$nodalemail,$nodalno,$empcode,$designation,$userId);
					//echo $data; die;
					if($data)
					{
						$transaction->commit();
						$connection->close();
						Yii::$app->getSession()->setFlash('success', 'Department user successfully created'); 
						return $this->redirect($url);
					}
					else
					{
						$transaction->rollBack();
						$connection->close();
					}
				}
				else
				{
					$transaction->rollBack();
				}
			}
			else
			{
				Yii::$app->getSession()->setFlash('danger', 'Error...........'); 
                return $this->redirect($url);
			}			
			}
			catch(\Exception $e) 
			{
				$transaction->rollBack();
				throw $e;
			}
			
			
		}
		
		$this->layout = '@app/views/layouts/after_login.php';
        return $this->render('registration',['menuid'=>$menuid]);
	}
}
