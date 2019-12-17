<?php
namespace frontend\widgets;
use yii\jui\Widget;

class Avatar extends Widget{

    public function run(){

        return $this->render('avatar');
    }
}