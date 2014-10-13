<?php

Yii::import('application.controllers.BaseController');

class MessageController extends BaseController {

    public $headerTitle;

    public function actionIndex() {
        $this->headerTitle = "Message History";
        $this->render('index');
    }

    public function actionHistory() {

        $message = Message::model()->findAll();

        $this->render('history', array('message' => CJSON::encode($message)));
    }

    public function actionGetMessageByUser() {
        $criteria = new EMongoCriteria;

        // find the single user with the personal_number == 12345
        $criteria->from('==', $_POST["user_name"]);
        $message_from = Message::model()->findAll($criteria);
        $this->render('GetMessageFromUser', array('message_from' => CJSON::encode($message_from)));
    }

    public function actionGetMessageByDate() {
        $criteria = new EMongoCriteria;

        // find the single user with the personal_number == 12345
        $criteria->from('==', $_POST["message_date"]);
        $message_date = Message::model()->findAll($criteria);
        $this->render('GetMessageByDate', array('message_date' => CJSON::encode($message_date)));
    }

    public function actionInsertMessage() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;

        if ($request->isPostRequest && isset($_POST)) {
            try {
                $mesage_from = Yii::app()->request->getPost('message_from');
                $message_to = Yii::app()->request->getPost('message_to');
                $mesage_content = Yii::app()->request->getPost('message_content');
                $new_mess = new Message;
                $new_mess->from = $mesage_from;
                $new_mess->to = $message_to;
                $new_mess->message = $mesage_content;
                $new_mess->sent_date = date('m/d/Y h:i:s');

                $new_mess->save(FALSE);
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }
        $this->render('NewMessage');
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
