<?
$filename = 'uploads/auto/' . $file_name;
if (file_exists($filename.'.jpg')) {
    echo '/'.$filename.'.jpg';
} elseif (file_exists($filename.'.png')) {
    echo '/'.$filename.'.png';
} else {
    echo '/uploads/auto/no.png';
}
?>
