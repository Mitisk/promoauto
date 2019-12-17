<?php
use yii\helpers\Url;
?>
<?if ($messagescount) {?>
<li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
        <i class="icon-envelope-open"></i>
        <span class="badge badge-default"> <?= $messagescount ?> </span>
    </a>
    <ul class="dropdown-menu">
        <li class="external">
            <h3>У Вас
                <span class="bold"><?= $messagescount ?></span>
                <? if($messagescount == 1) { ?>
                    сообщение
                <?} elseif ($messagescount < 5 and $messagescount > 1) {?>
                    сообщения
                <?} else {?>
                    сообщений
                <?}?>
            </h3>
            <a href="<?= Url::toRoute('/cabinet/message/')?>">все</a>
        </li>
        <li>
            <ul class="dropdown-menu-list scroller" style="max-height: 275px; overflow: hidden; width: auto;" data-handle-color="#637283" data-initialized="1">
                    <?
                    foreach ($messages as $message) :
                        $fromuser = \common\models\User::findOne($message->from_user_id)
                    ?>
                        <li>
                            <a href="<?= Url::toRoute('/cabinet/message/view?from='.$message->from_user_id.'&id='.$message->id)?>">
                                <span class="photo">
                                    <?
                                    $filename = 'uploads/users/avatar/usr_' . $fromuser->id;
                                    $filename2 = 'uploads/users/avatar/usr_' . $fromuser->id . '.png';
                                    if (file_exists($filename.'.jpg')) {
                                        echo '<img src="/../../'.$filename.'.jpg" class="img-circle">';
                                    } elseif (file_exists($filename.'.png')) {
                                        echo '<img src="/../../'.$filename.'.png" class="img-circle">';
                                    } else {
                                        echo '<img src="/../../uploads/users/avatar/no-ava.png" class="img-circle">';
                                    }
                                    ?>
                                </span>
                                <span class="subject">
                                    <span class="from">
                                        <?php if ($fromuser->name) {echo $fromuser->name;} else {echo $fromuser->username;} ?>
                                    </span>
                                    <span class="time"><?=Yii::$app->formatter->asRelativeTime($message->date) ?> </span>
                                </span>
                                <span class="message"> <?=$message->text?> </span>
                            </a>
                        </li>
                    <?
                    endforeach;
                    ?>
                </ul>
        </li>
    </ul>
</li>

<?}?>