<?php
define ("SERVER_NAMES", [
    ['Traffic Cam','Tube-lev ticket dispenser','Simple machine','Toy','Old FriendNet Account'],
    ['Factory Settings PAD','Factory Settings Personal Computer','Public Network Terminal',"NAPD Street Cam","Sewer System Lock"],
    ['Standard Security PAD','Standard Security Personal Computer','Residential Lock','Small-business server','Delivery drone control system','Megabuy customer service department'],
    ["Hopper Control System","Megabuy corporate servers","NAPD Servers"],
    ["Government Server","Jinteki Server","Haas-Bioroid Server","Weyland Consortium Server"],
    ["Corporate black-site server","Beanstalk control system"]
    ]);
define ("DEBUG", false);
define ("SYSTEM_MIN_NUM",30);
define ("SYSTEM_MAX_NUM",45);
define ("GREAT_WALL",15);

define ("MYERS_BRIGGS", [
    '{$name} is an imaginative idealist, guided by their own core values and beliefs. To {$name} possibilities are paramount; the reality of the moment is only of passing concern. They see potential for a better future, and pursue truth and meaning with their own flair.'
    ,'{$name} is an analytical problem-solver, eager to improve systems and processes with their innovative ideas. They have a talent for seeing possibilities for improvement, whether at work, at home, or in themselves.'
    ,'{$name} is a creative nurturer with a strong sense of personal integrity and a drive to help others realize their potential. Creative and dedicated, they have a talent for helping others with original solutions to their personal challenges.'
    ,'{$name} is a philosophical innovator, fascinated by logical analysis, systems, and design. {$name} is preoccupied with theory, and search for the universal law behind everything they see. They want to understand the unifying themes of life, in all their complexity.'
    ,'{$name} is a people-centered creator with a focus on possibilities and a contagious enthusiasm for new ideas, people and activities. Energetic, warm, and passionate, {$name} loves to help other people explore their creative potential.'
    ,'{$name} is a strategic leader, motivated to organize change. They are quick to see inefficiency and conceptualize new solutions, and enjoy developing long-range plans to accomplish their vision. {$name} excels at logical reasoning and are usually articulate and quick-witted.'
    ,'{$name} is an inspired innovator, motivated to find new solutions to intellectually challenging problems. They are curious and clever, and seek to comprehend the people, systems, and principles that surround them.'
    ,'{$name} is an idealist organizer, driven to implement their vision of what is best for humanity. {$name} often acts as a catalyst for growth because of their ability to see potential in other people and their charisma in persuading others to their ideas.'
    ,'{$name} is an industrious caretaker, loyal to traditions and organizations. {$name} is practical, compassionate, and caring, and they are motivated to provide for others and protect them from the perils of life.'
    ,'{$name} is a gentle caretaker who lives in the present moment and enjoys their surroundings with cheerful, low-key enthusiasm. They are flexible and spontaneous, and like to go with the flow to enjoy what life has to offer.'
    ,'{$name} is a responsible organizer, driven to create and enforce order within systems and institutions. {$name} is neat and orderly, inside and out, and tends to have a procedure for everything they do.'
    ,'{$name} is an observant artisan with an understanding of mechanics and an interest in troubleshooting. They approach their environments with a flexible logic, looking for practical solutions to the problems at hand.'
    ,'{$name} is a conscientious helper, sensitive to the needs of others and energetically dedicated to their responsibilities. {$name} is highly attuned to their emotional environment and attentive to both the feelings of others and the perception others have of them.'
    ,'{$name} is a vivacious entertainer who charms and engages those around them. {$name} is spontaneous, energetic, and fun-loving, and takes pleasure in the things around them: food, clothes, nature, animals, and especially people.'
    ,'{$name} is a hardworking traditionalist, eager to take charge in organizing projects and people. Orderly, rule-abiding, and conscientious, {$name} likes to get things done, and tend to go about projects in a systematic, methodical way.'
    ,'{$name} is an energetic thrillseeker who are at their best when putting out fires, whether literal or metaphorical. They bring a sense of dynamic energy to their interactions with others and the world around them.'
]);

