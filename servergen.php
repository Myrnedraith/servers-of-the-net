<html>
<head>
    <?php include __DIR__ . "/gtag.js"; ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
    <title>ServersOfThe.net</title>
    <link rel="stylesheet" href="Treant.css">
    <link rel="stylesheet" href="collapsable.css">
    <link rel="stylesheet" href="sysop.css">

    <link rel="stylesheet" href="vendor/perfect-scrollbar/perfect-scrollbar.css">

</head>
<body>
<p style="padding: 5px;"><a style="color: #00829b;" href="index.php">New Server Settings</a> |
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');
    require __DIR__ . '/iceBuilder.php';
    require __DIR__ . '/constants.php';
    $ice_used = array();

    if (DEBUG) print_R($_GET);

    //CONFIG CAPTURE
    $querystring = 'servergen.php?';
    $seedtext = '';
    //seed
    $seed = null;
    if (isset($_GET['seed'])) $seed = $_GET['seed'];
    if (empty($seed)) $seed = rand(0,2147483647);
    if(!is_numeric($seed))
    {
        $seed = rand(0,2147483647);
        //echo $seed;
        //echo '| <b>WARNING: Invalid Server Code, new code generated</b>';
        $seedtext = ' <b>WARNING: Invalid Server Code, new code generated</b>';
    }
    //else echo $seed; // print it out
    $querystring .= 'seed='.urlencode($seed);
    srand($seed);

    //difficulty
    $difficulty = -1;
    if (isset($_GET['difficulty'])) $difficulty = $_GET['difficulty'];
    if (!($difficulty >= 0 && $difficulty <= 5)) $difficulty = rand(0,5);
    if (isset($_GET['difficulty'])) $querystring .= '&difficulty='.$_GET['difficulty'];

    //system name
    $system_name = "";
    if(isset($_GET['servername'])) $system_name = $_GET['servername'];
    if (!empty($system_name)) $system_name = htmlspecialchars($system_name);
    else {
        $name_list = SERVER_NAMES[$difficulty];
        $system_name = $name_list[rand(0,count($name_list)-1)];
    }
    //$querystring .= '&servername='.urlencode($system_name);
    if(isset($_GET['servername'])) $querystring .= '&servername='.$_GET['servername'];

    //advanced run
    $adv_run = 0;
    if (isset($_GET['adv_run'])) $adv_run = $_GET['adv_run'];
    if ($adv_run == 1) $adv_run = true;
    else $adv_run = false;
    if (isset($_GET['adv_run'])) $querystring .= '&adv_run='.$_GET['adv_run'];

    //raw ice
    $raw_ice = 1;
    if (isset($_GET['raw_ice'])) $raw_ice = $_GET['raw_ice'];
    if ($raw_ice == 0) $raw_ice = false;
    else $raw_ice = true;
    if (isset($_GET['raw_ice'])) $querystring .= '&raw_ice='.$_GET['raw_ice'];

    //max_same_ice
    if (isset($_GET['max_same_ice'])) $max_same_ice = $_GET['max_same_ice'];
    else $max_same_ice =  -1;

    if (!($max_same_ice >= -1 && $max_same_ice <= 5)) $max_same_ice = -1;
    $querystring .= '&max_same_ice='.$max_same_ice;

    //Hide Ice
    $hide_ice = 0;
    if (isset($_GET['hide_ice'])) $hide_ice = $_GET['hide_ice'];
    if ($hide_ice == 1) $hide_ice = true;

    //sub-systems
    $subsystems = array();
    if (array_key_exists('subsystem',$_GET)) $subsystems = $_GET['subsystem'];
    $target_sub_sys = array();
    if (count($subsystems) > 0) {
        foreach ($subsystems as $system)
        {
            //check to make sure we weren't flooded with dummy values
            if ($system >= SYSTEM_MIN_NUM && $system <= SYSTEM_MAX_NUM) {
                array_push($target_sub_sys,$system);
            }
            //append final systems to querystring
            $querystring .= '&subsystem[]='.urlencode($system);
        }

        //fix if we were flooded with dummy values
        if (count($target_sub_sys) == 0)
            $target_sub_sys = array(rand(SYSTEM_MIN_NUM,SYSTEM_MAX_NUM),
                rand(SYSTEM_MIN_NUM,SYSTEM_MAX_NUM),
                rand(SYSTEM_MIN_NUM,SYSTEM_MAX_NUM));
        elseif (count($target_sub_sys) > 10) // Handle too many primary systems
        {
            shuffle($target_sub_sys);
            $target_sub_sys  = array_slice($target_sub_sys,0,10);
            echo '| <b>WARNING:</b> Too many target systems selected. Truncated list to max of 10 random selected systems ';
        }
    }
    else { //no target systems were selected
        for ($x = 0; $x <= $difficulty; $x++) {
            array_push($target_sub_sys,rand(SYSTEM_MIN_NUM,SYSTEM_MAX_NUM));
        }
    }
    /* append final systems to querystring 'old code for now'
    foreach ($target_sub_sys as $system)
    {
        $querystring .= '&subsystem[]='.urlencode($system);
    }
    */
    $opt_sub_sys = -1;
    if(isset($_GET['opt_sub_sys'])) $opt_sub_sys = $_GET['opt_sub_sys'];
    if (!($opt_sub_sys >= 0 && $opt_sub_sys <= 5)) $opt_sub_sys = rand(0,5);
    //$querystring .= '&opt_sub_sys='.urlencode($opt_sub_sys);
    if(isset($_GET['opt_sub_sys'])) $querystring .= '&opt_sub_sys='.$_GET['opt_sub_sys'];

    //Render dynamic part of the Navigation Menu

        //finalize query string
        $queryhide = $hide_ice ? '&hide_ice=0' : '&hide_ice=1';
        $texthide = $hide_ice ? 'Show Ice' : 'Hide Ice';

        //render reroll link
        echo '<a style="color: #00829b;" href="'.preg_replace("/[0-9]+(?=&difficulty)/",'',$querystring).'&hide_ice='.urlencode($hide_ice).'">Reroll Server</a> ';
        //render RNG link
        $seedtext = '| RNG Seed: <a href="'.$querystring.'&hide_ice='.urlencode($hide_ice).'">'.$seed.'</a>'.$seedtext;
        echo $seedtext;
        //render hide/show ice
        echo ' | <a href="'. $querystring.$queryhide.'">'.$texthide.'</a>';
        //render Difficulty
        echo ' | Difficulty: ';
        for ($d = 0; $d < $difficulty; $d++) {
            echo '<img class="difficulty" src="./symbol/purple.png"/>';
        }
    echo '</p>';

    //CONFIG SET UP OF NORMAL SERVER, RAW ICE
    $ice_barrier = array(14,15,18);
    $ice_codegate = array(24,25,26,28);
    $ice_sentry = array(20,22,23);

    //ADD COMMUNITY ICE (Barriers <= 6, Sentries <= 4, Code Gates <= 3)
    if(!$raw_ice)
    {
        //lets go!
        array_push($ice_barrier, 102,103,111,112,117,120,121,127,137,139,140,142,143,144,149,150,152);
        array_push($ice_codegate, 107,110,145,146);
        array_push($ice_sentry, 105,108,113,115,119,128,129,130,135,147,153);

        //add normal mythics (there are none)
    }

    $num_target_sys = count($target_sub_sys);
    $ice_layer1 = rand($num_target_sys-1,$num_target_sys+$opt_sub_sys);
    //$ice_layer2 = rand(0,1);
    $ice_layer2 = 0;
    if (rand(1, 100) <= (1 + $difficulty * 10)) $ice_layer2++;
    $ice_layer3 = 0;

    //SET UP ADVANCED SERVER
    if ($adv_run) {
        array_push($ice_barrier, 16,17);
        array_push($ice_codegate, 27,29);
        array_push($ice_sentry, 21);

        //ADD COMMUNITY ICE (Barriers > 6, Sentries > 4, Code Gates > 3)
        if(!$raw_ice) {
            //array_push($ice_barrier, );
            array_push($ice_codegate, 101, 104, 116, 122, 124, 126, 131, 132, 133, 134, 138, 148, 151);
            array_push($ice_sentry, 109, 118, 123, 125, 136, 141);

            //add advanced mythics
            //build this when we have more than one mythic
            //$adv_mythic = shuffle(array(106));
            //for now rare check and then coinflip and add to an existing category
            if ($difficulty >= 4 && rand(1,100) >= 95) {
                $coinflip = rand(0, 1);
                if ($coinflip) array_push($ice_codegate, 106);
                else array_push($ice_sentry, 106);
            }
        }

        $ice_layer2 += rand(1,count($target_sub_sys));
        //$ice_layer3 = rand(0,1);
        $ice_layer3 = 0;
        if (rand(1, 100) <= (1 + $difficulty * 10)) $ice_layer3++;
    }

    //ICE CONFIG
    $ice_total = ($ice_layer3*3)+($ice_layer2*2)+($ice_layer1);
    $ice_barrier_used = 0;
    $ice_codegate_used = 0;
    $ice_sentry_used = 0;

    //SET UP SUB SYSTEMS
    $extra_sub_sys = array();
    for ($x = 0; $x < $opt_sub_sys; $x++) {
        $temp_sys = rand(30,42);
        while (in_array($temp_sys,$target_sub_sys)) {
            $temp_sys = rand(30,42);
        }
        array_push($extra_sub_sys,$temp_sys);
    }
    //randomize array
    shuffle($target_sub_sys);
    shuffle($extra_sub_sys);

    if(DEBUG) {
        echo '<br/>***DEBUG***';
        echo '<pre><br/>Form Vars: ';
        print_r($_GET);
        echo '<br/>System Name: ' . $system_name;
        echo '<br/>Difficulty: ' . $difficulty;
        echo '<br/>Advanced: ';
        echo $adv_run ? "true" : "false";
        echo '<br/>Target Sub-Systems: ' . implode(",", $target_sub_sys);
        echo '<br/>Optional Sub-Systems: ' . $opt_sub_sys;
        echo '<br/>##ICE##<br/>ICE Available: ' . $ice_total;
        echo '<br/>Layers: ' . $ice_layer3 . " (3) " . $ice_layer2 . ' (2) ' . $ice_layer1 . " (1)";

        $all_sub_sys = array_merge($target_sub_sys, $extra_sub_sys);
        echo '<br>';
        print_r($all_sub_sys);
    }

    //Build Tree
    $tree = array();
    foreach ($target_sub_sys as $system)
    {
        array_push($tree,ADD_SYSTEM($system));
    }
    // Add any left over optional systems
    while (count($extra_sub_sys) > 0) {
        $system2 = array_pop($extra_sub_sys);
        array_push($tree,ADD_SYSTEM($system2));
    }
    //if($adv_run) { $adv_ice };

    //shuffle the location of columns so the required systems aren't always on the left
    shuffle($tree);
    if(DEBUG) {
        //ICE Used Info
        echo '<br/>Barriers: ' . $ice_barrier_used;
        echo '<br/>Code Gates: ' . $ice_codegate_used;
        echo '<br/>Sentries: ' . $ice_sentry_used;

        echo '<br/>';
        echo 'Tree Output:';
        print_r($tree);
        echo '</pre>';
    }
    ?>
