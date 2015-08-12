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
