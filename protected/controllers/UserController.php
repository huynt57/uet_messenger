<?php

Yii::import('application.controllers.BaseController');

class UserController extends BaseController {

    public $headerTitle;

    public function actionIndex() {
        $this->headerTitle = "Quản lý người dùng";
        $this->render('index');
    }

    public function actionSignup() {
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $user_email = StringHelper::filterString(Yii::app()->request->getPost('user_email'));
                $user_password = StringHelper::filterString(Yii::app()->request->getPost('user_password'));
                //check if user is existed or not
                $user = User::model()->findByAttributes(array('user_email' => $user_email));
                if ($user) {
                    $this->retVal->data = $user;
                    $this->retVal->message = Yii::app()->params['USER_EXISTED'];
                    $this->retVal->success = TRUE;
                } else {
                    $token = StringHelper::generateToken(16, 36);
                    $new_user = new User;
                    $new_user->user_email = $user_email;
                    $new_user->user_password = md5($user_password);
                    $new_user->user_token = $token;
                    $new_user->user_active = 0;

                    if ($new_user->save()) {
                        $this->retVal->message = Yii::app()->params['SIGNUP_MESSAGE_SUCCESS'];
                        $this->retVal->success = TRUE;
                    } else {
                        $this->retVal->message = Yii::app()->params['SIGNUP_MESSAGE_FAIL'];
                        $this->retVal->success = FALSE;
                    }
                }
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }
        $this->render('signup');
    }

    public function actionLogin() {
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $user_email = StringHelper::filterString(Yii::app()->request->getPost('user_email'));
                $user_password = StringHelper::filterString(Yii::app()->request->getPost('user_password'));
                $user = User::model()->findByAttributes(array('user_email' => $user_email));
                if ($user) {
                    if ($user->user_active == 0) {
                        $this->retVal->message = Yii::app()->params['USER_NOT_ACTIVATE'];
                        ;
                        $this->retVal->success = FALSE;
                    } else {
                        //user existed, check password
                        if (strcmp($user->user_password, md5($user_password) == 0)) {
                            //token
                            $token = StringHelper::generateToken(16, 36);
                            $user->token = $token;
                            $user->save(FALSE);
                            if ($user->save(FALSE)) {
                                $this->retVal->message = Yii::app()->params['LOGIN_MESSAGE_SUCCESS'];
                                $this->retVal->data = $user;
                                $this->retVal->token = $token;
                                $this->retVal->success = TRUE;
                            } else {
                                $this->retVal->message = Yii::app()->params['LOGIN_MESSAGE_FAIL'];
                                $this->retVal->success = FALSE;
                            }
                        } else {
                            //wrong device token
                            $this->retVal->message = Yii::app()->params['WRONG_PASSWORD'];
                            $this->retVal->success = TRUE;
                        }
                    }
                } else {
                    //user not existed
                    $this->retVal->message = Yii::app()->params['USER_NOT_EXIST'];
                    $this->retVal->success = FALSE;
                }
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }

        $this->render('login');
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}
