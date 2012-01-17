<?php

// debugging messages
define("DBG", false);


// !!! MAINTENANCE MODE LEVER !!!
define("MAINT", false);
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
      say("sorry! sending you back to the main menu.");
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
  global $sites, $cinfo, $icode;
  if(DBG){_log("Currently trying to get site info.");}
  // make sure we boot them if they can't get it after 3 tries
  if ($cinfo['sv_count'] > 2) { invalid_choice(); }
  // put the message together
  $question = (isay("1_1_Enter_4_digit_code_number",true));
  $choices = "[4 DIGITS]";
  _log("The choices - " . $choices);
  $event = ask($question, array("choices"     => $choices,
				"mode"        => "dtmf",
				"bargein"     => true,
				"attempts"    => 3,
				"onBadChoice" => "byenow"));
  $e = $event->value;
  _log("Event Name " . $event->name); _log(" Value " . $event->value);

  if (array_key_exists($e,$sites)) {
      _log("Found site " . $e);
  } else {
      $cinfo['sv_count'] += 1;
      _log("didn't find site: " . $e);
      get_siteinfo($cinfo, $cfg); // loop back around again, pardner
  }
  $cinfo['sitenum'] = $event->value; _log("sitenum: " . $cinfo['sitenum']);
  $cinfo['sitename'] = $sites[$cinfo['sitenum']]['name']; _log("sitename: " . $cinfo['sitename']);

  // make sure they have it right by verifying!
  // 1.2 IVRS - Confirm the site number
  $verification_prompt = array(isay("part_1__you_have_entered_the_code_xxxx",true));
  $verification_prompt = array_push(isay($cinfo['sitenum'] . "_Code",true));
  $verification_prompt = array_push(isay("part_2__which_corresponds_to",true));
  $verification_prompt = array_push(isay($cinfo['sitenum'] . "_Name",true)); 
  $verification_prompt = array_push(isay("part_3__end_of_1st_sentence_and_2nd_sentence_press_1_or_2",true));
  // ask for sure
  $vevent = ask($verification_prompt, array("choices"     => '1,2', 
					    "bargein"     => true,
					    "mode"        => "dtmf",
					    "attempts"    => 3,
					    "onBadChoice" => "byenow"));
  if ($vevent->value==1) { 
    $cinfo['site_verified'] = true; if(DBG){say("site verified!");}
  } else {
    $cinfo['sv_count'] += 1;
    get_siteinfo($cinfo,$cfg);
  }
	      
  get_itype();
}
//
// end get_siteinfo()


// IVRS 2.1 - Type of incident */
function get_itype () {
  global $cinfo, $icode;
  $question = array(isay("2_1_Listen_Carefully",true));
  foreach (range(0,9) as $i) {
    $question = array_push(isay("2_1_Press_" . $i,true)); 
  }
  $event = ask($question, array("choices"  => '0,1,2,3,4,5,6,7,8,9',
		       "bargein"  => true,
		       "mode"     => "dtmf",
		       "attempts" => 3,
		       "onBadChoice" => "byenow"));
$cinfo['icode'] = $event->value;
_log("Going from get_itype to incident_action");
  wait(300); incident_action();
  }


// IVRS 2.1.i - Action
  function incident_action (){
    global $cinfo, $icode;
    $itype = $cinfo['icode'];
    $cinfo['incident_description'] = $icode[$itype];
    if ($cinfo['icode'] == 0) { 
      urgent_action(); // TODO: This is section 1.4- we need some audio for it, I think?
    }
    if ($cinfo['icode']) {
        money_demanded();
    }
}

// IVRS 3.1 - Money asked/spent
function money_demanded () {
    global $cinfo, $icode;
    $question = array(isay("3_1_a__if_spent_less_that_500_or_more_than_500",true));
    $question = array_push(isay("Less_than_500",true));
    $question = array_push(isay("More_than_500",true));
    $choices = '1,2';
    $event = ask($question, array("choices"  => $choices,
			   "bargein"     => true,
			   "attempts"    => 3,
			   "mode"        => "dtmf",
			   "onBadChoice" => "byenow"));
    $cinfo['money_code'] = $event->value;
    confirmation();
}

