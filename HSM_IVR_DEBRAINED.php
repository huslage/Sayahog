<?php

//define("MAINT_MODE", true)
//define("MAINT_MESSAGE","The system is undergoing maintenance. Please call back later.")


// geocode stuff
define("MAPS_LOOKUP_BASE_URL", "http://maps.googleapis.com/maps/api/geocode/json");
define("USHAHIDI_BASE_URL", "http://ec2-50-112-5-172.us-west-2.compute.amazonaws.com/admin");
define("USHAHIDI_USER_NAME", "admin");
define("USHAHIDI_PASSWORD", "admin");
define("P_DELAY","100"); // prompt speed control


// incident code -> description
$incident_code = array();
$incident_code['1']['Health worker asked for bribe to admit you or treat you in hospital.'];
$incident_code['2']['You were asked to pay money after delivery.'];
$incident_code['3']['You were asked to pay for drugs, blood, tests, etc.'];
$incident_code['4']['You were asked to purchase drugs, gloves, soap etc from outside.'];
$incident_code['5']['The staff asked you to go to another hospital without a referral slip.'];
$incident_code['6']['You were asked a bribe for payments of JSY.'];
$incident_code['7']['Had to pay for the vehicle that brought you to hospital.'];
$incident_code['8']['Were asked to pay for or not provided with food during your stay in the JSSK hospitals.'];
$incident_code['9']['Were not provided with free drop back facility from JSSK hospitals.'];
$incident_code['0']['This is a situation which might result in death of the woman/child and no action is being taken by the staff.'];

// create a hash for the survey to live in during this call
$calldata = array();

