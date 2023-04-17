<?php
function GEN_SYSOP($difficulty)
{

    //define gender
    $gender = 'female';
    $coinflip = rand(0,1);
    if ($coinflip) $gender = 'male';

// generate name
    $profile = RAND_NAME_AND_PERSONALITY($gender);
    $sysOP = '<table class="sysop-table" ><tr ><caption class="sysop-caption">SYSTEM SYSOP: ';
    $sysOP .= $profile['fullname'];
    $sysOP .= '</caption></tr><tr><td><img src="'.RAND_PICTURE($gender).'"/></td>'; //generate picture
//select Sysop difficulty
    $sysOpDiff = 0;
    if ($difficulty > 0) $sysOpDiff = floor($difficulty / 2);
    $sysOP .= '<td class=""><p><b>Initial Status: </b>'. $profile['mood'].'</p><br/>'.RENDER_STATBLOCK(SYSOP_STAT_BLOCKS[$sysOpDiff]).'<br/><p>'. $profile['personality'].'</p></td></tr>';
    $sysOP .='</table>';
    return $sysOP;
}

function GEN_PERSONALITY ($first_name)
{
    $personality = MYERS_BRIGGS[rand(0,count(MYERS_BRIGGS)-1)];
    return strtr($personality,array('{$name}' => $first_name));
}

function GEN_MOOD ($first_name)
{
    global $difficulty;
    $mood = INITIAL_MOOD[rand($difficulty,count(INITIAL_MOOD)-1)];
    return strtr($mood,array('{$name}' => $first_name));
}

function RAND_NAME_AND_PERSONALITY($gender = 'male')
{
    //Reads naming DB and outputs a single, random, character name
    $first_names = file('./data/'.$gender.'.txt', FILE_IGNORE_NEW_LINES);
    $first_name = $first_names[rand(0,count($first_names)-1)];
    $profile = array('first_name' => $first_name);
    $handles = file('./data/handle.txt', FILE_IGNORE_NEW_LINES);
    $handle =  $handles[rand(0,count($handles)-1)];
    $profile['handle'] = $handle;
    $surnames = file('./data/surname.txt', FILE_IGNORE_NEW_LINES);
    $surname = $surnames[rand(0,count($surnames)-1)];
    $profile['surname'] = $surname;
    $profile['personality'] = GEN_PERSONALITY($first_name);
    $profile['mood'] = GEN_MOOD($first_name);
    $profile['fullname'] = $first_name.' '.$handle.' '.$surname;
    return $profile;


}

function RAND_PICTURE($gender = 'male', $type = 'nat')
{
    $dir = './img/profile/'.$gender.'/'.$type;
    $files = glob($dir . '/*.jpg');
    $file = array_rand($files);
    return $files[$file];
}

function RENDER_STATBLOCK ($statblock)
{
    $attributes = strtr('
    <div class="sysop-stat-table"><table class=""><tr class="sysop-stat"><td >Brawn</td><td>Agility</td><td>Intellect</td><td>Cunning</td><td>Willpower</td><td>Presence</td></tr>
    <tr><td>0</td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td>
    <tr class="sysop-stat"><td>Soak</td><td>Wound Th</td><td>Strain Th</td><td>M/R Def</td>
    <tr><td>6</td><td>7</td><td>8</td><td>9</td></tr></table></div><br/>
    ',$statblock[0]);
    $attributes .= '<div><b>Skills:</b> '.$statblock[1].'</div>';
    $attributes .= '<div><b>Talents:</b> '.RENDER_GENESYS_SYMBOL($statblock[2]).'</div>';
    $attributes .= '<div><b>Abilities:</b> '.RENDER_GENESYS_SYMBOL($statblock[3]).'</div>';
    $attributes .= '<div><b>Equipment:</b> '.$statblock[4].'</div>';
    return $attributes;
}

function RENDER_GENESYS_SYMBOL($string)
{
    $pre_string = '<span class="gensymbol">';
    $post_string = '</span>';
    $replace_pairs = array(
        '{s}' => $pre_string . 's' . $post_string,
        '{a}' => $pre_string . 'a' . $post_string,
        '{t}' => $pre_string . 't' . $post_string,
        '{f}' => $pre_string . 'f' . $post_string,
        '{h}' => $pre_string . 'h' . $post_string,
        '{d}' => $pre_string . 'd' . $post_string,
        );
    /*
    s - Success
    a - Advantage
    t - Triumph
    f - failure
    h - threat
    d - despair
    */
    return strtr($string,$replace_pairs);
}

function RENDER_STATBLOCK_OLD ($statblock)
{
    $attributes = strtr('
    <div class="sysop-stat-table"><table class=""><tr class="sysop-stat"><td >Brawn</td><td>Agility</td><td>Intellect</td><td>Cunning</td><td>Willpower</td><td>Presence</td></tr>
    <tr><td>0</td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td>
    <tr class="sysop-stat"><td>Soak</td><td>Wound Th</td><td>M Def</td><td>R Def</td>
    <tr><td>6</td><td>7</td><td>8</td><td>9</td></tr></table></div>
    ',$statblock[0]);
    $attributes .= '<p><b>Skills:</b> '.$statblock[1].'</p>';
    $attributes .= '<p><b>Talents:</b> '.$statblock[2].'</p>';
    $attributes .= '<p><b>Abilities:</b> '.$statblock[3].'</p>';
    $attributes .= '<p><b>Equipment:</b> '.$statblock[4].'</p>';
    return $attributes;
}

/* Template
    * Brawn, Agility, Intellect, Cunning, Willpower, Presence, Soak, Wound, M/R Defence
    * Skills
    * Talents
    * Abilities
    * Equipment

//Corporate Manager
array(
    array(2,2,3,2,2,3,2,9,0,0),
    "Charm 1, Computers (Sysops) 1, Deception 2, Knowledge (Society) 1, Leadership 3, Negotiation 2, Perception 2.",
    "None",
    "None",
    "Smartsuit, PAD.")
*/
?>