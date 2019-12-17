<?php
namespace frontend\widgets;
use yii\jui\Widget;
/*
 * Проверяем наличие фотографий для автомобиля. Выводим ссылку
 */
class Auto extends Widget{

    public $Auto_file_name;

    public function run(){

        return $this->render('auto', ['file_name' => $this->Auto_file_name]);

    }
}