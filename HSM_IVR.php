<?php

// !!! MAINTENANCE MODE LEVER !!!
define("MAINT", true);
define("MAINTPW", '*99');
define("MAINT_MSG","The help line is currently undergoing maintenance. Please call again later.",array("voice" => "kate"));


// geocode stuff
define("MAPS_LOOKUP_BASE_URL", "http://maps.googleapis.com/maps/api/geocode/json");
define("USHAHIDI_BASE_URL", "http://ec2-50-112-5-172.us-west-2.compute.amazonaws.com/admin");
define("USHAHIDI_USER_NAME", "admin");
define("USHAHIDI_PASSWORD", "admin");
define("P_DELAY","100"); // delay between prompts in milliseconds


// incident code -> description 
$icode = array();
$icode['1']['Health worker asked for bribe to admit you or treat you in hospital.'];
$icode['2']['You were asked to pay money after delivery.'];
$icode['3']['You were asked to pay for drugs, blood, tests, etc.'];
$icode['4']['You were asked to purchase drugs, gloves, soap etc from outside.'];
$icode['5']['The staff asked you to go to another hospital without a referral slip.'];
$icode['6']['You were asked a bribe for payments of JSY.'];
$icode['7']['Had to pay for the vehicle that brought you to hospital.'];
$icode['8']['Were asked to pay for or not provided with food during your stay in the JSSK hospitals.'];
$icode['9']['Were not provided with free drop back facility from JSSK hospitals.'];
$icode['0']['This is a situation which might result in death of the woman/child and no action is being taken by the staff.'];

// where all them audio files at?!
define("AURL","http://hosting.tropo.com/104666/www/sayahog/audio/");
define("ATYPE",".gsm");

