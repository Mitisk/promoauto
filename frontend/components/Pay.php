<?php
namespace frontend\components;
use Yii;
use yii\base\Component;
use yii\helpers\Url;


class Pay extends Component {
    static function comission($method) {
        if ($method == 'visa') {$comission = '10';
        } elseif ($method == 'sberbank') {$comission = '1';
        } elseif ($method == 'yandex') {$comission = '1';
        } elseif ($method == 'mts') {$comission = '1';
        } elseif ($method == 'beelane') {$comission = '1';
        } elseif ($method == 'megafon') {$comission = '1';
        } else {$comission = '100';}
        return $comission;
    }
    static function visa($action) {
        $active = '1';
        if ($active == '1') {
            echo '<a href="'.Url::toRoute($action).'?method=visa">';
            echo '<div class="col-xs-6 col-md-3 col-lg-2">';
            echo '<div class="widget-pay widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered hover-gray" align="center">';
            echo '<div class="label_pay visa"></div>';
            echo '</div></div></a>';
        }
    }
    static function sberbank($action) {
        $active = '1';
        if ($active == '1') {
            echo '<a href="'.Url::toRoute($action).'?method=sberbank">';
            echo '<div class="col-xs-6 col-md-3 col-lg-2">';
            echo '<div class="widget-pay widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered hover-gray" align="center">';
            echo '<div class="label_pay sberbank"></div>';
            echo '</div></div></a>';
        }
    }
    static function yandex($action)
    {
        $active = '1';
        if ($active == '1') {
            echo '<a href="'.Url::toRoute($action).'?method=yandex">';
            echo '<div class="col-xs-6 col-md-3 col-lg-2">';
            echo '<div class="widget-pay widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered hover-gray" align="center">';
            echo '<div class="label_pay yandex"></div>';
            echo '</div></div></a>';
        }
    }
    static function promo()
    {
        $active = '1';
        if ($active == '1') {
            echo '<div class="col-xs-6 col-md-3 col-lg-2">';
            echo '<div class="promo_back widget-pay widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered hover-gray" align="center">';
            echo '<div class="label_pay promo"></div>';
            echo '</div></div>';
        }
    }
    static function mts($action)
    {
        $active = '1';
        if ($active == '1') {
            echo '<a href="'.Url::toRoute($action).'?method=mts">';
            echo '<div class="col-xs-6 col-md-3 col-lg-2">';
            echo '<div class="widget-pay widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered hover-gray" align="center">';
            echo '<div class="label_pay mts"></div>';
            echo '</div></div></a>';
        }
    }
    static function beelane($action)
    {
        $active = '1';
        if ($active == '1') {
            echo '<a href="'.Url::toRoute($action).'?method=beelane">';
            echo '<div class="col-xs-6 col-md-3 col-lg-2">';
            echo '<div class="widget-pay widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered hover-gray" align="center">';
            echo '<div class="label_pay beelane"></div>';
            echo '</div></div></a>';
        }
    }
    static function megafon($action)
    {
        $active = '1';
        if ($active == '1') {
            echo '<a href="'.Url::toRoute($action).'?method=megafon">';
            echo '<div class="col-xs-6 col-md-3 col-lg-2">';
            echo '<div class="widget-pay widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered hover-gray" align="center">';
            echo '<div class="label_pay megafon"></div>';
            echo '</div></div></a>';
        }
    }
}