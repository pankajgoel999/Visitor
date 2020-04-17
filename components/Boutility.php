<?php
namespace app\components;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\db\Query;
use yii\web\Session;
use app\models\LoginLog;
use yii\db\mssql\PDO;
class Boutility extends Component 
{
	public function backoffice_left_menu()
	{
		//echo Yii::$app->user->identity->Role_Id;die;
        $connection=   Yii::$app->db;
        $connection->open();
        $sql ="SELECT * FROM menu_mapping a, master_menu b WHERE a.role_id = :role_id  AND a.is_active = 'Y'  AND b.menuid=a.menuid  AND b.is_active='Y' ";
        $command = $connection->createCommand($sql); 
        $command->bindValue(':role_id', Yii::$app->user->identity->Role_Id);
        $result=$command->queryAll();
        $connection->close();
		return $result;
    }   
	public function validate_url($param_menuid)
	{
		//echo $param_menuid; die;
        if (\Yii::$app->user->isGuest) 
		{
            return false;
        }
        if(!isset(Yii::$app->user->identity->Role_Id))
		{
            return false;
        }
        /*
        * Check authKey
        */
	   /* $cookies = Yii::$app->request->cookies;
	    $oldCookie = \md5(Yii::$app->user->identity->authKey);
	    $IrrigationCookie = $cookies->getValue('IrrigationCookie');
	    if($oldCookie != $IrrigationCookie)
		{
		   $cookies = Yii::$app->response->cookies;
		   $cookies->remove('IrrigationCookie');
		   Yii::$app->utility->activities_logs("Logout", NULL, '{"message":"Someone tried to change cookie / session."}', "Someone tried to change cookie / session.");
		   Yii::$app->user->logout();
		   return false;
	    }
        */
        $role=Yii::$app->user->identity->Role_Id;
        $connection=   Yii::$app->db;
        $connection->open();
        $sql ="SELECT b.* FROM menu_mapping a, master_menu b WHERE a.menuid = Param_menuid  AND a.role_id = Param_role_id AND a.is_active = 'Y' AND b.is_active = 'Y' AND a.menuid = b.menuid ";
        $command = $connection->createCommand($sql); 
        $command->bindValue(':param_menuid', $param_menuid); 
        $command->bindValue(':param_role_id', $role); 
        $result=$command->queryOne();

        $result1 = false;
        $module=Yii::$app->controller->module->id;
        $controller=Yii::$app->controller->id;
        
        if($controller == 'dashboard' AND $param_menuid == '2')
		{
            return true;
        }
		elseif(!empty($result))
		{
            $checkUrl = Yii::$app->utility->get_master_menu($param_menuid, NULL, NULL);
            $url = explode('/', $checkUrl['menu_url']);
            if($module == 'MicroIrrigation'){
                if($controller == $url[0]){
                    $result1 = true;
                }elseif($controller == 'site'){
                    $result1 = true;
                }
            }else{
                $m = $url[0];
                $c = @$url[1];
                if($module == $m AND $controller == $c){
                    $result1 = true;
                }else{
                    $result1 = false;
                }
            }
        }return $result1;
    }
	/*
    * Encrypt String
    * @ Send encrypted String for decrypt
    */
    public function encryptString($encrypt)
	{
        $string = base64_encode($encrypt);
        $key = Encrypt_Key;
        if(isset(Yii::$app->user->identity) AND !empty(Yii::$app->user->identity))
		{
            if(!empty(Yii::$app->user->identity->Role_Id))
			{
				$key = $key.Yii::$app->user->identity->Role_Id;
            }
        }
        $encrypted = base64_encode(Yii::$app->security->encryptByKey($string, $key));
        $encrypted = rawurlencode($encrypted);
        return $encrypted;
    }

    /*
    * Decrypt String
    * @ Send encrypted String for decrypt
    */

