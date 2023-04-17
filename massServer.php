<html>
<head>
    <?php include __DIR__ . "/gtag.js"; ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
    <title>ServersOfThe.net</title>
    <link rel="stylesheet" href="massserver.css">

</head>
<body>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require __DIR__ . '/iceBuilder.php';
require __DIR__ . '/constants.php';

if (DEBUG) print_R($_GET);

//CONFIG CAPTURE
$seedtext = '';
$textOnlyMode = false;
$lowDiff = 0;
$highDiff = 5;
$adv_run = -1; // random
$raw_ice = 0; // off
$max_same_ice =  -1; // unlimited duplicates
$serverNum = 50;

//meta seed
$metaseed = null;
if (isset($_GET['seed'])) $metaseed = $_GET['seed'];
if (empty($metaseed)) $metaseed = rand(0,2147483647);
if(!is_numeric($metaseed))
{
    $metaseed = rand(0,2147483647);
    //echo $seed;
    //echo '| <b>WARNING: Invalid Server Code, new code generated</b>';
    $seedtext = ' <b>WARNING: Invalid Server Code, new code generated</b>';
}
//Build collection query string
$querystring = 'massServer.php?seed='.$metaseed;

//show only text for spreadsheet copy pasta
if (isset($_GET['textonly']))
{
    $textOnlyMode = ($_GET['textonly'] == 1);
    $querystring .= '&textonly='.$textOnlyMode;
}

//Server Number
if (isset($_GET['servernum'])) $serverNum = $_GET['servernum'];
if (!is_numeric($serverNum)) $serverNum = 50;
if ($serverNum > 10000) $serverNum = 10000;
if ($serverNum < 1) $serverNum = 1;
$querystring .= '&servernum='.$serverNum;

//Difficulty Range
if (isset($_GET['difficulty_min'])) $lowDiff = $_GET['difficulty_min'];
if (isset($_GET['difficulty_max'])) $highDiff = $_GET['difficulty_max'];
if (!is_numeric($lowDiff) || ($lowDiff < 0 || $lowDiff > 5)) $lowDiff = 0;
if (!is_numeric($highDiff) || ($highDiff > 5 || $highDiff < 0)) $highDiff = 5;
if ($lowDiff > $highDiff) $lowDiff = $highDiff;
$querystring .= '&difficulty_min='.$lowDiff;
$querystring .= '&difficulty_max='.$highDiff;

// Other config values
if (isset($_GET['adv_run'])) $adv_run = $_GET['adv_run'];
if (isset($_GET['raw_ice'])) $raw_ice = $_GET['raw_ice'];
if (isset($_GET['max_same_ice'])) $max_same_ice = $_GET['max_same_ice'];

$querystring .= '&adv_run='.$adv_run;
$querystring .= '&raw_ice='.$raw_ice;
$querystring .= '&max_same_ice='.$max_same_ice;

//Output link for the collection
echo '<p style="padding: 5px;"><a href="index.php">New Collection Settings</a> | <a href="'.$querystring.'">Link to this collection</a></p>';

//else echo $seed; // print it out
srand($metaseed);

//Read ipv6 for random server names
$addresses = file('./data/ipv6.txt', FILE_IGNORE_NEW_LINES);
shuffle($addresses);

//Start Table
echo '<div class="wrapper"><table><tr><th>ID</th><th>Address</th><th>View (GM)</th><th>View (Hidden)</th><th>Advanced</th><th>Size</th><th>Difficulty</th></tr>';

//Server Gen
for ($s = 0; $s < $serverNum; $s++ )
{

    $seed = rand(0,2147483647);
    $server['{difficulty}'] = rand($lowDiff,$highDiff);
    $server['{system_name}'] = array_pop($addresses);
    $server['{adv_run}'] = $adv_run;
    if ($adv_run == -1) $server['{adv_run}'] = rand(0,1);
    $opt_sub_sys = rand(0,5);
    $server['{systems}'] = ($server['{difficulty}'] +1) + $opt_sub_sys;
    $server['{querystring}'] = 'servergen.php?';
    $server['{querystring}'] .= 'servername='.urlencode($server['{system_name}']);
    $server['{querystring}'] .= '&seed='.urlencode($seed);
    $server['{querystring}'] .= '&difficulty='.urlencode($server['{difficulty}']);
    $server['{querystring}'] .= '&opt_sub_sys='.$opt_sub_sys;
    $server['{querystring}'] .= '&max_same_ice='.$max_same_ice;
    $server['{querystring}'] .= '&adv_run='.$server['{adv_run}'];
    $server['{querystring}'] .= '&raw_ice='.$raw_ice;
    //$queryhide = $hide_ice ? '&hide_ice=0' : '&hide_ice=1';
    $replacetext = '<tr class="';
    if($s&1){
        $replacetext .= 'odd';
    }else{
        $replacetext .= 'even';
    }
    $replacetext .= '"><td>'.($s+1).'</td><td>{system_name}</td><td><a href="{querystring}&hide_ice=0">GM View</a></td><td><a href="{querystring}&hide_ice=1">Hidden View</a></td>';
    $advtext = $server['{adv_run}'] == 1 ? 'Yes' : 'No';
    $replacetext .= '<td>'.$advtext.'</td>';
    if($textOnlyMode)
    {
        $replacetext .= '<td>{systems}</td><td>{difficulty}';
    }
    else
    {
        $replacetext .= '<td><img class="serversize" alt="{systems}" src="icon/{systems}.png"</td><td>';
        for ($d = 0; $d < $server['{difficulty}']; $d++) {
            $replacetext .= '<img alt="d" class="difficulty" src="./symbol/purple.png"/>';
        }
    }
    $replacetext .= '</td></tr>';
    echo strtr($replacetext,$server);
}
echo '</table></div>';

?>
</body>
</html>