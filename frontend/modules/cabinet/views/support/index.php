<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Поддержка';
$this->params['breadcrumbs'][] = $this->title;
?>

    <p>
        <?= Html::a('Создать обращение', ['create'], ['class' => 'btn btn-success']) ?>
    </p>




<div class="row">
    <div class="col-md-6">
        <div class="faq-section ">
            <h2 class="faq-title uppercase font-blue">Общие</h2>
            <div class="panel-group accordion faq-content" id="accordion1">
                <?php foreach ($itemscommon as $item) { ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_<?= $item->id ?>" aria-expanded="false"> <?= $item->question ?></a>
                        </h4>
                    </div>
                    <div id="collapse_<?= $item->id ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                        <div class="panel-body">
                            <p> <?= $item->answer ?> </p>
                        </div>
                    </div>
                </div>
                <? } ?>

            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="faq-section ">
            <h2 class="faq-title uppercase font-blue">Технические</h2>
            <div class="panel-group accordion faq-content" id="accordion3">

                <?php foreach ($itemstechnical as $item) { ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_<?= $item->id ?>"> <?= $item->question ?></a>
                        </h4>
                    </div>
                    <div id="collapse_3_<?= $item->id ?>" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p> <?= $item->answer ?> </p>
                        </div>
                    </div>
                </div>
                <? } ?>

            </div>
        </div>
    </div>
</div>