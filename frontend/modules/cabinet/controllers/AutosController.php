<?php

namespace app\modules\cabinet\controllers;

use app\models\AutoPhotoForm;
use common\controllers\AuthController;
use common\models\User;
use Yii;
use common\models\Autos;
use common\models\Aword;
use common\models\Campaign;
use frontend\components\Func;
use common\models\Search\AutoSearch;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use Imagine\Image\Point;
use common\models\AutoModel;
/**
 * AutosController implements the CRUD actions for Autos model.
 */
class AutosController extends AuthController
{


    /**
     * Lists all Autos models.
     * @return mixed
     */
    public $layout = 'cabinet';
    public function actionIndex()
    {
        $userid = Yii::$app->user->id;
        $myautos = Autos::find()->where(['auto_user_id' => $userid])->all();

        return $this->render('index', [
            'myautos' => $myautos,
        ]);
    }

    public function actionSearch()
    {
        $model = new AutoSearch();
        $dataProvider = $model->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=5;

        return $this->render('search', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Autos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $autouserid = $model->auto_user_id;
        $autousername = User::findOne($autouserid)->name;
        if (!$autousername) {
            $autousername = User::findOne($autouserid)->username;
        }
        $querycampaign = Campaign::find()->where(['user_id' => Yii::$app->user->id, 'status' => '0']);
        $campaignscount = $querycampaign->count();

        return $this->render('view', [
            'model' => $model,
            'autouserid' => $autouserid,
            'autousername' => $autousername,
            'querycampaign' => $querycampaign,
            'campaignscount' => $campaignscount
        ]);
    }

    /**
     * Creates a new Autos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Autos();
        $model->auto_user_id = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['create_adv', 'id' => $model->auto_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionVip($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['autos/']);
        } else {
            return $this->renderPartial('vip', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['create_adv', 'id' => $model->auto_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreate_adv($id){
        $model = $this->findModel($id);
        if($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['photo', 'id' => $model->auto_id]);
        }
        return $this->render("_form_step_2",['model' => $model, 'id' => $id]);
    }

    public function actionPhoto($id){
        $myauto = $this->findModel($id);
        $model = new AutoPhotoForm();

        if (Yii::$app->request->isPost) {
            $model->auto_image = UploadedFile::getInstance($model, 'auto_image');
            $model->auto_id = $id;

            //Бонусы
            $aword2 = Aword::find()->where(['user_id' => Yii::$app->user->id, 'view' => '2'])->count();
            if (!$aword2)
            {
                $touserid = Yii::$app->user->id;
                $fromuserid = '1';
                Func::reward($touserid, '2', '5');
                Func::bonus('5');
                Func::noty($touserid, $fromuserid, 'autos/view?id='.$model->auto_id, 'trophy', 'info', 'Новая награда', 'Вы получили награду за добавление своего первого автомобиля и 5 бонусных баллов.');
            }
            //Конец бонусам
            if ($model->upload()) {
                // file is uploaded successfully
                // Yii::$app->session->setFlash('success', 'Успешное добавление.');
                return $this->redirect(Url::to(['autos/']));
            }
        }

        return $this->render('_form_step_3', ['model' => $model, 'autoid' => $id, 'myauto' => $myauto]);
    }


    /*
     * Для отображения моделей после выбора марки автомобиля
     */
    public function actionLists($id)
    {
        $countmodels = AutoModel::find()->where(['mark_id' => $id])->count();
        $models = AutoModel::find()->where(['mark_id' => $id])->all();
        if ($countmodels > 0) {
            foreach($models as $model) {
                echo "<option value='".$model->id."'>".$model->name."</option>";
            }
        }
    }

    /*
     * Для выбора подходящего кузова автомобиля
     */
    public function actionChose($type, $id)
    {
        $model = $this->findModel($id);
        if ($model->auto_user_id == Yii::$app->user->id) {
            $model->auto_view = Html::encode($type);
            $model->save();
        }
        return $this->render("_form_step_2",['model' => $model, 'id' => $id]);
    }

    /**
     * Deletes an existing Autos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->id == $this->findModel($id)->auto_user_id) {
            $this->findModel($id)->delete();
            Yii::$app->session->setFlash('success', 'Автомобиль удален.');
        } else {Yii::$app->session->setFlash('danger', 'Автомобиль не найден.');}
        return $this->redirect(['index']);
    }

    /**
     * Finds the Autos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Autos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Autos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