define ("SYSOP_RESPONSE", [
    'Lockout runners at 1 trace. Offline entire server for rest of the day after 2 attempts and spend the rest of the day looking for a new job',
    'Lockout runners after 2 traces. Offline entire server for rest of the day after 4 attempts and report to NAPD Netcrimes non-emergency line. Two NAPD Detectives (pg229) check on the PCs location at the end of the next day',
    'Sysop puts out a call for whitehats after 1 trace a Principled Runner (pg223) who helps trace then tries to counter-hack the runners.',
    'Lockout runners after 3 traces and call in a Orgcrime Lieutenant and two groups of 3 Orgcrime Muscle minions (pg222) to start searching the area for the PCs. They arrive after 10 rounds',
    'Lockout runners after 3 traces and call NAPD Netcrimes emergency hotline. Four NAPD Patrol Officers (pg229) respond to the area after 8 rounds and start searching the area door-to-door',
    'Call in Corporate Manager (pg224) who joins the server after 1 trace. Lockout runners at 4 traces and manager calls a friend in the NAPD Netcrimes division. Two NAPD Detectives (pg229) check the PCs location 15 rounds later',
    'Calls in Criminal Runner (pg 221), who connects to the server after 2 rounds and counter hacks, Lockout runners after 4 traces and call a Yakuza Assassin (pg224) who arrives in 10 rounds but will scout or follow the PCs before engaging.',
    'Lockout runners at 4 traces and report incident to CEO who calls the head of NAPD Netcrimes. 6 NAPD SWAT (pg230) breach the PCs location 10 rounds later',
    'Call in SYNC Globalsec after 2 traces who has SYNC Globalsec Agent (pg226) join the server. At 4 traces begin to hack Runner`s system. Use Net Warrior and Swordbreaker to target runners. Another agent joins every 5 rounds after the first',
    'Call in Electronic Warfare Service who has an EWS Raider join the server after 2 traces. Lockout runners at 4 traces and EWS call in drone strike (pg 234) at the runner`s location, which arrives after 3 rounds and starts shooting missiles at the PCs location'
]);


define ("INITIAL_MOOD", [
    '(Asleep, Disconnected) {$name} will never connect to the server, unless there is a major alert',
    '(Distracted, Disconnected) {$name} takes two alerts by ice or a single alert from physical security. Takes 1 round after the alert to connect to the server',
    '(On-Call, Disconnected) {$name} will not take any action until alerted by ice or physical security. Takes 1 round after the alert to connect to the server',
    '(Distracted, Connected) {$name} will not perform <b>Sweep</b> until alerted by ice or physical security',
    '(Tired, Connected) {$name} performs actions each round but all checks have one extra <img class="difficulty" src="./symbol/black.png"/>',
    '(Overworked, Disconnected) {$name} will connect to the system every other round to perform actions due to defending multiple servers at once',
    '(Bored, Connected) Before an intruder is detected {$name} performs <b>Sweep</b> (<img class="difficulty" src="./symbol/purple.png"/><img class="difficulty" src="./symbol/purple.png"/><img class="difficulty" src="./symbol/purple.png"/>) every other round',
    '(Paranoid, Connected) Before an intruder is detected {$name} performs <b>Sweep</b> (<img class="difficulty" src="./symbol/purple.png"/><img class="difficulty" src="./symbol/purple.png"/><img class="difficulty" src="./symbol/purple.png"/>) every round with <img class="difficulty" src="./symbol/black.png"/> due to chasing after any signal on the network',
    '(Observant, Connected) Before an intruder is detected {$name} performs <b>Sweep</b> (<img class="difficulty" src="./symbol/purple.png"/><img class="difficulty" src="./symbol/purple.png"/><img class="difficulty" src="./symbol/purple.png"/>) every round',
    '(Vigilant, Connected) Before an intruder is detected {$name} performs <b>Sweep</b> (<img class="difficulty" src="./symbol/purple.png"/><img class="difficulty" src="./symbol/purple.png"/><img class="difficulty" src="./symbol/purple.png"/>) every round with a bonus <img class="difficulty" src="./symbol/blue.png"/>'
    ]
);

define ("SYSOP_STAT_BLOCKS", [
    /* Template
     * Brawn, Agility, Intellect, Cunning, Willpower, Presence, Soak, Wound, M/R Defence
     * Skills
     * Talents
     * Abilities
     * Equipment
     */
    //Corporate Manager
    array(
        array(2,2,3,2,2,3,2,9,"n/a","0/0"),
        "Charm 1, Computers (Sysops) 1, Deception 2, Knowledge (Society) 1, Leadership 3, Negotiation 2, Perception 2.",
        "None",
        "Corporate Oversight (when performing the assist maneuver, add {s} {h} {h} to the result instead of adding a boost die",
        "Smartsuit, PAD."),
    //Corporate Sysop
    array(
        array(1,1,3,2,2,3,1,9,"n/a","0/0"),
        "Computers (Sysops) 2, Knowledge (The Net) 2, Mechanics 1, Perception 1, Vigilance 2.",
        "None",
        "Reinforce (as a maneuver, may increase the strength of one active piece of ice by 1 until the end of the corporate sysop’s next turn).",
        "PAD, corporate ID, snacks."
        ),
    //SYNC GLOBALSEC AGENT
    array(
        array(1,2,5,3,3,2,2,10,15,"0/0"),
        "Computers (Hacking) 2, Computers (Sysops) 3, Knowledge (The Net) 4, Mechanics 2, Perception 2.",
        "Net Warrior (when using a BMI, may make an <b>opposed Computers [Hacking] versus Computers [Sysops] check</b> targeting one character accessing the system;
        the target suffers 1 strain per {s}, and if they are using a BMI, they also suffer 1 wound per {s}).",
        "Reinforce (as a maneuver, may increase the strength of one active piece of ice by 1 until the end of the corporate sysop’s next turn).",
        "PAD, corporate ID, snacks."
    )
]);

?>