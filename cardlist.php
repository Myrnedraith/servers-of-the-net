<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include __DIR__ . "/gtag.js"; ?>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
    <title>ServersOfThe.net</title>
    <link rel="stylesheet" href="Treant.css">
    <link rel="stylesheet" href="collapsable.css">

    <link rel="stylesheet" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" type="text/css" href="view.css" media="all">
    <script type="text/javascript" src="view.js"></script>

</head>
<?php include __DIR__ . "/header.php"; ?>
<body id="main_body" >

<?php
//generate a list of cards and display them
$html = '';
foreach (glob("./img/*.png") as $filename) {
    //echo $filename;
    if (!empty($filename)) $html .= '<a href="'.$filename.'"><img src="'.$filename.'"/></a>';
}
$html = trim($html);
echo '<p>'.$html.'</p>';
?>