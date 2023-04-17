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
<body id="main_body" >
<?php include __DIR__ . "/header.php"; ?>
<img id="top" src="top.png" alt="">
<div id="form_container">

    <h1><a>ServersOfThe.net</a></h1>
    <form id="form_89569" class="appnitro"  action="massServer.php" id="gen_server" method="GET">
        <div class="form_description">
            <h2>Generate a Server</h2>
            <p>Please choose from the options below to randomly generate a large number of servers</p>
        </div>
        <ul >

            <li id="li_1" >
                <label class="description" for="element_1">Number of Servers?</label>
                <div>
                    <input id="element_1" name="servernum" class="element text small" type="number" min="1" max="10000" value="50"/>
                </div><p class="guidelines" id="guide_1"><small>Generate between 1 and 10,000 servers</small></p>
            </li>

            <li id="li_b" >
                <label class="description" for="element_1b">RNG Seed </label>
                <div>
                    <input id="element_1b" name="seed" class="element text small" type="number" min="0" max="2147483647" value=""/>
                </div><p class="guidelines" id="guide_1b"><small>Will generate the same list based on the RNG and using the same options below</small></p>
            </li>


            <li id="li_2" >

                <label class="description" for="element_2">MIN Server Difficulty </label>
                <div>
                    <select class="element select small" id="element_2" name="difficulty_min">
                        <option value="0" selected="selected">0</option>
                        <option value="1" >1</option>
                        <option value="2" >2</option>
                        <option value="3" >3</option>
                        <option value="4" >4</option>
                        <option value="5" >5</option>

                    </select>
                </div><p class="guidelines" id="guide_2"><small>Lower end value How many difficulty die does it require to hack into the system.
                        See page 126 of the Shadows of the Beanstalk sourcebook for more details. If set higher than the max value below then all servers will have the same value based on the drop down below.</small></p>

            <li id="li_3" >

                <label class="description" for="element_3">MAX Server Difficulty </label>
                <div>
                    <select class="element select small" id="element_3" name="difficulty_max">
                        <option value="0" >0</option>
                        <option value="1" >1</option>
                        <option value="2" >2</option>
                        <option value="3" >3</option>
                        <option value="4" >4</option>
                        <option value="5" selected="selected">5</option>

                    </select>
                </div><p class="guidelines" id="guide_3"><small>Higher end value of how many difficulty die does it require to hack into the system.
                        See page 126 of the Shadows of the Beanstalk sourcebook for more details. If set lower than the minimum value above, then THIS value will be used for all servers</small></p>

            <li id="li_4" >
                <label class="description" for="element_4">Text Only Output</label>
                <div>
                    <select class="element select small" id="element_4" name="textonly">
                        <option value="0" selected="selected">No</option>
                        <option value="1" >Yes</option>
                    </select>
                </div><p class="guidelines" id="guide_4"><small>Set this to yes if you want a text-only format, easier for copying to spreadsheet programs while being a little harder to read</small></p>
            </li>            <li id="li_5" >
                <label class="description" for="element_5">Advanced Runner(s)</label>
                <div>
                    <select class="element select small" id="element_5" name="adv_run">
                        <option value="0" selected="selected">No</option>
                        <option value="1" >Yes</option>
                        <option value="-1" >Random</option>
                    </select>
                </div><p class="guidelines" id="guide_5"><small>Does one or more runner in the group have 150+ XP. You can set this to random if you're wanting more of a sandbox/west marches style feel to the generation</small></p>
            </li>
            <li id="li_6" >
                <label class="description" for="element_6">Only use RAW ice?</label>
                <div>
                    <select class="element select small" id="element_6" name="raw_ice">
                        <option value="0" selected="selected">No</option>
                        <option value="1" >Yes</option>
                    </select>
                </div><p class="guidelines" id="guide_6"><small>Only use the ice published in official source books</small></p>
            </li>
            <li id="li_7" >
                <label class="description" for="element_7">Maximum of the same ice?</label>
                <div>
                    <select class="element select small" id="element_7" name="max_same_ice">
                        <option value="0" >0</option>
                        <option value="1" selected="selected">1</option>
                        <option value="2" >2</option>
                        <option value="3" >3</option>
                        <option value="4" >4</option>
                        <option value="5" >5</option>
                        <option value="-1">Unlimited</option>

                    </select>
                </div><p class="guidelines" id="guide_4"><small>How many times the same piece of ice can be repeated in the server. Use 0 to have a server with no ice. Does not apply to Great Wall.</small></p>
            </li>


            <li class="buttons">
                <input type="hidden" name="hide_ice" value="0" />

                <input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
            </li>
        </ul>
    </form>
<?php include __DIR__ . "/footer.php"; ?>