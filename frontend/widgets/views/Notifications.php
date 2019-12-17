<?
use yii\helpers\Url;
?>
<li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
        <i class="icon-bell"></i>
        <? if($notificationscount > 0) { ?><span class="badge badge-default"> <?= $notificationscount ?> </span><?}?>
    </a>
    <ul class="dropdown-menu">
        <li class="external">
            <? if($notificationscount > 0) { ?>
                <h3><span class="bold"><?= $notificationscount ?> </span>
                    <? if($notificationscount == 1) { ?>
                    уведомление
                    <?} elseif ($notificationscount < 5 and $notificationscount > 1) {?>
                        уведомления
                    <?} else {?>
                        уведомлений
                    <?}?>
                </h3>
            <?} else {?>
                <h3>Нет новых уведомлений</h3>
            <?}?>
            <a href="<?= Url::toRoute('/cabinet/notification/')?>">все</a>
        </li>
        <? if($notificationscount > 0) { ?>
        <li>
            <ul class="dropdown-menu-list scroller" style="max-height: 220px; overflow: hidden; width: auto;" data-handle-color="#637283" data-initialized="1">
                    <?
                    foreach ($notifications as $notify) :
                        ?>
                        <li>
                            <a href="<?= Url::toRoute('/cabinet/notification/view')?>?id=<?=$notify->id?>">
                                <span class="time"><?=Yii::$app->formatter->asRelativeTime($notify->date)?></span>
                                <span class="details">
                                    <span class="label label-sm label-icon label-<?=$notify->type?>">
                                        <i class="fa fa-<?=$notify->icon?>"></i>
                                    </span> <?=$notify->name?> </span>
                            </a>
                        </li>
                    <?
                    endforeach;
                    ?>
                </ul>
        </li>
        <?}?>
    </ul>
</li>