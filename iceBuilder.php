<?php

function RAND_ICE($ice_list)
{
    global $ice_used;
    global $max_same_ice;
    $ice = $ice_list[rand(0,count($ice_list)-1)];
    $i = 0;
    do{
        $i++;
        array_push($ice_used,$ice);
        return $ice;
    }
    while(array_count_values($ice_used)[$ice] < $max_same_ice || $max_same_ice == -1 || $i <= 100);
}

function ADD_ICE($node,$layer = 1)
{
    global $adv_run;
    global $ice_barrier;
    global $ice_codegate;
    global $ice_sentry;
    global $ice_barrier_used;
    global $ice_codegate_used;
    global $ice_sentry_used;
    $multi_node = count($node) > 1; // Do we have multiple subsystems that need protection
    $tree = array();
    // 1 Layer
    if ($layer == 1)
    {
        if ($multi_node) // larger than 1 node
        {
            array_push($tree, GREAT_WALL, $node);
            $ice_barrier_used++;
        }
        elseif($adv_run) {
            //add Codegate
            if ($ice_codegate_used == 0 || ($ice_barrier_used - $ice_codegate_used) > 2)
            {
                array_push($tree,RAND_ICE($ice_codegate),$node);
                $ice_codegate_used++;
            }
            //add Barrier
            else {
                array_push($tree,RAND_ICE($ice_barrier),$node);
                $ice_barrier_used++;
            }
        }
        else {
            //add Codegate or Sentry
            if ($ice_codegate_used == 0 && $ice_sentry_used == 0)
            {
                $coinflip = rand(0,1);
                if ($coinflip == 1) array_push($tree,RAND_ICE($ice_codegate),$node);
                else array_push($tree,RAND_ICE($ice_sentry),$node);
                $ice_codegate_used++;
            }
            //add Barrier
            else {
                array_push($tree, RAND_ICE($ice_barrier), $node);
                $ice_barrier_used++;
            }
        }
    }
    // 2 Layers
    elseif ($layer == 2) {
        $temp_tree = array();
        $ice_all = array(); // add code and sentry first

        if($adv_run) {
            if($multi_node){
                //array_push($tree, GREAT_WALL, $node);
                $ice_all[0] = GREAT_WALL;
                $ice_barrier_used++;
            }
            // #1 add Codegate or Barrier + Node
            elseif ($ice_codegate_used == 0 || $ice_barrier_used - $ice_codegate_used > 2)
            {
                //array_push($temp_tree,RAND_ICE($ice_codegate),$node);
                $ice_all[0] = RAND_ICE($ice_codegate);
                $ice_codegate_used++;
            }
            //#1 add Barrier if not Code Gate + Node
            else {
                //array_push($temp_tree,RAND_ICE($ice_barrier),$node);
                $ice_all[0] = RAND_ICE($ice_barrier);
                $ice_barrier_used++;
            }
            //#2 Add Sentry + Tree
            //array_push($tree,RAND_ICE($ice_sentry),$temp_tree);
            $ice_all[1] = RAND_ICE($ice_sentry);
            $ice_sentry_used++;
        }
        else {
            $ice_all = array();
            //#1 add Barrier + node
            $ice = $multi_node ? GREAT_WALL : RAND_ICE($ice_barrier);
            //array_push($temp_tree,$ice,$node);
            $ice_all[0] = $ice;
            $ice_barrier_used++;

            //#2 add Sentry/Code gate if not used before, otherwise add second barrier = Tree
            if ($ice_codegate_used == 0 && $ice_sentry_used == 0)
            {
                $coinflip = rand(0,1);
                if ($coinflip == 1)
                {
                    //array_push($tree,RAND_ICE($ice_codegate),$temp_tree);
                    $ice_all[1] = RAND_ICE($ice_codegate);
                    $ice_codegate_used++;
                }
                else {
                    //array_push($tree,RAND_ICE($ice_sentry),$temp_tree);
                    $ice_all[1] = RAND_ICE($ice_sentry);
                    $ice_sentry_used++;
                }
            }
            // if not code/sentry add barrier + tree
            else {
                //array_push($tree, RAND_ICE($ice_barrier), $temp_tree);
                $ice_all[1] = RAND_ICE($ice_barrier);
                $ice_barrier_used++;
            }
        }
        if (!$multi_node) shuffle($ice_all);
        //Build the tree
        array_push($temp_tree,$ice_all[0],$node);
        array_push($tree,$ice_all[1],$temp_tree);
    }
    // 3 layers
    elseif ($layer == 3){
        $temp_tree = array();
        $temp_tree2 = array();
        // Select one of each shuffle and return
        $codegate = RAND_ICE($ice_codegate);
        $ice_codegate_used++;
        $sentry = RAND_ICE($ice_sentry);
        $ice_sentry_used++;

        $ice_all = array($codegate, $sentry); // add code and sentry first

        if ($multi_node)
        {
            shuffle($ice_all);
            array_unshift($ice_all,GREAT_WALL);
        }
        else{
            array_push($ice_all,RAND_ICE($ice_barrier));
            shuffle($ice_all);
        }
        $ice_barrier_used++;
        array_push($temp_tree,$ice_all[0],$node);
        array_push($temp_tree2,$ice_all[1],$temp_tree);
        array_push($tree,$ice_all[2],$temp_tree2);
    }
    // NO ICE, return early
    else return $node;
    // if we added ICE now return the tree
    return $tree;
}

function ADD_SYSTEM($system)
{
    global $target_sub_sys;
    global $difficulty;
    global $extra_sub_sys;
    global $ice_layer1;
    global $ice_layer2;
    global $ice_layer3;

    $child = array($system);
    //Add Subsystems and lower security systems may group behind one piece of ice
    if ((count($extra_sub_sys) > 0) && (rand(1, 100) >= (50 + ($difficulty * 10)))) {
        array_push($child, array_pop($extra_sub_sys));
        //oh baby a triple
        if (count($extra_sub_sys) > 0 && rand(1, 100) >= (70 + ($difficulty * 10))) {
            array_push($child, array_pop($extra_sub_sys));
        }
    }
    //Add ICE

        if ($ice_layer3 > 0)
        {
            $ice_layer3--;
            return ADD_ICE($child,3);
        }
        elseif ($ice_layer2 > 0)
        {
            $ice_layer2--;
            return ADD_ICE($child,2);
        }
        elseif ($ice_layer1 > 0)
        {
            $ice_layer1--;
            return ADD_ICE($child,1);
        }
        else return ADD_ICE($child,0);
}

function RENDER_NODE($node, $parent){
    global $nodeID;
    global $debug;
    //global $hide_ice;
    $js = '';
    $img = 0;
    $nodeID++;
    $js = 'node'.$nodeID. ' = {parent: node'.$parent.',';

    if (!is_null($node[0]))
    {
        //if (!$hide_ice || ($node[0] >= 30 && $node[0] <= 50)) $img = $node[0];
        $js = $js . 'collapsable: false, image: "img/NetworkCards'.$node[0].'.png", link: {href: "img/NetworkCards'.$node[0].'.png",target: "_blank"} };';
    }
    else $js = $js . 'pseudo: true };';
    // Now lets handle any children
    if (count($node) > 1) {
        if (is_array($node[1])) {
            $js = $js . RENDER_NODE($node[1], $nodeID);
        } else {
            for ($x = 1; $x < count($node); $x++) {
                $nodeID++;
                $js = $js . 'node' . $nodeID . ' = { parent: node' . $parent . ',';
                $js = $js . ' image: "img/NetworkCards' . $node[$x] . '.png"};';
            }
        }
    }

    return $js;
}
?>