<?php
namespace app\modules\department\controllers;
use yii\web\Controller;
use Yii;
/**
 * Default controller for the `department` module
 */
class VisitorlistController extends Controller
{
	public function beforeAction($action)
	{
        if (!\Yii::$app->user->isGuest) 
		{
            if(isset($_GET['securekey']) AND !empty($_GET['securekey']))
			{
                $menuid = Yii::$app->Boutility->decryptString($_GET['securekey']);
				//echo $menuid ; die;
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
		$getVisitmembers= Yii::$app->Boutility->getUserRequestforVisit(null);
		$menuid = Yii::$app->Boutility->decryptString($_GET['securekey']);
        $menuid = Yii::$app->Boutility->encryptString($menuid);
		$this->layout = '@app/views/layouts/after_login.php';
        return $this->render('index',['getVisitmembers'=>$getVisitmembers,'menuid'=>$menuid]);
    }
	public function actionDetail()
    {
        if (\Yii::$app->user->isGuest) 
		{
            return $this->redirect(Yii::$app->homeUrl);
        }
		if(isset($_GET["requestid"]) && !empty($_GET["requestid"]))
		{
			$requestid=$_GET["requestid"];
			$getVisitmembers= Yii::$app->Boutility->getUserRequestforVisit($requestid);
		}
		//echo "<pre>";print_r($getVisitmembers); die;
		$menuid = Yii::$app->Boutility->decryptString($_GET['securekey']);
        $menuid = Yii::$app->Boutility->encryptString($menuid);
		$this->layout = '@app/views/layouts/after_login.php';
        return $this->render('detail',['getVisitmembers'=>$getVisitmembers,'menuid'=>$menuid]);
    }
}
