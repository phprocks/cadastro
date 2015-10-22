<?php

namespace app\controllers;

use Yii;
use app\models\Report;
use app\models\ReportSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\SqlDataProvider;

/**
 * ReportController implements the CRUD actions for Report model.
 */
class ReportController extends Controller
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
     * Lists all Report models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Report model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Report model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Report();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Report model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
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
     * Deletes an existing Report model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Report model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Report the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Report::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionBy_location()
    {
        $model = new Report();

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
        $model = new Report();

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
        WHERE MONTH(tb_solicitation.closed) = $mounth")
            ->queryScalar();

        $dataProvider = new SqlDataProvider([
                    'sql' => "SELECT username,
                    SUM(IF(status_id = 99, 1,0)) as quantidade
                    FROM tb_solicitation  
                    INNER JOIN user
                    ON tb_solicitation.analyst_id = user.id
                    WHERE MONTH(tb_solicitation.closed) = $mounth
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
        $model = new Report();

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
    public function actionBy_type()
    {
        $model = new Report();

        $thisyear  = date('Y');
        $thismonth = date('m');
        $lastmonth = date('m', strtotime('-1 months', strtotime(date('Y-m-d'))));    
        
        $url = Yii::$app->getRequest()->getQueryParam('mounth');
        $mounth = isset($url) ? $url : $thismonth;
        // Initial value of activeDropDownList
        $model->mounth = $mounth;

        $command = Yii::$app->db->createCommand(
        "SELECT
            SUM(IF(typesolicitation_id = 1, 1,0)) as Cadastro,
            SUM(IF(typesolicitation_id = 2, 1,0)) as Correcao,
            SUM(IF(typesolicitation_id = 3, 1,0)) as Renovacao,
            SUM(IF(typesolicitation_id = 4, 1,0)) as Regularizacao
        FROM tb_solicitation  
        WHERE MONTH(tb_solicitation.created) =  $mounth");
        $by_type = $command->queryAll();
        
        $Cadastro = array();
        $Correcao = array();
        $Renovacao = array();
        $Regularizacao = array();
 
        for ($i = 0; $i < sizeof($by_type); $i++) {
           $Cadastro[] = (int) $by_type[$i]["Cadastro"];
           $Correcao[] = (int) $by_type[$i]["Correcao"];
           $Renovacao[] = (int) $by_type[$i]["Renovacao"];
           $Regularizacao[] = (int) $by_type[$i]["Regularizacao"];
        }

        return $this->render('by_type',[
                    'model'=>$model,
                    'Cadastro'=> $Cadastro,
                    'Correcao' => $Correcao,                    
                    'Renovacao'=> $Renovacao,
                    'Regularizacao' => $Regularizacao,
                    ]);
    }      

    public function actionDashboard()
    {
        $model = new Report();

        $thisyear  = date('Y');
        $thismonth = date('m');
        $lastmonth = date('m', strtotime('-1 months', strtotime(date('Y-m-d')))); 

        $url = Yii::$app->getRequest()->getQueryParam('year');
        $year = isset($url) ? $url : $thisyear;
        // Initial value of activeDropDownList
        $model->year = $year;

        $command = Yii::$app->db->createCommand("SELECT 
        COUNT(tb_solicitation.id) as quantity,
        MONTHNAME(tb_solicitation.created) as m 
        FROM tb_solicitation WHERE YEAR(tb_solicitation.created) = $year GROUP BY m ORDER BY MONTH(tb_solicitation.created)");
        $dashboard = $command->queryAll();
        
        $m = array();
        $quantity = array();
 
        for ($i = 0; $i < sizeof($dashboard); $i++) {
           $m[] = $dashboard[$i]["m"];
           $quantity[] = (int) $dashboard[$i]["quantity"];
        }
        return $this->render('dashboard', [
            'model'=>$model,
            'm' => $m, 
            'quantity' => $quantity,
            ]); 
    }
}
