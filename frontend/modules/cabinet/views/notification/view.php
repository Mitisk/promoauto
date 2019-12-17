<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Notification */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Уведомления', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-info panel-body" align="center">
    <h1><i class="fa fa-<?=$model->icon?>"></i><br><?= Html::encode($this->title) ?></h1>
    <span class="badge badge-default badge-roundless"> <?= Yii::$app->formatter->asDate($model->date, 'dd-MM-yyyy') ?> </span>
    <p><?=$model->text?></p>
    <?= Html::a('Посмотреть', [$model->url], ['class' => 'btn btn-primary']) ?>
</div>
