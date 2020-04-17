<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use Yii;

/**
 * Default controller for the `admin` module
 */
class ManageroleController extends Controller
{
	public function beforeAction($action)
	{
        if (!\Yii::$app->user->isGuest) 
		{
            if(isset($_GET['securekey']) AND !empty($_GET['securekey']))
			{
                $menuid = Yii::$app->Boutility->decryptString($_GET['securekey']);
				//echo $menuid; die;
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
		$roles= Yii::$app->Boutility->getRoles(null);
		$menuid = Yii::$app->Boutility->decryptString($_GET['securekey']);
        $menuid = Yii::$app->Boutility->encryptString($menuid);
		$this->layout = '@app/views/layouts/after_login.php';
        return $this->render('index',array('roles'=>$roles,'menuid'=>$menuid));
    }
	
	public function actionCreaterole()
	{
		if (\Yii::$app->user->isGuest) 
		{
            return $this->redirect(Yii::$app->homeUrl);
        }
		$menuid = Yii::$app->Boutility->decryptString($_GET['securekey']);
        $menuid = Yii::$app->Boutility->encryptString($menuid);
		$url  = Yii::$app->homeUrl."admin/managerole/index";
		$connection=   Yii::$app->db;
		if(isset($_POST) && !empty($_POST))
		{
			$transaction = $connection->beginTransaction();
			try 
			{
			//echo "<pre>";print_r($_POST); die;
			if(isset($_POST["rolename"]) && !empty($_POST["rolename"]) && isset($_POST["is_active"]) && !empty($_POST["is_active"]) )
			{
				$rolename=$_POST["rolename"];
				$is_active=$_POST["is_active"];
				//echo $is_active; die;
				$roleId= Yii::$app->Boutility->createRoles($rolename,$is_active);
				if($roleId)
				{
					$transaction->commit();
					$connection->close();
					Yii::$app->getSession()->setFlash('success', 'Department role successfully created'); 
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
        return $this->render('role',['menuid'=>$menuid]);
	}
}
