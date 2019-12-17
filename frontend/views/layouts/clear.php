<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\CabinetAsset;
use common\widgets\Alert;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

use common\models\Notification;

CabinetAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">
<head><?php $this->head() ?></head>
<?php $this->beginBody() ?>
<body style="background-color: #fff;">
<?= Alert::widget() ?>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>