// IVRS 1.3 - Summary for Confirmation
function confirmation() {
    global $cinfo, $icode;
    if ($cinfo['money_code'] > 1) { 
        $cinfo['money_demanded'] = 'More_than_500';
    } else { 
        $cinfo['money_demanded'] = 'Less_than_500';
    }
    $question = array(isay("part_1_you",true));
    $question = array_push(isay($cinfo['site_number'] . "_Name"));
    $question = array_push(isay("part_2_name_of_hospital_details"));
    $question = array_push(isay($cinfo['money_demanded']));
    $question = array_push($question = isay("part_3_amount_money",true));
    $event = ask($question, array("choices"  => '1,2',
			   "bargein"     => true,
			   "attempts"    => 3,
			   "mode"        => "dtmf",
			   "onBadChoice" => "invalid_choice"));
    capture_or_reset($event);
}

// U-turn folks who want another shot
function capture_or_reset ($event) {
    global $cinfo;
    _log("in capture_or_reset");
    if ($event->value == 1) { 
        capture_data();
	byenow();
    }
    else if ($event == 2) { 
      get_itype();
    }
}


// !!! URGENT ACTION REQUIRED !!!
function urgent_action() {
  global $cinfo;
  confirmation();
  // use the goodies in the $cinfo array to pull their info.
  //$cinfo['sitenum']['sitename'] etc.
  // TODO: figure out what this is supposed to activate and who to call.
}

// hand data to ushahidi (for huslage <3 )
function capture_data ($cinfo) {
    global $cinfo;
    _log(json_encode($cinfo));
    byenow();
}
        
function flog ($message) {
  // TODO: create a logging class that will let us see our messages more easily
}
  
// wrapper for say()- includes the prefix/suffix for the audio files.
function isay ($message, $rs=true) { // rs is a bool for 'return string'
  $message = (AURL . $message . ATYPE); if (DBG) {_log("isay $message");}
  if($rs){return $message;} else {say($message);}
}

function invalid_choice () {
  isay("0_3_End_Message_2_Not_entered_a_valid_choice");
  hangup();
}

function byenow () {
    isay("0_2_End_Message_1_Thank_You");
    hangup();
}

function supers() {
  $maint_auth = true;
  main($maint_auth);
}

// IVR MAIN
function main ($maint_auth = false) {
  answer();
  global $cinfo, $sites, $itypes;
  if ($maint_auth) { 
    say("Maintenance mode entered. Warning, Hull breach imminent!");
  } else {
    if (MAINT) { 
      say(MAINT_MSG); 
      ask("",array("choices" => MAINTPW, "timeout" => 120.0, onTimeout => "hangup", "onChoice" => "supers")); 
      _log("Somebody called during maintenance: " . $currentCall->callerID); hangup(); }
  }
  // 0.1 IVRS - Welcome Message
  isay("0_1_Welcome_Message");

  // IVR timeouts & such (lots of these are irrelevant)
  $saybye = create_function('$event', 'isay("0_2_End_Message_1_Thank_You")');
  $opts = array($timeout => 30.0, $attempts => 3, "bargein" => true, "mode" => "dtmf",
		$interdigitTimout => 8); 
  $cfg = array('opts' => $opts);
  $cinfo = array();
  $cinfo['caller_number'] = $currentCall->callerID;
  _log("Caller: " . $cinfo['caller_number']);
  $cinfo['network'] = $currentCall->network;
  if ($currentCall->callerName) {$cinfo['callername'] = $currentCall->callerName;}
    // 1.1 IVRS - Get healthcare center
  get_siteinfo($cinfo, $cfg);
  $cinfo['incident_code']  = get_itype(); $cinfo['incident_type'] = $icode[$cinfo['icode']]; // get the bigger description in there too
}

// let's get this party started
main()

?>
