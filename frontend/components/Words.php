<?php
namespace frontend\components;
use Yii;
use yii\base\Component;

class Words extends Component {
    static function placestatus($element) {
        if ($element == '0') {$placestatus = '(отклонено водителем)';
        } elseif ($element == '1') {$placestatus = '(место забронировано за Вами до конца текущего дня)';
        } elseif ($element == '2') {$placestatus = '(отправлено водителю на утверждение)';
        } elseif ($element == '3') {$placestatus = '(утверждено водителем)';
        } elseif ($element == '4') {$placestatus = '(идет рекламная кампания)';
        }
        return $placestatus;
    }
    static function campaignstatus($element) {
        if ($element == '0') {$campaignstatus = 'Кампания не запущена';
        } elseif ($element == '1') {$campaignstatus = 'Кампания запущена';
        } elseif ($element == '2') {$campaignstatus = 'Кампания заморожена';
        } elseif ($element == '3') {$campaignstatus = 'Кампания закрыта';
        }
        return $campaignstatus;
    }
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
    static function admaterial($element) {
        if ($element == '0') {echo '';
        } elseif ($element == '1') {echo '1 рекламного материала';
        } elseif ($element >= '2') {echo $element.' рекламных материалов';
        }
    }
    static function finance_action($element) {
        if ($element == 'replenishment') {echo 'Пополнение';
        } elseif ($element == 'withdrawal') {echo 'Вывод';
        } elseif ($element >= 'promo') {echo 'Промокод';
        }
    }
    static function finance_result($element) {
        if ($element == '0') {echo '<span class="label label-sm label-danger"> Ошибка </span>';
        } elseif ($element == '1') {echo '<span class="label label-sm label-warning"> Обработка </span>';
        } elseif ($element == '2') {echo '<span class="label label-sm label-info"> Успешно </span>';
        } elseif ($element == '3') {echo 'Промокод';
        }
    }
    static function finance_method($method) {
        if ($method == 'visa') {echo 'на карту "Visa"/"Mastercard"';
        } elseif ($method == 'sberbank') {echo 'на карту Сбербанка';
        } elseif ($method == 'yandex') {echo 'на "Яндекс.Деньги"';
        } elseif ($method == 'mts') {echo 'на счет мобильного телефона оператора "МТС"';
        } elseif ($method == 'beelane') {echo 'на счет мобильного телефона оператора "Билайн"';
        } elseif ($method == 'megafon') {echo 'на счет мобильного телефона оператора "Мегафон"';
        } else {echo 'КРИТИЧЕСКАЯ ОШИБКА';}
    }
    static function finance_card_number_label($method) {
        if ($method == 'visa') {echo 'Номер банковской карты';
        } elseif ($method == 'sberbank') {echo 'Телефон или номер банковской карты';
        } elseif ($method == 'yandex') {echo 'Номер счета';
        } elseif ($method == 'mts') {echo 'Номер мобильного телефона';
        } elseif ($method == 'beelane') {echo 'Номер мобильного телефона';
        } elseif ($method == 'megafon') {echo 'Номер мобильного телефона';
        } else {echo 'КРИТИЧЕСКАЯ ОШИБКА';}
    }
    static function campaign_period ($period) {
        if ($period == '1') {echo '1 месяц';
        } elseif ($period == '2') {echo '2 месяца';
        } elseif ($period == '3') {echo '3 месяца';
        } elseif ($period == '4') {echo '4 месяца';
        } elseif ($period == '5') {echo '5 месяцев';
        } elseif ($period == '6') {echo '6 месяцев';
        } elseif ($period == '7') {echo 'около 1 года';
        } elseif ($period == '8') {echo 'бессрочно';
        } else {echo 'КРИТИЧЕСКАЯ ОШИБКА';}
    }
    static function auto_color ($color) {
        if ($color == 'white') {$colorname = 'Белый';
        } elseif ($color == 'silver') {$colorname = 'Cеребристый';
        } elseif ($color == 'gray') {$colorname = 'Серый';
        } elseif ($color == 'beige') {$colorname = 'Бежевый';
        } elseif ($color == 'yellow') {$colorname = 'Желтый';
        } elseif ($color == 'gold') {$colorname = 'Золотой';
        } elseif ($color == 'orange') {$colorname = 'Оранжевый';
        } elseif ($color == 'pink') {$colorname = 'Розовый';
        } elseif ($color == 'red') {$colorname = 'Красный';
        } elseif ($color == 'purple') {$colorname = 'Пурпурный';
        } elseif ($color == 'brown') {$colorname = 'Коричневый';
        } elseif ($color == 'darkblue') {$colorname = 'Синий';
        } elseif ($color == 'violet') {$colorname = 'Фиолетовый';
        } elseif ($color == 'green') {$colorname = 'Зеленый';
        } elseif ($color == 'black') {$colorname = 'Черный';
        } elseif ($color == 'blue') {$colorname = 'Голубой';
        } else {$colorname = 'Не указано';}
        return $colorname;
    }

}