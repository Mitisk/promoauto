<?php

namespace app\modules\cabinet\controllers;

use Yii;
use common\models\Message;
use yii\data\ActiveDataProvider;
use common\controllers\AuthController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db;
use yii\db\Expression;
/**
 * MessageController implements the CRUD actions for Message model.
 */

class MessageController extends AuthController
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
     * Lists all Message models.
     * @return mixed
     */
    public function actionIndex()
    {
        $userid = Yii::$app->user->id;
        $messages = Message::find()->where(['to_user_id' => $userid])->orderBy(['id' => SORT_DESC])->all();
        $usersinfo = Message::find()->where(['to_user_id' => $userid])->select(['from_user_id'])->all();
        $names = Yii::$app->db->createCommand('
 SELECT DISTINCT from_user_id FROM message WHERE to_user_id='.$userid.'
 UNION ALL
 SELECT DISTINCT to_user_id FROM message WHERE from_user_id='.$userid.'
')->queryAll();
        $dataProvider = new ActiveDataProvider([
            'query' => Message::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'messages' => $messages,
            'usersinfo' => $usersinfo,
            'names' => $names,
        ]);
    }

    /**
     * Displays a single Message model.
     * @param integer $from
     * @param integer $id
     * @return mixed
     */
    public function actionView($from, $id)
    {
        $userid = Yii::$app->user->id;
        $messagesnoty = Message::findOne($id);
        if ($messagesnoty->active == 1 && $messagesnoty->to_user_id == $userid) {
            $messnoty = Message::findOne($id);
            $messnoty->active = '0';
            $messnoty->save();
        }
        $messages = Message::find()->where(['from_user_id' => $from, 'to_user_id' => $userid])->orWhere(['from_user_id' => $userid, 'to_user_id' => $from])->all();
        $model = new Message();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $messparams = Message::find()->where(['id' => $model->id])->one();
            $messparams->from_user_id = Yii::$app->user->id;
            $messparams->date = new Expression('NOW()');
            $messparams->report = 0;
            $messparams->to_del = 0;
            $messparams->from_del = 0;
            $messparams->active = 1;
            $messparams->save();
            return $this->redirect(['view', 'from' => $model->to_user_id, 'id' => $model->id, ['messages' => $messages]]);
        } else {
            return $this->render('view', [
                'model' => $model,
                'messages' => $messages,
            ]);
        }
    }

    public function actionSpam($from, $id)
    {
        $model = $this->findModel($id);
        $userid = Yii::$app->user->id;
        if ($model->report != 1 && $model->to_user_id == $userid) {
            $model->report = '1';
            $model->save();
        }
        $messages = Message::find()->where(['from_user_id' => $from, 'to_user_id' => $userid])->orWhere(['from_user_id' => $userid, 'to_user_id' => $from])->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Письмо помечено как спам!');
            return $this->redirect(['view', 'from' => $from, 'id' => $model->id, ['messages' => $messages]]);
        } else {
            return $this->redirect(['view', 'from' => $from, 'id' => $model->id, ['messages' => $messages]]);

        }
    }

    /**
     * Creates a new Message model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Message();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'from' => $model->to_user_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Deletes an existing Message model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
        $userid = Yii::$app->user->id;
        if (Yii::$app->request->get('id')) {
            $model = $this->findModel(Yii::$app->request->get('id'));
            if ($model->to_user_id != $userid && $model->from_user_id == $userid) {
                if ($model->to_del != '0') {
                    $model->delete();
                } else {
                    $model->from_del = '1';
                    $model->save();
                }
            } elseif ($model->to_user_id == $userid && $model->from_user_id != $userid) {
                if ($model->from_del != '0') {
                    $model->delete();
                } else {
                    $model->to_del = '1';
                    $model->save();
                }
            }
        } elseif (Yii::$app->request->get('from')) {
            $model = Message::find()->where([
                'from_user_id' => Yii::$app->request->get('from'),
                'to_user_id' => $userid
            ])->orWhere([
                'from_user_id' => $userid,
                'to_user_id' => Yii::$app->request->get('from')
            ])->all();
            if ($model->to_user_id != $userid && $model->from_user_id == $userid) {
                if ($model->to_del != '0') {
                    $model->delete();
                } else {
                    $model->from_del = '1';
                    $model->save();
                }
            } elseif ($model->to_user_id == $userid && $model->from_user_id != $userid) {
                if ($model->from_del != '0') {
                    $model->delete();
                } else {
                    $model->to_del = '1';
                    $model->save();
                }
            }
            Yii::$app->session->setFlash('success', 'Переписка удалена');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Message model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Message the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Message::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
