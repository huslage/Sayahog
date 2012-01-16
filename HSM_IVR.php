<?php

// debugging messages
define("DBG", true);

// !!! MAINTENANCE MODE LEVER !!!
define("MAINT", true);
define("MAINTPW", '8');
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
function askaskask($question, $options) {    
  $result = ask($question, $options); wait(300);
  return $result;  
}


// IVRS 0.3 - Try again later
function sorry_message ($cinfo, $event) {
    if (DBG) {
      say("sorry! you're currently in the sorry message. it's a maze of twisty passages all alike.");
      _log("We're in sorry_message, so something has gone horribly wrong!");
      //      say("Sorry, sending you back to the main menu.");
      // say("Here was the information we were able to collect"); wait(2000);
      foreach ($cinfo as $k => $v) {
	_log("Key named" . $k . " with value " . $v);
      }
}
    _log("IVRS 0.3 - Caller at " . $currentCall->CallerId . " was unable to use the menu :(");
    say("ok, sending you back to the main menu!"); 
    wait(300); main();
}


function get_siteinfo ($cinfo, $cfg) {
  global $sites;
  if(DBG){_log("Currently trying to get site info.");}
  // make sure we boot them if they can't get it after 3 tries
  if ($cinfo['sv_count'] > 2) { sorry_message($cinfo); }
  // put the message together
  $question = (isay("1_1_Enter_4_digit_code_number",true));
  $choices = "[4-DIGITS]";
  $defaults = $cfg['opts'];
  $options = array_merge($choices,$defaults);
  _log("The choices - " . $choices);
  print_r($options);
  $event = ask($question, $options); wait(300);
  $e = $event->value;
  if (array_key_exists($e,$sites)) {
    _log("Found site " . $e);
    } else {
    ++$cinfo['sv_count'];
    _log("didn't find site: " . $e);
    get_siteinfo($cinfo, $cfg);
   }
  _log("Event Name " . $event->name); _log(" Value " . $event->value);
  if ($event->value) {
    $cinfo['sitenum'] = $event->value; _log("sitenum: " . $cinfo['sitenum']);
    $cinfo['sitename'] = $sites[$cinfo['sitenum']]['name']; _log("sitename: " . $cinfo['sitename']);
  } else { sorry_message($cinfo, $event); }
  wait(300);

  // make sure they have it right by verifying!
  // 1.2 IVRS - Confirm the site number
  $verification_prompt = array(isay("part_1__you_have_entered_the_code_xxxx"));
  $verification_prompt = array_push(isay($cinfo['sitenum'] . "_Code"));
  $verification_prompt = array_push(isay("part_2__which_corresponds_to"));
  $verification_prompt = array_push(isay($cinfo['sitenum'] . "_Name")); 
  $verification_prompt = array_push(isay("part_3__end_of_1st_sentence_and_2nd_sentence_press_1_or_2"));
  // ask for sure
  $vevent = askaskask($verification_prompt, array_merge('1,2', $defaults));
  if ($vevent->name=='choice') {
    if ($vevent->value==1) { 
      $cinfo['site_verified'] = true;
    } else {
      $cinfo['sv_count'] + 1;
      get_siteinfo($cinfo,$cfg);
    }
  } else {
    _log("received " . $event->name . " and " . $event->value . ". Retrying.");
    $cinfo['sv_count'] + 1;
    get_siteinfo($cinfo,$cfg);
  }
  
  return $cinfo;
}

// end get_siteinfo()

/* // IVRS 2.1 - Type of incident */
/* function select_itype ($cinfo, $cfg) { */
/*   $incidentq = array(isay("2_1_Listen_Carefully",true)); */
/*   foreach (range(0,9) as $i) { */
/*     array_push(isay("2_1_Press_" . $i), $incidentq); */
/*   } */
/*   _log(print_r($incidentq)); */
/*   $choices = implode(",",); */
/* 		     askaskask($incidentq); */

/*     /\* $incidentq[2]  = "2_1_Press_0 . ATYPE"; *\/ */
/*     /\* $incidentq[3]  = "2_1_Press_1 . ATYPE"; *\/ */
/*     /\* $incidentq[4]  = "2_1_Press_2 . ATYPE"; *\/ */
/*     /\* $incidentq[5]  = "2_1_Press_3 . ATYPE"; *\/ */
/*     /\* $incidentq[6]  = "2_1_Press_4 . ATYPE"; *\/ */
/*     /\* $incidentq[7]  = "2_1_Press_5 . ATYPE"; *\/ */
/*     /\* $incidentq[8]  = "2_1_Press_6 . ATYPE"; *\/ */
/*     /\* $incidentq[9]  = "2_1_Press_7 . ATYPE"; *\/ */
/*     /\* $incidentq[10] = "2_1_Press_8 . ATYPE"; *\/ */
/*     /\* $request       = "2_1_Press_9 . ATYPE"; *\/ */
/*     /\* $answers = range(0,9); *\/ */
/*     /\* inquisitor($incidentq, $request, $answers, 'incident_action'); *\/ */
/* } */

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
  $message = (AURL . $message . ATYPE); if (DBG) {_log("isay $message");}
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
    say("stop using hacker tricks on me, hu-man!");
  } else {
    if (MAINT) { 
      say(MAINT_MSG); 
      ask("",array("choices" => MAINTPW, "timeout" => 120.0, onTimeout => "hangup", "onChoice" => "supers")); 
      _log("Somebody called during maintenance: " . $currentCall->callerID); hangup(); }
  }

  // IVR timeouts & such
  $saybye = create_function('$event', 'isay("0_2_End_Message_1_Thank_You")');
  $opts = array($timeout => 30.0, $attempts => 3, $bargein => false, $askmode => "dtmf",
		$interdigitTimout => 8, "onBadChoice" => $saybye);   //(create_function('$event', 'isay(0_2_End_Message_1_Thank_You')'));
  $cfg = array('opts' => $opts);

  $cinfo = array();
  $cinfo['caller_number'] = $currentCall->callerID;
  _log("Caller: " . $cinfo['caller_number']);
  $cinfo['network'] = $currentCall->network;
  if ($currentCall->callerName) {$cinfo['callername'] = $currentCall->callerName;}
  answer();
  // 0.1 IVRS - Welcome Message
  isay("0_1_Welcome_Message"); wait(100);
  // 1.1 IVRS - Get healthcare center
  $cinfo = get_siteinfo($cinfo, $cfg);
  //$cinfo['site_name'] = get_sitename($cfg);
  // 1.2 IVRS - Verify site info
  //$cinfo['site_verified']    = verify_siteinfo($cinfo, $cfg);
  // 2.1 IVRS - Choose type of incident
  //$cinfo['incident_code']    = get_itype(); $cinfo['incident_type'] = $icode[$cinfo['icode']]; // get the bigger description in there too
  // 2.1i - TAKE ACTION
  // emergency center instruction?
  //$cinfo['facility_phone'] = hospital_lookup($cinfo['site_code']);
  //say("Transferring you to the hospital at " . $cinfo['facility_phone']);
		if(DBG) {say("stopping here!"); hangup();}

  
  
}

// let's get this party started
main()

?>