<?php
use common\widgets\Alert;

If (Yii::$app->session->hasFlash('')) : ?>
<div class="tittle-middle-header">
    <div class="alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <span class="tittle-alert entypo-info-circled"></span>
        <?= Alert::widget() ?>
    </div>
</div>
<?php endif ?>

