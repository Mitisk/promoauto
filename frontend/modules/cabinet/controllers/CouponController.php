<?php

namespace app\modules\cabinet\controllers;

use common\controllers\AuthController;
use Yii;
use common\models\Coupon;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
/**
 * CouponController implements the CRUD actions for Coupon model.
 */
class CouponController extends AuthController
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
     * Lists all Coupon models.
     * @return mixed
     */
    public function actionIndex()
    {
        $cat = Yii::$app->request->get('cat');
        $userid = Yii::$app->user->id;
        if ($cat) {
            $coupons = Coupon::find()->where(['category' => $cat, 'visible' => '1'])->orderBy(['vip' => SORT_DESC, 'id' => SORT_DESC]);
            $couponscount = Coupon::find()->where(['category' => $cat, 'visible' => '1'])->count();
            $pages = new Pagination(['totalCount' => $couponscount, 'pageSize' => 8]);
            $pages->pageSizeParam = false;
            $coupons = $coupons->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        } else {
            $coupons = Coupon::find()->where(['visible' => '1'])->orderBy(['vip' => SORT_DESC, 'id' => SORT_DESC]);
            $couponscount = Coupon::find()->where(['visible' => '1'])->count();
            $pages = new Pagination(['totalCount' => $couponscount, 'pageSize' => 8]);
            $pages->pageSizeParam = false;
            $coupons = $coupons->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        }
        $catshop = Coupon::find()->where(['category' => 'shop', 'visible' => '1'])->count();
        $catfood = Coupon::find()->where(['category' => 'food', 'visible' => '1'])->count();
        $catservice = Coupon::find()->where(['category' => 'service', 'visible' => '1'])->count();
        $catfun = Coupon::find()->where(['category' => 'fun', 'visible' => '1'])->count();
        $catother = Coupon::find()->where(['category' => 'other', 'visible' => '1'])->count();
        $usercount = Coupon::find()->where(['user_id' => $userid])->count();

        return $this->render('index', [
            'coupons' => $coupons,
            'pages' => $pages,
            'cat' => $cat,
            'catshop' => $catshop,
            'catfood' => $catfood,
            'catservice' => $catservice,
            'catfun' => $catfun,
            'catother' => $catother,
            'usercount' => $usercount
        ]);
    }

    public function actionMy()
    {
        $cat = Yii::$app->request->get('cat');
        $userid = Yii::$app->user->id;
        if ($cat) {
            $coupons = Coupon::find()->where(['category' => $cat, 'user_id' => $userid])->orderBy(['vip' => SORT_DESC, 'recommend' => SORT_DESC, 'id' => SORT_DESC])->all();
        } else {
            $coupons = Coupon::find()->where(['user_id' => $userid])->orderBy(['vip' => SORT_DESC, 'recommend' => SORT_DESC, 'id' => SORT_DESC])->all();
        }
        $catshop = Coupon::find()->where(['category' => 'shop', 'user_id' => $userid])->count();
        $catfood = Coupon::find()->where(['category' => 'food', 'user_id' => $userid])->count();
        $catservice = Coupon::find()->where(['category' => 'service', 'user_id' => $userid])->count();
        $catfun = Coupon::find()->where(['category' => 'fun', 'user_id' => $userid])->count();
        $catother = Coupon::find()->where(['category' => 'other', 'user_id' => $userid])->count();

        return $this->render('my', [
            'coupons' => $coupons,
            'cat' => $cat,
            'catshop' => $catshop,
            'catfood' => $catfood,
            'catservice' => $catservice,
            'catfun' => $catfun,
            'catother' => $catother
        ]);
    }

    /**
     * Displays a single Coupon model.
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
     * Creates a new Coupon model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Coupon();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Coupon model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->id == $this->findModel($id)->user_id) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $model->visible = 0;
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            Yii::$app->session->setFlash('danger', 'Купон не найден.');
            return $this->redirect(['my']);
        }
    }

    /**
     * Deletes an existing Coupon model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->id == $this->findModel($id)->user_id) {
            $this->findModel($id)->delete();
            Yii::$app->session->setFlash('success', 'Купон удален.');
        } else {Yii::$app->session->setFlash('danger', 'Купон не найден.');}
        return $this->redirect(['my']);
    }

    /**
     * Finds the Coupon model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Coupon the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Coupon::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
