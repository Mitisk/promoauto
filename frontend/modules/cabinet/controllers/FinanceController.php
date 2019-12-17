<?php

namespace app\modules\cabinet\controllers;

use common\models\User;
use Yii;
use common\models\Finance;
use yii\data\Pagination;
use common\controllers\AuthController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;

/**
 * FinanceController implements the CRUD actions for Finance model.
 */
class FinanceController extends AuthController
{
    /**
     * @inheritdoc
     */
    public $layout = 'cabinet';
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
     * Lists all Finance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $historys = Finance::find()->where(['user_id' => Yii::$app->user->id, 'result' => ['0', '1', '2']])->orderBy(['id' => SORT_DESC]);
        $counthistorys = clone $historys;
        $pages = new Pagination(['totalCount' => $counthistorys->count(), 'pageSize' => 5]);
        $history = $historys->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'history' => $history,
            'pages' => $pages
        ]);
    }

    public function actionPromo()
    {
        $promocode =  trim(Yii::$app->request->post('promocode'));
        $findcode = Finance::find()->where(['user_id' => Yii::$app->user->id, 'promo' => $promocode, 'result' => '3'])->one();
        $findcodeforall = Finance::find()->where(['user_id' => '0', 'promo' => $promocode, 'result' => '3'])->one();
        $findcodeforalluse = Finance::find()->where(['user_id' => Yii::$app->user->id, 'promo' => $promocode, 'result' => ['0', '1', '2']])->one();
        if ($findcode) {
            $findcode->result = '2';
            $findcode->save();
            $user = Yii::$app->user->identity;
            $user->balance += $findcode->summ;
            $user->save();
            Yii::$app->session->setFlash('success', 'Промокод &laquo;' . $promocode . '&raquo; успешно применен.');
        } elseif ($findcodeforall and !$findcodeforalluse) {
            $user = Yii::$app->user->identity;
            $newpromostring = new Finance();
            $newpromostring->user_id = $user->id;
            $newpromostring->action = 'promo';
            $newpromostring->promo = $findcodeforall->promo;
            $newpromostring->summ = $findcodeforall->summ;
            $newpromostring->method = 'promoaction';
            $newpromostring->result = '2';
            $newpromostring->save();
            $user->balance += $newpromostring->summ;
            $user->save();
            Yii::$app->session->setFlash('success', 'Промокод &laquo;' . $promocode . '&raquo; успешно применен.');
        } else {
            Yii::$app->session->setFlash('danger', 'Промокод &laquo;' . $promocode . '&raquo; не найден.');
        }
        return $this->redirect('index');
    }

    public function actionWithdrawal ($method) {
        $model = new Finance();
        $model->user_id = Yii::$app->user->id;
        $model->action = 'withdrawal';
        $model->method = Html::encode($method);
        $model->result = '1';
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $balance_user = User::findOne(Yii::$app->user->id);
            $balance_user->balance -= $model->summ;
            $balance_user->save();
            Yii::$app->session->setFlash('success', 'Заявка на вывод принята.');
            return $this->redirect(['index']);
        } else {
            return $this->render('withdrawal', [
                'model' => $model,
                'method' => $method,
            ]);
        }
    }

    public function actionReplenishment ($method) {
        $model = new Finance();
        $model->user_id = Yii::$app->user->id;
        $model->action = 'replenishment';
        $model->method = Html::encode($method);
        $model->result = '1';
        $model->card_number = 'id'.Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Заявка на пополнение принята.');
            return $this->redirect(['index']);
        } else {
            return $this->render('replenishment', [
                'model' => $model,
                'method' => $method,
            ]);
        }
    }

    /**
     * Displays a single Finance model.
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
     * Creates a new Finance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Finance();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Finance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
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
     * Deletes an existing Finance model.
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
     * Finds the Finance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Finance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Finance::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
