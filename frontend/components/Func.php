<?php
namespace frontend\components;
use Yii;
use yii\base\Component;
use common\models\Notification;
use common\models\Aword;
use common\models\User;
use common\models\Setting;

class Func extends Component {
    static function priceforrus($element) {
        if ($element == 'forday') {$price_for = 'за день';
        } elseif ($element == 'forweak') {$price_for = 'за неделю';
        } elseif ($element == 'formonth') {$price_for = 'за месяц';
        } elseif ($element == '100km') {$price_for = 'за 100 км';
        } elseif ($element == '500km') {$price_for = 'за 500 км';
        } elseif ($element == '1000km') {$price_for = 'за 1 000 км';
        }
        return $price_for;
    }
    static function autoprice($price, $price_for, $view) {
        // подсчитывает сумму для оплаты
        if ($view == 'forday') {
            if ($price_for == 'forweak') {$price = ceil($price/7);} elseif ($price_for == 'formonth') {$price = ceil($price/30);}
        } elseif ($view == 'formonth') {
            if ($price_for == 'forday') {$price = $price*31;} elseif ($price_for == 'forweak') {$price = $price*4;}
        }
        return $price;
    }
    static function noty($touserid, $fromuserid, $url, $icon, $type, $name, $text) {
        $noty = new Notification();
        $noty->to_user_id = $touserid;
        $noty->from_user_id = $fromuserid;
        $noty->url = $url;
        $noty->icon = $icon;
        $noty->type = $type;
        $noty->name = $name;
        $noty->text = $text;
        $noty->save();
    }
    static function reward($touserid, $view, $bonus) {
        $reward = new Aword();
        $reward->user_id = $touserid;
        $reward->view = $view;
        $reward->bonus = $bonus;
        $reward->save();
    }
    static function bonus($quantity) {
        $bonus = User::find()->where(['id' => Yii::$app->user->id])->one();
        $bonus->bonus += $quantity;
        $bonus->save();
    }
    static function campaignprice($quantity, $tariff) {
        // подсчитывает сумму для логистики кампании
        $tariff1_price = Setting::findOne('1');
        $tariff2_price = Setting::findOne('2');
        $tariff3_price = Setting::findOne('3');
        if ($tariff == 'tariff1') {
            $summ = $quantity*$tariff1_price->value;
        } elseif ($tariff == 'tariff2') {
            $summ = $quantity*$tariff2_price->value;
        } elseif ($tariff == 'tariff3') {
            $summ = $quantity*$tariff3_price->value;
        }
        return $summ;
    }

}