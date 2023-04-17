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

<img id="top" src="top.png" alt="">
<div id="form_container">

    <h1><a>ServersOfThe.net</a></h1>
    <form id="form_89569" class="appnitro"  action="servergen.php" id="gen_server" method="GET">
        <div class="form_description">
            <h2>Generate a Server</h2>
            <p>Please choose from the options below or leave everything blank for a random configuration</p>
        </div>
        <ul >

            <li id="li_1" >
                <label class="description" for="element_1">Server Name </label>
                <div>
                    <input id="element_1" name="servername" class="element text medium" type="text" maxlength="255" value=""/>
                </div><p class="guidelines" id="guide_1"><small>Leave Blank for Random Name</small></p>
            </li>

            <li id="li_b" >
                <label class="description" for="element_1b">RNG Seed </label>
                <div>
                    <input id="element_1b" name="seed" class="element text small" type="number" min="0" max="2147483647" value=""/>
                </div><p class="guidelines" id="guide_1b"><small>Recalls a specific server configuration when used with the same options below. Leave blank for a random configuration each time</small></p>
            </li>


            <li id="li_2" >

                <label class="description" for="element_2">Server Difficulty </label>
                <div>
                    <select class="element select small" id="element_2" name="difficulty">
                        <option value="-1" selected="selected">Random</option>
                        <option value="0" >0</option>
                        <option value="1" >1</option>
                        <option value="2" >2</option>
                        <option value="3" >3</option>
                        <option value="4" >4</option>
                        <option value="5" >5</option>

                    </select>
                </div><p class="guidelines" id="guide_2"><small>How many difficulty die does it require to hack into the system.
                        See page 126 of the Shadows of the Beanstalk sourcebook for more details</small></p>
            </li>		<li id="li_3" >
                <label class="description" for="element_3">Target Sub-Systems </label>
                <span>
			<input id="element_3_1" name="subsystem[]" class="element checkbox" type="checkbox" value="30" />
<label class="choice" for="element_3_1">Security Cameras</label>
<input id="element_3_2" name="subsystem[]" class="element checkbox" type="checkbox" value="31" />
<label class="choice" for="element_3_2">24 Hour Camera Footage Storage</label>
<input id="element_3_3" name="subsystem[]" class="element checkbox" type="checkbox" value="32" />
<label class="choice" for="element_3_3">Deep Archived Camera Footage Storage</label>
<input id="element_3_4" name="subsystem[]" class="element checkbox" type="checkbox" value="33" />
<label class="choice" for="element_3_4">Emergency Lighting</label>
<input id="element_3_5" name="subsystem[]" class="element checkbox" type="checkbox" value="34" />
<label class="choice" for="element_3_5">Lighting</label>
<input id="element_3_6" name="subsystem[]" class="element checkbox" type="checkbox" value="35" />
<label class="choice" for="element_3_6">HVAC</label>
<input id="element_3_7" name="subsystem[]" class="element checkbox" type="checkbox" value="36" />
<label class="choice" for="element_3_7">Security Doors</label>
<input id="element_3_8" name="subsystem[]" class="element checkbox" type="checkbox" value="37" />
<label class="choice" for="element_3_8">High Secure Data A</label>
<input id="element_3_9" name="subsystem[]" class="element checkbox" type="checkbox" value="38" />
<label class="choice" for="element_3_9">High Secure Data B</label>
<input id="element_3_10" name="subsystem[]" class="element checkbox" type="checkbox" value="39" />
<label class="choice" for="element_3_10">Area Access</label>
<input id="element_3_11" name="subsystem[]" class="element checkbox" type="checkbox" value="40" />
<label class="choice" for="element_3_11">Structure Map</label>
<input id="element_3_12" name="subsystem[]" class="element checkbox" type="checkbox" value="41" />
<label class="choice" for="element_3_12">Elevators</label>
<input id="element_3_13" name="subsystem[]" class="element checkbox" type="checkbox" value="42" />
<label class="choice" for="element_3_13">Control System</label>
<input id="element_3_14" name="subsystem[]" class="element checkbox" type="checkbox" value="43" />
<label class="choice" for="element_3_14">Weapon System</label>
<input id="element_3_15" name="subsystem[]" class="element checkbox" type="checkbox" value="44" />
<label class="choice" for="element_3_15">PAD Control</label>
<input id="element_3_16" name="subsystem[]" class="element checkbox" type="checkbox" value="45" />
<label class="choice" for="element_3_16">Self Destruct</label>

		</span><p class="guidelines" id="guide_3"><small>Select up to 10 target systems the PCs are looking to interact with</small></p>
            </li>		<li id="li_4" >
                <label class="description" for="element_4">Extra Random Optional Sub-Systems </label>
                <div>
                    <select class="element select small" id="element_4" name="opt_sub_sys">
                        <option value="-1" selected="selected">Random</option>
                        <option value="0" >0</option>
                        <option value="1" >1</option>
                        <option value="2" >2</option>
                        <option value="3" >3</option>
                        <option value="4" >4</option>
                        <option value="5" >5</option>

                    </select>
                </div><p class="guidelines" id="guide_4"><small>Will never include Weapon System, PAD Control or Self Destruct</small></p>
            </li>

            <li id="li_5" >
                <label class="description" for="element_5">Advanced Runner(s)</label>
                <div>
                    <select class="element select small" id="element_5" name="adv_run">
                        <option value="0" selected="selected">No</option>
                        <option value="1" >Yes</option>
                    </select>
                </div><p class="guidelines" id="guide_5"><small>Does one or more runner in the group have 150+ XP</small></p>
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