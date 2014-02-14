<?php

class TempTrainStatusController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
//	public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('create', 'delete','loadData'),
                'users' => array('hexatrip'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

   
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionLoadData() {

        $model = new TempTrainStatus;

         //Only post data allowed
        if (!isset($_POST['TempTrainStatus'])) {
            //render the page 
        $this->render('create', array(
            'model' => $model,
        ));
            return true;
        }
        
        //Save all the posted data to temp train status table 
         TempTrainStatus::model()->deleteAll(); //remove all other data from it 
         foreach ($_POST['TempTrainStatus'] as $key => $posted_row) {
                $model = new TempTrainStatus;
                $model->attributes = $posted_row;               
                if (!$model->save()) {
                    Yii::app()->user->setFlash('error', "Could not save the data");
                }
         }
        
          //getting all the active alerts with train status ON , where something has changed in train options
            $sql = "  select x.id as alert_id,y.* from alert as x join
                                temp_train_status as y 
                                on x.location_from = y.location_from and x.location_to = y.location_to     
                                 where x.status=1 and
                                 x.train = 1  
                                 and y.available < x.train_avail_min  
                                 and y.date < x.date_to";
            $output = Yii::app()->db->createCommand($sql)->queryAll();
            $alert_ids = array();
            foreach ($output as $key => $value) {
                $alert_ids[] = $value['alert_id'];
            }
            
            //remove duplicate entries
            $alert_ids = array_unique($alert_ids);
            
            //now we found the changed alerts - update them to the status table
            foreach ($alert_ids as $alert_id) {

                $criteria = new CDbCriteria;
                $criteria->condition = "alert_id = $alert_id";

                if (($modelAlertStatus = AlertStatus::model()->find($criteria)) === null) {
                    $modelAlertStatus = new AlertStatus;
                }
                $modelAlertStatus->alert_id = $alert_id;
                $modelAlertStatus->train_avail_alert = 1;
                if (!$modelAlertStatus->save()) {
                    Yii::app()->user->setFlash('error', "Some error occured for alert id: $alert_id");
                };
            }
            Yii::app()->user->setFlash('success', "Success! Data Saved");
 
       //render the page 
        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return TempTrainStatus the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = TempTrainStatus::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}
