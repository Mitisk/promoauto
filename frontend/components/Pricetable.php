<?php
namespace frontend\components;

use yii\base\Component;
use yii\helpers\Html;

class Pricetable extends Component {

    static function tr($element, $price, $price_for, $campaignscount, $campaigns, $status, $auto_id, $placeid) {
        echo'<tr>
                <td>'.$element.'</td>
                <td>'.$price.' рублей '.$price_for.'</td>
                <td align="center">';
                    if ($campaignscount == 1 and $status == 0) {
                        echo Html::a('<i class="fa fa-plus" aria-hidden="true"></i>',
                            ['campaignplace/create', 'autoid' => $auto_id, 'autoadvertplace' => $placeid],
                            ['class' => 'btn btn-info']);
                        } elseif ($campaignscount >= 2 and $status == 0) {
                        echo'<div class="btn-group">
                            <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="true">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu">';
                                foreach ($campaigns as $campaign) {
                                    echo '<li>';
                                    echo Html::a(\yii\helpers\StringHelper::truncate($campaign->name,20,'...'), ['campaignplace/create', 'autoid' => $auto_id, 'autoadvertplace' => $placeid, 'campaign' => $campaign->id]);
                                    echo '</li>';
                                }
                        echo '</ul></div>';
                        } else {
                        echo '<a class="btn btn-info" disabled="disabled"><i class="fa fa-plus" aria-hidden="true"></i></a>';
                    }
            echo '</td>
                </tr>';
    }

    static function item($element, $point1, $view, $price, $price_for, $originaltitle, $id, $side, $place, $transform) {
        if ($transform) {$style = 'transform: scale(-1, 1)';} else {$style=null;}
        echo '<div class="item">';
            if ($point1) {
                if ($view == 'view') {
                echo Html::a($element,
                    ['', 'id' => $id],
                    ['class' => 'point point'.$element.' btn btn-circle blue btn-icon-only btn-default popovers',
                        'data' => [
                            'container' => 'body',
                            'trigger' => 'hover',
                            'placement' => 'bottom',
                            'content' => $price . ' рублей ' . $price_for,
                            'original-title' => $originaltitle
                                ],
                        'style' => $style
                    ]);
                } elseif ($view == 'edit') {
                    echo Html::a('<i class="fa fa-close"></i>',
                        ['place/delete', 'id' => $id, 'side' => $side, 'place' => $place],
                        ['class' => 'point point'.$element.' btn btn-circle red-mint btn-icon-only btn-default', 'data' => ['method' => 'post']]);
                }
            } else {
                if ($view == 'edit') {
                    echo Html::a('<i class="fa fa-cog"></i>',
                        ['place/create', 'id' => $id, 'side' => $side, 'place' => $place, 'point' => $element],
                        ['id' => 'point'.$element, 'class' => 'point point'.$element.' btn btn-circle btn-icon-only btn-default']);
                }
            }
        echo '</div>';
    }

    static function campaign($side, $point) {
        if ($side == 'right') {echo '<div class="side" style="transform: scale(-1, 1)">';} else {echo '<div class="side">';}
        echo '<div class="item">
        <a class="point point'.$point.' btn btn-circle yellow-lemon btn-icon-only btn-default popovers" data-container="body" data-trigger="hover" data-placement="bottom" data-content="На этом месте размещается рекламная наклейка." data-original-title="Место брендирования">
            <i class="fa fa-map-marker"></i>
        </a>
        </div>
        </div>';
    }

    static function modal($count) {
        //Для вывода модальных окон
        for ($i=1; $i <= $count; $i++) {
            echo '<div class="modal fade unit'.$i.'" id="up1" tabindex="-1" role="basic" aria-hidden="true"></div>';
        }
    }

}

?>