// secret decoder ring for health facilities
// site number (key): site, location, phone
// these sites are in the Azamgar District
$sites = array();
$sites['0001'] = array('name'=>'Azamgarh Sadar Mahila Hospital', 'location'=>'26.063777,83.183628', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0002'] = array('name'=>'Phoolpur', 'location'=>'26.044017,82.520839', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0003'] = array('name'=>'Lalganj', 'location'=>'25.450143,82.59002', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0004'] = array('name'=>'Atraulia', 'location'=>'26.10495,82.541362', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0005'] = array('name'=>'Koilsa', 'location'=>'26.181165,82.581841', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0006'] = array('name'=>'Pawayi', 'location'=>'26.155774,83.011249', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0007'] = array('name'=>'Mehnagr', 'location'=>'25.525119,83.065119', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0008'] = array('name'=>'Haraiya', 'location'=>'26.645412,83.928797', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0009'] = array('name'=>'Ahiraula', 'location'=>'26.104961,82.541324', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0010'] = array('name'=>'Martinganj', 'location'=>'25.570156,82.47313', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0011'] = array('name'=>'Palhni', 'location'=>'26.021551,83.09345', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0012'] = array('name'=>'Rani ki Sarai', 'location'=>'26.000459,83.062549', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0013'] = array('name'=>'Mohammdpur', 'location'=>'25.575318,83.014912', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0014'] = array('name'=>'Mirzapur', 'location'=>'26.035728,82.565781', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0015'] = array('name'=>'Tahbarpur', 'location'=>'26.095543,83.060374', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0016'] = array('name'=>'Jahanaganj', 'location'=>'25.494027,83.13071', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0017'] = array('name'=>'Sathiyav', 'location'=>'26.075659,82.53107', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0018'] = array('name'=>'Thekma', 'location'=>'25.530044,82.565966', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0019'] = array('name'=>'Tarwa', 'location'=>'25.450617,83.111857', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0020'] = array('name'=>'Ajmatgarh', 'location'=>'26.166292,83.36433', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0021'] = array('name'=>'Bilariyaganj', 'location'=>'26.120036,83.134831', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
$sites['0022'] = array('name'=>'Maharajganj', 'location'=>'26.152813,83.064907', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District');
// everything below here is in the Mizrapur District
$sites['0023'] = array('name'=>'Mirzapur District Women\'s Hospital', 'location'=>'25.154094,82.577234', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District');
$sites['0024'] = array('name'=>'Chunar', 'location'=>'25.061756,82.520419', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District');
$sites['0025'] = array('name'=>'Madihan', 'location'=>'24.550976,82.403875', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District');
$sites['0026'] = array('name'=>'Lalganj', 'location'=>'24.594401,82.202413', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District');
$sites['0027'] = array('name'=>'Majavah', 'location'=>'25.266431,82.709198', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District');
$sites['0028'] = array('name'=>'Rajgarh', 'location'=>'24.525589,82.52173', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District');
$sites['0029'] = array('name'=>'Haliya', 'location'=>'24.491444,82.185563', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District');
$sites['0030'] = array('name'=>'Vijaypur', 'location'=>'25.073399,82.378023', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District');
$sites['0031'] = array('name'=>'Jamalpur', 'location'=>'25.09245,83.052788', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District');
$sites['0032'] = array('name'=>'Chil', 'location'=>'25.152229,82.563699', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District');
// end decoder ring

// ask ask ask ask ask ask
function inquisitor($grievances, $request, $choices, $nextfunc) {    
    global $cinfo;
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
    global $cinfo;
    isay("0_2_End_Message_1_Thank_You");
    _log("IVRS 0.3 - Caller at $currentCall->CallerId was unable to use the menu :(");
    wait(10000); main();
}
  
// IVRS 1.1 - Please enter the 4 digit code of the health centre
/* function select_healthcenter () { */
/*     global $cinfo, $sites; */
/*     $choices = implode(",", array_keys($sites)); */
    



/*     ask("1_1_Enter_4_digit_code_number . ATYPE", array( */
/*     "choices"               => "[4 DIGITS]", */
/*     "timeout"               => 45, */
/*     "interdigitTimeout"     => 20, */
/*     "mode"	            => "dtmf", */
/*     "bargein"               => $true, */
/*     "attempts"              => 15, */
/*     "onChoice"	            => "check_code", */
/*     "onBadChoice"           => "check_code") */
/*     ); */
/* } */

/* function check_code ($event) { */
/*     //say("Checking 4 digit code $event->value"); */
/*     global $cinfo, $sites; */
/*     $e = $event->value; */
/*     if (array_key_exists($e,$sites)) { */
/*         //say("Found site $e!"); wait(1000); */
/* 	verify_selection($event); */
/*     } else { */
/*         //say("Code $e does not exist. Try again?"); */
/* 	wait(1000); */
/* 	main(); */
/*     } */
/* } */
    				

					      


function verify_selection ($event) {
    global $cinfo, $sites;
    $site = $event->value;
    $cinfo['site_name'] = $sites[$site]['name'];
    $cinfo['site_number'] = $site;
    $selected = array();
    $selected = "part_1__you_have_entered_the_code_xxxx . ATYPE";
    $selected = "" . $site . "_Code . ATYPE";
    $selected = "part_2__which_corresponds_to . ATYPE";
    $selected = "" . $site . "_Name . ATYPE"; 
    $request  = "part_3__end_of_1st_sentence_and_2nd_sentence_press_1_or_2 . ATYPE";
    inquisitor($selected, $request, "[1 DIGIT]", "select_itype");
}

// IVRS 2.1 - Type of incident
function select_itype ($event) {
    global $cinfo;
    $incidentq     = array();
    $incidentq[1]  = "2_1_Listen_Carefully . ATYPE";
    $incidentq[2]  = "2_1_Press_0 . ATYPE";
    $incidentq[3]  = "2_1_Press_1 . ATYPE";
    $incidentq[4]  = "2_1_Press_2 . ATYPE";
    $incidentq[5]  = "2_1_Press_3 . ATYPE";
    $incidentq[6]  = "2_1_Press_4 . ATYPE";
    $incidentq[7]  = "2_1_Press_5 . ATYPE";
    $incidentq[8]  = "2_1_Press_6 . ATYPE";
    $incidentq[9]  = "2_1_Press_7 . ATYPE";
    $incidentq[10] = "2_1_Press_8 . ATYPE";
    $request       = "2_1_Press_9 . ATYPE";
    $answers = range(0,9);
    inquisitor($incidentq, $request, $answers, 'incident_action');
}

// IVRS 2.1.i - Action
function incident_action ($event) {
    global $cinfo, $icode;
    $itype = $event->value;
    $cinfo['icode'] = $itype;
    $cinfo['incident_description'] = $icode[$itype];
    //if ($incident_action == 0) { // break out and do the siren thing }
    if ($incident_action < 9 ) {
        money_demanded();
    }
}

// IVRS 3.1 - Money asked/spent
function money_demanded () {
    global $cinfo;
    $moneyq = array();
    $moneyq[1] = "3_1_a__if_spent_less_that_500_or_more_than_500 . ATYPE ";
    $moneyq[2] = "Less_than_500 . ATYPE ";
    $moneyq[3] = "More_than_500 . ATYPE";
    $answers = '1,2';
    inquisitor($messages, $request, $answers, 'confirmation');
}

// IVRS 1.3 - Summary for Confirmation
function confirmation($event) {
    global $cinfo;
    $money_demanded = $event->value;
    $cinfo['money_code'] = $money_demanded;
    if ($money_demanded > 1) { 
       $cinfo['money_demanded'] = 'More_than_500';
    } else { 
       $cinfo['money_demanded'] = 'Less_than_500';
    }
    $confmsg = array();
    $confmsg[0] = "part_1_you . ATYPE";
    $confmsg[1] = "" . $cinfo['site_number'] . "_Name . ATYPE";
    $confmsg[2] = "part_2_name_of_hospital_details . ATYPE";
    $confmsg[3] = "" . $cinfo['money_demanded'] . " . ATYPE";
    $request = "part_3_amount_money . ATYPE";
    inquisitor($confmsg, $request, "1,2", 'capture_or_reset');
}

// U-turn folks who want another shot
function capture_or_reset ($event) {
    global $cinfo;
    _log("in capture_or_reset");
    if ($event == 1) { 
        capture_data();
    }
    else if ($event == 2) { 
	select_itype();
    }
}


// IVRS 1.4 Reporting an incident of corruption
function report_incident ($event) {
    global $cinfo;
    // report the incident?
}

// hand data to ushahidi
function capture_data ($cinfo) {
    global $cinfo;
    _log(json_encode($cinfo));
    byenow();
}
        
function flog ($message) {
  // TODO: create a logging class that will let us see our messages more easily
}
  
// wrapper for say()- includes the prefix/suffix.
function isay ($message, $rs=false) { // rs is a bool for 'return string'
  $message = (AURL . $message . ATYPE); _log("isay $message");
  if($rs){return $message;} else {say($message);}
}

function byenow () {
    isay("0_2_End_Message_1_Thank_You");
    hangup();
}

function supers() {
  $maint_auth = true;
  _log("supers coming in from " . $currentCall->callerID);
  main($maint_auth);
}


// IVR MAIN
function main ($maint_auth = false) {
  global $sites, $itypes;
  if ($maint_auth) { 
    say("Welcome to the matrix"); 
  } else {
    if (MAINT) { 
      say(MAINT_MESSAGE); 
      ask("",array("choices" => MAINTPW, "timeout" => 20.0, onTimeout => "hangup", "onChoice" => "supers")); 
      _log("Somebody called during maintenance: " . $currentCall->callerID); hangup(); }
  }
  $cinfo = array();
  $cinfo['caller_number'] = $currentCall->callerID;
  $cinfo['network'] = $currentCall->network;
  if ($currentCall->callerName) {$cinfo['callername'] = $currentCall->callerName;}
  answer();
  // 0.1 IVRS - Welcome Message
  isay("0_1_Welcome_Message"); wait(600);
  // 1.1 IVRS - Get healthcare center
  $cinfo['site_code'] = get_sitecode();
  $cinfo['site_name'] = get_sitename();
  // 1.2 IVRS - Verify site info
  $cinfo['site_verified']    = verify_siteinfo($cinfo);
  // 2.1 IVRS - Choose type of incident
  $cinfo['incident_code']    = get_itype(); $cinfo['incident_type'] = $icode[$cinfo['icode']]; // get the bigger description in there too
  // 2.1i - TAKE ACTION
  // emergency center instruction?
  $cinfo['facility_phone'] = hospital_lookup($cinfo['site_code']);
  say("Transferring you to the hospital at " . $cinfo['facility_phone']);
  

  
  
}

// let's get this party started
main()

?>