<?
$filename = 'uploads/users/avatar/usr_' . \Yii::$app->user->id;
$filename2 = 'uploads/users/avatar/usr_' . \Yii::$app->user->id . '.png';
if (file_exists($filename.'.jpg')) {
    echo '<img src="/../../'.$filename.'.jpg" class="img-responsive">';
} elseif (file_exists($filename.'.png')) {
    echo '<img src="/../../'.$filename.'.png" class="img-responsive">';
} else {
        echo '<img src="/../../uploads/users/avatar/no-ava.png" class="img-responsive">';
    }
?>
