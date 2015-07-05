<?php

namespace app\controllers;

use Yii;
use app\models\Solicitation;
use app\models\SolicitationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\SqlDataProvider;

/**
 * SolicitationController implements the CRUD actions for Solicitation model.
 */
class SolicitationController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Solicitation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SolicitationSearch();
        $searchModel->user_id = 0;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Solicitation model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Solicitation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Solicitation();

        $model->status_id = 1;
        $model->created = date('Y-m-d H:i:s');
        $model->ip = Yii::$app->getRequest()->getUserIP();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // Create the ID folder 
            $idfolder = $model->id;
            $idfolder = str_pad($idfolder, 6, "0", STR_PAD_LEFT); // add 0000+ID
            mkdir(Yii::getAlias('@upload')."/".$idfolder, 0777, true);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpload($id)
    {
        $model = $this->findModel($id);
       

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Solicitation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id); 

        if($model->status_id !== 98 && $model->status_id !== 99){
            $model->updated = date('Y-m-d H:i:s');
            $model->status_id = 4;
            $model->ip = Yii::$app->getRequest()->getUserIP();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            Yii::$app->session->setFlash("edit-erro", '<i class="fa fa-times"></i> Solicitante não possui permissão para alterar uma solicitação CANCELADA ou CONCLUÍDA!');
            return $this->render('update', [
                    'model' => $model,
                ]);
        }
    }

    /**
     * Deletes an existing Solicitation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    public function actionDashboard()
    {
        $searchModel = new SolicitationSearch();
        //$searchModel->user_id = 0;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('dashboard', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]); 
    }

    public function actionBy_location()
    {
        $model = new Solicitation();

        $thisyear  = date('Y');
        $thismonth = date('m');
        $lastmonth = date('m', strtotime('-1 months', strtotime(date('Y-m-d'))));    
        
        $url = Yii::$app->getRequest()->getQueryParam('mounth');
        $mounth = isset($url) ? $url : $thismonth;
        // Initial value of activeDropDownList
        $model->mounth = $mounth;

        $command = Yii::$app->db->createCommand(
        "SELECT nickname,
        SUM(IF(status_id = 1, 1,0)) as qt1,
        SUM(IF(status_id = 2, 1,0)) as qt2,
        SUM(IF(status_id = 3, 1,0)) as qt3,
        SUM(IF(status_id = 4, 1,0)) as qt4,
        SUM(IF(status_id = 98, 1,0)) as qt98,
        SUM(IF(status_id = 99, 1,0)) as qt99
        FROM tb_solicitation  
        INNER JOIN tb_location
        ON tb_solicitation.location_id = tb_location.id
        WHERE MONTH(tb_solicitation.created) = $mounth
        GROUP BY nickname");
        $by_location = $command->queryAll();
        
        $locations = array();
        $qt1 = array();
        $qt2 = array();
        $qt3 = array();
        $qt4 = array();
        $qt98 = array();
        $qt99 = array();
 
        for ($i = 0; $i < sizeof($by_location); $i++) {
           $locations[] = $by_location[$i]["nickname"];
           $qt1[] = (int) $by_location[$i]["qt1"];
           $qt2[] = (int) $by_location[$i]["qt2"];
           $qt3[] = (int) $by_location[$i]["qt3"];
           $qt4[] = (int) $by_location[$i]["qt4"];
           $qt98[] = (int) $by_location[$i]["qt98"];
           $qt99[] = (int) $by_location[$i]["qt99"];
        }
        return $this->render('by_location', [
            'model'=>$model,
            'locations' => $locations, 
            'qt1' => $qt1,
            'qt2' => $qt2,
            'qt3' => $qt3,
            'qt4' => $qt4,
            'qt98' => $qt98,
            'qt99' => $qt99,
            ]);  
    }
    public function actionBy_requester()
    {

        return $this->render('by_requester'); 
    }    
public function actionBy_analyst()
    {
        $model = new Solicitation();

        $thisyear  = date('Y');
        $thismonth = date('m');
        $lastmonth = date('m', strtotime('-1 months', strtotime(date('Y-m-d'))));    
        
        $url = Yii::$app->getRequest()->getQueryParam('mounth');
        $mounth = isset($url) ? $url : $thismonth;
      
        // Initial value of activeDropDownList
        $model->mounth = $mounth;

        $totalCount = Yii::$app->db->createCommand("SELECT 
        SUM(IF(status_id = 99, 1,0)) as quantidade
        FROM tb_solicitation  
        INNER JOIN user
        ON tb_solicitation.analyst_id = user.id
        WHERE MONTH(tb_solicitation.created) = $mounth")
            ->queryScalar();

        $dataProvider = new SqlDataProvider([
                    'sql' => "SELECT username,
                    SUM(IF(status_id = 99, 1,0)) as quantidade
                    FROM tb_solicitation  
                    INNER JOIN user
                    ON tb_solicitation.analyst_id = user.id
                    WHERE MONTH(tb_solicitation.created) = $mounth
                    GROUP BY username",
                    'totalCount' => 200,
                    'sort' =>false,
                    'key'  => 'username',
                    'pagination' => [
                        'pageSize' => 200,
                    ],
        ]);

        return $this->render('by_analyst',[
            'model'=>$model,
            'dataProvider'=> $dataProvider,
            'totalCount' => $totalCount
            ]); 
    }
    public function actionBy_status()
    {
        $model = new Solicitation();

        $thisyear  = date('Y');
        $thismonth = date('m');
        $lastmonth = date('m', strtotime('-1 months', strtotime(date('Y-m-d'))));    
        
        $url = Yii::$app->getRequest()->getQueryParam('mounth');
        $mounth = isset($url) ? $url : $thismonth;
        // Initial value of activeDropDownList
        $model->mounth = $mounth;

        $command = Yii::$app->db->createCommand(
        "SELECT
            SUM(IF(status_id = 1, 1,0)) as aguardando,
            SUM(IF(status_id = 2, 1,0)) as andamento,
            SUM(IF(status_id = 3, 1,0)) as pendencia,
            SUM(IF(status_id = 4, 1,0)) as alterado,
            SUM(IF(status_id = 98, 1,0)) as cancelado,
            SUM(IF(status_id = 99, 1,0)) as concluido
        FROM tb_solicitation  
        WHERE MONTH(tb_solicitation.created) = $mounth");
        $by_status = $command->queryAll();
        
        $aguardando = array();
        $andamento = array();
        $pendencia = array();
        $alterado = array();
        $cancelado = array();
        $concluido = array();
 
        for ($i = 0; $i < sizeof($by_status); $i++) {
           $aguardando[] = (int) $by_status[$i]["aguardando"];
           $andamento[] = (int) $by_status[$i]["andamento"];
           $pendencia[] = (int) $by_status[$i]["pendencia"];
           $alterado[] = (int) $by_status[$i]["alterado"];
           $cancelado[] = (int) $by_status[$i]["cancelado"];
           $concluido[] = (int) $by_status[$i]["concluido"];
        }

        return $this->render('by_status',[
                    'model'=>$model,
                    'aguardando'=> $aguardando,
                    'andamento' => $andamento,                    
                    'pendencia'=> $pendencia,
                    'alterado' => $alterado,                   
                    'cancelado'=> $cancelado,
                    'concluido' => $concluido,
                    ]);
    }      


    /**
     * Finds the Solicitation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Solicitation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Solicitation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('A pagina solicitada não existe ou você não possui permissão para visualizar!');
        }
    }
}