// secret decoder ring for health facilities
// site number (key): site, location, phone
// these sites are in the Azamgar District
$sites = array();
$sites['0001'] = array('site'=>'Azamgarh Sadar Mahila Hospital', 'location'=>'26.063777,83.183628', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0002'] = array('site'=>'Phoolpur', 'location'=>'26.044017,82.520839', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0003'] = array('site'=>'Lalganj', 'location'=>'25.450143,82.59002', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0004'] = array('site'=>'Atraulia', 'location'=>'26.10495,82.541362', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0005'] = array('site'=>'Koilsa', 'location'=>'26.181165,82.581841', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0006'] = array('site'=>'Pawayi', 'location'=>'26.155774,83.011249', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0007'] = array('site'=>'Mehnagr', 'location'=>'25.525119,83.065119', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0008'] = array('site'=>'Haraiya', 'location'=>'26.645412,83.928797', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0009'] = array('site'=>'Ahiraula', 'location'=>'26.104961,82.541324', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0010'] = array('site'=>'Martinganj', 'location'=>'25.570156,82.47313', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0011'] = array('site'=>'Palhni', 'location'=>'26.021551,83.09345', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0012'] = array('site'=>'Rani ki Sarai', 'location'=>'26.000459,83.062549', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0013'] = array('site'=>'Mohammdpur', 'location'=>'25.575318,83.014912', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0014'] = array('site'=>'Mirzapur', 'location'=>'26.035728,82.565781', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0015'] = array('site'=>'Tahbarpur', 'location'=>'26.095543,83.060374', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0016'] = array('site'=>'Jahanaganj', 'location'=>'25.494027,83.13071', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0017'] = array('site'=>'Sathiyav', 'location'=>'26.075659,82.53107', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0018'] = array('site'=>'Thekma', 'location'=>'25.530044,82.565966', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0019'] = array('site'=>'Tarwa', 'location'=>'25.450617,83.111857', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0020'] = array('site'=>'Ajmatgarh', 'location'=>'26.166292,83.36433', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0021'] = array('site'=>'Bilariyaganj', 'location'=>'26.120036,83.134831', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0022'] = array('site'=>'Maharajganj', 'location'=>'26.152813,83.064907', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
// everything below here is in the Mizrapur District
$sites['0023'] = array('site'=>'Mirzapur District Women\'s Hospital', 'location'=>'25.154094,82.577234', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District');
$sites['0024'] = array('site'=>'Chunar', 'location'=>'25.061756,82.520419', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District');
$sites['0025'] = array('site'=>'Madihan', 'location'=>'24.550976,82.403875', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District');
$sites['0026'] = array('site'=>'Lalganj', 'location'=>'24.594401,82.202413', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District');
$sites['0027'] = array('site'=>'Majavah', 'location'=>'25.266431,82.709198', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District');
$sites['0028'] = array('site'=>'Rajgarh', 'location'=>'24.525589,82.52173', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District');
$sites['0029'] = array('site'=>'Haliya', 'location'=>'24.491444,82.185563', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District');
$sites['0030'] = array('site'=>'Vijaypur', 'location'=>'25.073399,82.378023', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District');
$sites['0031'] = array('site'=>'Jamalpur', 'location'=>'25.09245,83.052788', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District');
$sites['0032'] = array('site'=>'Chil', 'location'=>'25.152229,82.563699', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District');

// basic ask settings
$timeout = 60.0; $attempts = 3; $bargein = false; $askmode = "dtmf";

function ivr_run () {
// check if we're in maint mode, then get started.
if(MAINT_MODE) { maintenance(MAINT_MESSAGE) };

// basic ask settings
$timeout = 60.0; $attempts = 3; $bargein = false; $askmode = "dtmf";

// pull in the globals we made earlier
global $calldata, $sites, $incident_code;
    
// collect the caller's info
$calldata = array(); $calldata['caller_number'] = $currentCall->callerID;
$calldata['network']    = $currentCall->network;
$calldata['callername'] = ($currentCall->callerName) ? false : $currentCall->callerName;

// let's talk
answer();

// 0.1 IVRS - Welcome Message
say("http://hosting.tropo.com/104666/www/sayahog/audio/0_1_Welcome_Message.gsm"); wait(600);



// IVRS 1.1 - Please enter the 4 digit code of the health centre
$check_hc = create_function('$a','return (array_key_exists($a,$sites) ? $a : false'); 
ask("http://hosting.tropo.com/104666/www/sayahog/audio/1_1_Enter_4_digit_code_number.gsm",
    array("choices" => $check_hc,
	  $options)
}

// get data from the caller.
function get_input($prompt, $options




// helper function for the ask function
function inquisitor($grievances, $request, $choices, $nextfunc) {    
    global $survey_data;
    foreach ($grievances as $grievance) {
        say("$grievance"); wait(P_DELAY);
    }

    ask("$request", array(
    "choices"               => $choices,
    "interdigitTimeout"     => 20,
    "mode"	            => "dtmf",
    "bargein"               => $true,
    "attempts"              => 15,
    "onChoice"	            => $nextfunc,
    "onBadChoice"           => "check_code")
    );
}

// IVRS 0.3 - Try again later
function sorry_message ($event) {
    global $survey_data;
    say("http://hosting.tropo.com/104666/www/sayahog/audio/0_2_End_Message_1_Thank_You.gsm");
    _log("IVRS 0.3 - Caller at $currentCall->CallerId was unable to use the menu :(");
    wait(10000); main();
}
  

function check_code ($event) {
    //say("Checking 4 digit code $event->value");
    global $survey_data, $sites;
    $e = $event->value;
    if (array_key_exists($e,$sites)) {
        //say("Found site $e!"); wait(1000);
	verify_selection($event);
    } else {
        //say("Code $e does not exist. Try again?");
	wait(1000);
	main();
    }
}
    				

					      


function verify_selection ($event) {
    global $survey_data, $sites;
    $site = $event->value;
    $survey_data['site'] = $sites[$site];
    $survey_data['site_number'] = $site;
    $selected = array();
    $selected = "http://hosting.tropo.com/104666/www/sayahog/audio/part_1__you_have_entered_the_code_xxxx.gsm";
    $selected = "http://hosting.tropo.com/104666/www/sayahog/audio/" . $site . "_Code.gsm";
    $selected = "http://hosting.tropo.com/104666/www/sayahog/audio/part_2__which_corresponds_to.gsm";
    $selected = "http://hosting.tropo.com/104666/www/sayahog/audio/" . $site . "_Name.gsm"; 
    $request  = "http://hosting.tropo.com/104666/www/sayahog/audio/part_3__end_of_1st_sentence_and_2nd_sentence_press_1_or_2.gsm";
    inquisitor($selected, $request, "[1 DIGIT]", "select_incident_type");
}

// IVRS 2.1 - Type of incident
function select_incident_type ($event) {
    global $survey_data;
    $incidentq     = array();
    $incidentq[1]  = "http://hosting.tropo.com/104666/www/sayahog/audio/2_1_Listen_Carefully.gsm";
    $incidentq[2]  = "http://hosting.tropo.com/104666/www/sayahog/audio/2_1_Press_0.gsm";
    $incidentq[3]  = "http://hosting.tropo.com/104666/www/sayahog/audio/2_1_Press_1.gsm";
    $incidentq[4]  = "http://hosting.tropo.com/104666/www/sayahog/audio/2_1_Press_2.gsm";
    $incidentq[5]  = "http://hosting.tropo.com/104666/www/sayahog/audio/2_1_Press_3.gsm";
    $incidentq[6]  = "http://hosting.tropo.com/104666/www/sayahog/audio/2_1_Press_4.gsm";
    $incidentq[7]  = "http://hosting.tropo.com/104666/www/sayahog/audio/2_1_Press_5.gsm";
    $incidentq[8]  = "http://hosting.tropo.com/104666/www/sayahog/audio/2_1_Press_6.gsm";
    $incidentq[9]  = "http://hosting.tropo.com/104666/www/sayahog/audio/2_1_Press_7.gsm";
    $incidentq[10] = "http://hosting.tropo.com/104666/www/sayahog/audio/2_1_Press_8.gsm";
    $request       = "http://hosting.tropo.com/104666/www/sayahog/audio/2_1_Press_9.gsm";
    $answers = range(0,9);
    inquisitor($incidentq, $request, $answers, 'incident_action');
}

// IVRS 2.1.i - Action
function incident_action ($event) {
    global $survey_data, $incident_code;
    $incident_type = $event->value;
    $survey_data['incident_code'] = $incident_type;
    $survey_data['incident_description'] = $incident_code[$incident_type];
    //if ($incident_action == 0) { // break out and do the siren thing }
    if ($incident_action < 9 ) {
        money_demanded();
    }
}

// IVRS 3.1 - Money asked/spent
function money_demanded () {
    global $survey_data;
    $moneyq = array();
    $moneyq[1] = "http://hosting.tropo.com/104666/www/sayahog/audio/3_1_a__if_spent_less_that_500_or_more_than_500.gsm ";
    $moneyq[2] = "http://hosting.tropo.com/104666/www/sayahog/audio/Less_than_500.gsm ";
    $moneyq[3] = "http://hosting.tropo.com/104666/www/sayahog/audio/More_than_500.gsm";
    $answers = '1,2';
    inquisitor($messages, $request, $answers, 'confirmation');
}

// IVRS 1.3 - Summary for Confirmation
function confirmation($event) {
    global $survey_data;
    $money_demanded = $event->value;
    $survey_data['money_code'] = $money_demanded;
    if ($money_demanded > 1) { 
       $survey_data['money_demanded'] = 'More_than_500';
    } else { 
       $survey_data['money_demanded'] = 'Less_than_500';
    }
    $confmsg = array();
    $confmsg[0] = "http://hosting.tropo.com/104666/www/sayahog/audio/part_1_you.gsm";
    $confmsg[1] = "http://hosting.tropo.com/104666/www/sayahog/audio/" . $survey_data['site_number'] . "_Name.gsm";
    $confmsg[2] = "http://hosting.tropo.com/104666/www/sayahog/audio/part_2_name_of_hospital_details.gsm";
    $confmsg[3] = "http://hosting.tropo.com/104666/www/sayahog/audio/" . $survey_data['money_demanded'] . ".gsm";
    $request = "http://hosting.tropo.com/104666/www/sayahog/audio/part_3_amount_money.gsm";
    inquisitor($confmsg, $request, "1,2", 'capture_or_reset');
}

// U-turn folks who want another shot
function capture_or_reset ($event) {
    global $survey_data;
    _log("in capture_or_reset");
    if ($event == 1) { 
        capture_data();
    }
    else if ($event == 2) { 
	select_incident_type();
    }
}


// IVRS 1.4 Reporting an incident of corruption
function report_incident ($event) {
    global $survey_data;
    // report the incident?
}

// hand data to ushahidi
function capture_data () {
    global $survey_data;
    _log(json_encode($survey_data));
    byenow();
}
        

function byenow () {
    say("http://hosting.tropo.com/104666/www/sayahog/audio/0_2_End_Message_1_Thank_You.gsm");
    hangup();
}

// IVR MAIN
function main () {
    // bail if system's in maintenance mode

    $calldata['healthcenter'] = is_object(select_healthcenter()) ? $
    answer();
    if (say("The help line will be activated soon. Please call again later.", array("voice" => "kate"));
    wait(100);
    hangup();
}

// !! LOCKDOWN !!
  function maintenance ($message, $supers) {
    // check to see if it's a superuser and do something else
    // if (($currentCall->network == 'Skype') && ($currentCall->callerName
    if ($message) {  
        say($message); hangup(); 
    }
  }

// admin whitelist
$supers = array();
$supers['aaronmathews'] = 'skype'; $supers['huslage'] = 'skype';

// let's get this party started
main()

?>