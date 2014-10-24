<?php

Yii::import('application.controllers.BaseController');

class UserController extends BaseController {

    public $headerTitle;

    public function actionIndex() {
        $this->headerTitle = "Quản lý người dùng";
        $this->render('index');
    }

    public function actionSignup() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;

        if ($request->isPostRequest && isset($_POST)) {
            try {
                $user_email = Yii::app()->request->getPost('user_email');
                $user_password = Yii::app()->request->getPost('user_password');
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
                    $new_user->user_active = 1;

                    if ($new_user->save(FALSE)) {
                        $this->retVal->message = Yii::app()->params['SIGNUP_MESSAGE_SUCCESS'];
                        $this->retVal->success = TRUE;
                        $this->retVal->message_data = $message;
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

        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $user_email = Yii::app()->request->getPost('user_email');
                $user_password = Yii::app()->request->getPost('user_password');
                $user = User::model()->findByAttributes(array('user_email' => $user_email));
                if ($user) {
                    if ($user->user_active == 0) {
                        $this->retVal->message = Yii::app()->params['USER_NOT_ACTIVATE'];
                        $this->retVal->success = FALSE;
                    } else {
                        //user existed, check password
                        if ($user->user_password == md5($user_password)) {
                            //token
                            $token = StringHelper::generateToken(16, 36);
                            $user->user_token = $token;
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
                            $this->retVal->success = FALSE;
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

//    public function actionAddDummyData() {
//        $datas = array('Nguyễn Thế Huy', 'Nguyễn Đức Thịnh', 'Phan Duy Thành', 'Nguyễn Thạc Thống', 'Ngô Anh Long', 'Phùng Nguyên Ngọc', 'Phạm Duy Thiện', 'Nguyễn Văn Lượng');
//        $ids = array('3', '4', '5', '6');
//        foreach ($ids as $id) {
//            foreach ($datas as $data) {
//                $user = new User;
//                $user->user_name = $data;
//
//                $root = User::model()->findByPk($id);
//                $user->appendTo($root);
//            }
//        }
//    }

    public function actionGetAllTree() {
        $this->retVal = new stdClass();
        $tree = User::model()->findAll(array('order' => 'lft'));
        $this->retVal->tree = $tree;
        echo CJSON::encode($this->retVal);
        $this->render('getalltree');
    }

    public function actionGetAllRoots() {
        $this->retVal = new stdClass();
        $roots = User::model()->roots()->findAll();
        $this->retVal->roots = $roots;
        echo CJSON::encode($this->retVal);
        $this->render('getallroots');
    }

    public function actionGetChildOfRootById() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $root = Yii::app()->request->getPost('root');
                $users = User::model()->findByPk($root);
                $descendants = $users->children()->findAll();
                $this->retVal->data = $descendants;
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }

        $this->render('getchildofrootbyid');
    }

    public function actionGetChildOfRootByName() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $root = Yii::app()->request->getPost('root');
                $users = User::model()->findByAttributes(array('user_name' => $root));
                $descendants = $users->children()->findAll();
                $this->retVal->data = $descendants;
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }

        $this->render('getchildofrootbyname');
    }

    public function actionGetParentOfNodeById() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $node = Yii::app()->request->getPost('node');
                $node_data = User::model()->findByPk($node);
                $parent = $node_data->parent()->findAll();
                $this->retVal->data = $parent;
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }

        $this->render('getparentofnodebyid');
    }

    public function actionGetParentOfNodeByName() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $node = Yii::app()->request->getPost('node');
                $node_data = User::model()->findByAttributes(array('user_name' => $node));
                $parent = $node_data->parent()->findAll();
                $this->retVal->data = $parent;
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }

        $this->render('getparentofnodebyname');
    }

    public function actionGetNodeNextSiblingById() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $node = Yii::app()->request->getPost('node');
                $user = User::model()->findByPk($node);
                $nextSibling = $user->nextSibling()->findAll();
                $this->retVal->data = $nextSibling;
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }

        $this->render('getnodenextsiblingbyid');
    }

    public function actionGetNodePrevSiblingById() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $node = Yii::app()->request->getPost('node');
                $user = User::model()->findByPk($node);
                $prevSibling = $user->prevSibling()->findAll();
                $this->retVal->data = $prevSibling;
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }

        $this->render('getnodeprevsiblingbyid');
    }

    public function getNodeById() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $node = Yii::app()->request->getPost('node');
                $user = User::model()->findByPk($node);
                $this->retVal->data = $user;
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }

        $this->render('getnodebyid');
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