    public function decryptString($string)
	{
        $string = rawurldecode($string);
        $key = Encrypt_Key;
        if(isset(Yii::$app->user->identity) AND !empty(Yii::$app->user->identity))
		{
            if(!empty(Yii::$app->user->identity->Role_Id))
			{
				$key = $key.Yii::$app->user->identity->Role_Id;
            }
        }
        $decrypted = Yii::$app->security->decryptByKey(base64_decode($string), $key);
        $decrypted = base64_decode($decrypted);
        return $decrypted;
    }
	public function getYesorNO($y)
	{
		$isactive="No";
		if($y=="Y")
		{
			$isactive="Yes";
		}
		return $isactive;
	}
	public function getDepartmentuser($emailID,$userId)
	{
		$is_active="Y";
		$connection=   Yii::$app->db;
        $connection->open();
        if(!empty($emailID) || !empty($userId)  )
		{
			$sql ="SELECT * FROM users as us inner join department_user_master as duser on duser.user_id=us.user_id where us.is_active= :is_active AND ( us.user_id=:userId OR duser.dept_email=:emailID )";
			$command = $connection->createCommand($sql); 
			$command->bindValue(':userId', $userId);
			$command->bindValue(':emailID', $emailID);
			$command->bindValue(':is_active', $is_active);
            $result=$command->queryOne();
        }
		else
		{
			$sql ="SELECT * FROM users as us inner join department_user_master as duser on duser.user_id=us.user_id where us.is_active= :is_active";
			$command = $connection->createCommand($sql); 
			$command->bindValue(':is_active', $is_active);
            $result=$command->queryAll();
        }
		$connection->close();
        return $result;  
	}
	public function getWapons_detail($ReqID)
	{
		$is_active="Y";
		$connection=   Yii::$app->db;
        $connection->open();
        if(!empty($ReqID) )
		{
			$sql ="SELECT * FROM `weapons_detail`  WHERE  request_id=:request_id";
			$command = $connection->createCommand($sql); 
			$command->bindValue(':request_id', $ReqID);
            $result=$command->queryAll();
        }
		else
		{
			$sql ="SELECT * FROM `weapons_detail` ";
			$command = $connection->createCommand($sql); 
            $result=$command->queryAll();
        }
		$connection->close();
        return $result;  
	}
	public function getVisit_members($ReqID)
	{
		$is_active="Y";
		$connection=   Yii::$app->db;
        $connection->open();
        if(!empty($ReqID) )
		{
			$sql ="SELECT * FROM `visit_members`  WHERE  request_id=:request_id";
			$command = $connection->createCommand($sql); 
			$command->bindValue(':request_id', $ReqID);
            $result=$command->queryAll();
        }
		else
		{
			$sql ="SELECT * FROM `visit_members` ";
			$command = $connection->createCommand($sql); 
            $result=$command->queryAll();
        }
		$connection->close();
        return $result;  
	}
	public function getSingleVisitmembersinfo($memID)
	{
		$connection=   Yii::$app->db;
        $connection->open();
        if(!empty($memID) )
		{
			$sql ="SELECT * FROM `visit_members`  WHERE  id=:memID";
			$command = $connection->createCommand($sql); 
			$command->bindValue(':memID', $memID);
            $result=$command->queryOne();
        }
		$connection->close();
        return $result;  
	}
	public function getStatus()
	{
		$connection=   Yii::$app->db;
        $connection->open();
		$is_active="Y";
		$sql ="SELECT * FROM `master_status`  WHERE  is_active=:is_active";
		$command = $connection->createCommand($sql); 
		$command->bindValue(':is_active', $is_active);
		$result=$command->queryAll();
		$connection->close();
        return $result;  
	}
	public function getUserRequestforVisit($rid)
	{
		$is_active="Y";
		$connection=   Yii::$app->db;
        $connection->open();
		$roleid=4;
		if(empty($rid))
		{
			$sql ="SELECT *,rm.id as request_id FROM `users` as user inner join user_profile as up ON up.user_id=user.user_id inner join request_master as rm ON rm.user_id=up.user_id WHERE user.Role_Id=:roleid";
			$command = $connection->createCommand($sql); 
			$command->bindValue(':roleid', $roleid);
			$result=$command->queryAll();
		}
		else
		{
			$sql ="SELECT *,rm.id as request_id FROM `users` as user inner join user_profile as up ON up.user_id=user.user_id inner join request_master as rm ON rm.user_id=up.user_id WHERE user.Role_Id=:roleid AND rm.id=:rid";
			$command = $connection->createCommand($sql); 
			$command->bindValue(':roleid', $roleid);
			$command->bindValue(':rid', $rid);
			$result=$command->queryAll();
		}
		$connection->close();
        return $result;  
	}
	
	
    public function getRoles($roleID)
	{
		$is_active="Y";
		$connection=   Yii::$app->db;
        $connection->open();
        if(!empty($roleID) )
		{
			$sql ="SELECT * FROM `roles` WHERE `is_active` = :is_active AND role_id=:role_id";
			$command = $connection->createCommand($sql); 
			$command->bindValue(':role_id', $roleID);
			$command->bindValue(':is_active', $is_active);
            $result=$command->queryOne();
        }
		else
		{
			$sql ="SELECT * FROM `roles`";
			$command = $connection->createCommand($sql); 
			//$command->bindValue(':is_active', $is_active);
            $result=$command->queryAll();
        }
		$connection->close();
        return $result;  
	}
	public function createDeptuserindepartmenttable($dname,$demail,$dcontactno,$address,$nodalname,$nodalemail,$nodalno,$empcode,$designation,$userId)
	{
		$connection=   Yii::$app->db;
        //$connection->open();
		$currentdate=date("Y-m-d H:i:s");
		$is_active="Y";
		$sql ="INSERT INTO department_user_master (dept_name, dept_email,dept_contactno, dept_address,officer_fname,officer_mobile,officer_email,officer_emp_code,officer_designation,user_id ,date_created, is_active) VALUES (:dname,:demail,:dept_contactno,:address,:nodalname,:nodalno,:nodalemail,:empcode,:designation,:userId,:currentdate, :is_active)";
		$command = $connection->createCommand($sql); 
		$command->bindValue(':dname', $dname);
		$command->bindValue(':demail', $demail);
		$command->bindValue(':dept_contactno', $dcontactno);
		$command->bindValue(':address', $address);
		$command->bindValue(':nodalname', $nodalname);
		$command->bindValue(':nodalno', $nodalno);
		$command->bindValue(':nodalemail', $nodalemail);
		$command->bindValue(':empcode', $empcode);
		$command->bindValue(':designation', $designation);
		$command->bindValue(':userId', $userId);
		$command->bindValue(':currentdate', $currentdate);
		$command->bindValue(':is_active', $is_active);
		$result=$command->execute();
		return $result;		
	}
	public function createDeptUser($demail,$roles,$password)
	{
		$connection=   Yii::$app->db;
        $connection->open();
		$currentdate=date("Y-m-d H:i:s");
		$is_active="Y";
		$sql ="INSERT INTO users (username, password, Role_Id, date_modified, is_active) VALUES (:demail, :password, :roles, :currentdate, :is_active)";
		$command = $connection->createCommand($sql); 
		$command->bindValue(':demail', $demail);
		$command->bindValue(':password', $password);
		$command->bindValue(':roles', $roles);
		$command->bindValue(':currentdate', $currentdate);
		$command->bindValue(':is_active', $is_active);
		$command->execute();
		$result=$connection->getLastInsertId();
		return $result;
	}
	public function createRoles($rolename,$is_active)
	{
		$connection=   Yii::$app->db;
        $connection->open();
		$currentdate=date("Y-m-d H:i:s");
		$sql ="INSERT INTO roles ( role_name,is_active, date_modi ) VALUES (:rolename, :is_active,:currentdate)";
		$command = $connection->createCommand($sql); 
		$command->bindValue(':rolename', $rolename);
		$command->bindValue(':is_active', $is_active);
		$command->bindValue(':currentdate', $currentdate);
		$command->execute();
		$result=$connection->getLastInsertId();
		return $result;
	}

}
    
