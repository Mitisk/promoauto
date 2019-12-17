<?php

namespace app\modules\cabinet\controllers;

use Yii;
use common\models\AutoAdvertPlace;
use yii\data\ActiveDataProvider;
use common\controllers\AuthController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PlaceController implements the CRUD actions for AutoAdvertPlace model.
 */
class PlaceController extends AuthController
{
    /**
     * @inheritdoc
     */
    public $layout = 'clear';
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AutoAdvertPlace models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => AutoAdvertPlace::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AutoAdvertPlace model.
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
     * Creates a new AutoAdvertPlace model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id, $side, $place, $point)
    {
        $model = new AutoAdvertPlace();
        $model->auto_id = $id;
        $model->side = $side;
        $model->place = $place;
        $model->point = $point;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['autos/create_adv', 'id' => $model->auto_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AutoAdvertPlace model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['autos/create_adv', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AutoAdvertPlace model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id, $side, $place)
    {
        AutoAdvertPlace::find()->where(['auto_id' => $id, 'side' => $side, 'place' => $place, ])->one()->delete();
        return $this->redirect(['autos/create_adv']);
    }

    /**
     * Finds the AutoAdvertPlace model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AutoAdvertPlace the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AutoAdvertPlace::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