<div class="chart" id="collapsable"></div>
<script src="./vendor/raphael.js"></script>
<script src="./Treant.js"></script>

<script src="./vendor/jquery.min.js"></script>
<script src="./vendor/jquery.easing.js"></script>
<script>
    <?php
    //Check that system name is not empty
    if (empty(trim($system_name)) || is_null($system_name)) $system_name = "Unknown Server";
    echo '
            config = {
                container: "#collapsable",
                animateOnInit: true,
                animateOnInitDelay: 100,
                connectors: {type: "step"}
            };
            
            node0 =  {
            collapsable: true,
            collapsed: true,
            text: { title: "'.$system_name.'"},
            animation: { nodeAnimation: "easeOutBounce", nodeSpeed: 700, connectorsAnimation: "bounce",connectorsSpeed: 700 }
            };';
    $nodeID = 0;

    foreach ($tree as $node)
    {
        echo RENDER_NODE($node,0);
    };
    echo '
            
            chart_config = [
            config, node0';
    for ($n = 1; $n <= $nodeID; $n++) {
        echo ', node'.$n;
    }
    echo '
            ];
     
     ';

    ?>
</script>
<script>
    tree = new Treant( chart_config );
</script>
    <?php
    require __DIR__ . '/sysopBuilder.php';
    if(!$hide_ice) //Server Response on Trace
    {
        $roll = round(((rand(2,100)/2) + ($difficulty*10))/10);
        echo $roll;
        echo '<div class="response"><p>SERVER RESPONSE: '.SYSOP_RESPONSE[$roll].'</p></div>';

    }
    //SYSOPS
    echo '<div style="margin-top: 10px; margin-bottom: 10px">';
    if(!$hide_ice) echo GEN_SYSOP($difficulty);
    if ($adv_run && !$hide_ice) echo "<br/>".GEN_SYSOP($difficulty-1);


    if($hide_ice)
    {
        echo '<script>
                function setImageVisible(id, visible) {
                    var img = document.getElementById(id);
                    img.style.visibility = (visible ? \'visible\' : \'hidden\');
                }
            
                var myNodelist = document.querySelectorAll(".node");
                var i;
                for (i = 0; i < myNodelist.length; i++) {
                    if(myNodelist[i].nodeName == "A")
                    {
                        var url = myNodelist[i].href;
                        var result = url.match(\'[0-9]{2,4}(?=.png)\');
                        if (!(result[0] >= 30 && result[0] < 100)) {
                            var extraUrl = document.createElement("a");
                            var id = "cardBack" + i;
                            extraUrl.id = id;
                            extraUrl.href = "javascript:setImageVisible(\'" + id + "\', false)";
                            extraUrl.style = \'visibility: visible; position: absolute; left: 3px;\';
            
                            myNodelist[i].href = "javascript:setImageVisible(\'" + id + "\', true)";
                            myNodelist[i].target = "";
            
                            var extraCard = document.createElement("img");
                            extraCard.src = \'img/NetworkCards0.png\';
                            extraUrl.appendChild(extraCard);
                            myNodelist[i].appendChild(extraUrl);
                            //myNodelist[i].style.backgroundColor = "red";
                        }
                    }
                }
            </script>
        ';
    }
    ?>
</div>
</body>
</html>