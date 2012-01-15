<?php

// debugging controls
define("DEBUG_LEVEL","MORE_THAN_YOU_COULD_POSSIBLY_REQUIRE"); 

_log("System Running. Call from " . $currentCall->callerID . "inbound.");

// create a hash for the survey to live in during this call
$survey_data = array();

// geocode stuff
define("MAPS_LOOKUP_BASE_URL", "http://maps.googleapis.com/maps/api/geocode/json");
define("USHAHIDI_BASE_URL", "http://ec2-50-112-5-172.us-west-2.compute.amazonaws.com/admin");
define("USHAHIDI_USER_NAME", "admin");
define("USHAHIDI_PASSWORD", "admin");

// base URLs for our filez
define("IVR_BASEURL", "https://raw.github.com/tethr/Sayahog/master/");
// define("AUDIO_BASEURL", IVR_BASEURL . "audio/");

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
$sites['0033'] = array('site'=>'Kon', 'location'=>'25.214376,82.583189', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District');
$sites['0034'] = array('site'=>'Pahadi', 'location'=>'25.050047,82.450017', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District');
$sites['0035'] = array('site'=>'Nagar (Gurusandi)', 'location'=>'25.160245,82.589738', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District');
$sites['0036'] = array('site'=>'Patehra', 'location'=>'24.553075,82.353919', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District');
// end of decoder ring
_log("Site map loaded!");


// helper function for the ask function
function asky ($question, $options, $nextfunc) {    
    global $survey_data;
    _log("in asky with arguments $question, $options and $nextfunc");
    ask($question, array(
    "choices"     => $options,
    "timeout"     => 10.0,
    "mode"	  => "dtmf",
    "attempts"    => 3,
    "onChoice"	  => $nextfunc,
    "onBadChoice" => "sorry_message")
    );
}

// IVRS 0.3 - Try again later
function sorry_message ($event) {
    global $survey_data;
    _log("in sorry_message with $event->value");
    say("https://raw.github.com/tethr/Sayahog/master/audio/8bit-0_2_End_Message_1_Thank_You.wav");
    _log("IVRS 0.3 - Caller at $currentCall->CallerId was unable to use the menu \:\(");
    hangup();
}
  
// IVRS 1.1 - Please enter the 4 digit code of the health centre
function select_healthcenter () {
    global $survey_data;
    _log("in select_healthcenter");
    $healthcenter_question = ("https://raw.github.com/tethr/Sayahog/master/audio/8bit-1_1_Enter_4_digit_code_number.wav");
    _log("RAW TEXT: $healthcenter_question");    
    asky ($healthcenter_question, array_keys($sites), "verify_selection");
}

// IVRS 1.2 - Verify they selected the correct center
function verify_selection ($event) {
    global $survey_data;
    _log("in verify_selection");
    $site = $event->value; _log($site);
    // record the survey data. it'll be overwritten by the next run if they got it wrong.
    $survey_data['site'] = $sites[$site];
    $survey_data['site_number'] = $site;
    $verify_site_selection  = ("https://raw.github.com/tethr/Sayahog/master/audio/8bit-part_1__you_have_entered_the_code_xxxx.wav ");
    $verify_site_selection .= ("https://raw.github.com/tethr/Sayahog/master/audio/8bit-" . $site . "_Code.wav ");
    $verify_site_selection .= ("https://raw.github.com/tethr/Sayahog/master/audio/8bit-part_2__which_corresponds_to.wav ");
    $verify_site_selection .= ("https://raw.github.com/tethr/Sayahog/master/audio/8bit-" . $site . "_Name.wav "); 
    $verify_site_selection .= ("https://raw.github.com/tethr/Sayahog/master/audio/8bit-part_3__end_of_1st_sentence_and_2nd_sentence_press_1_or_2.wav");
    _log("RAW TEXT: $verify_site_selection");
    asky($verify_site_selection, "1,2", "select_incident_type");
}

// IVRS 2.1 - Type of incident
function select_incident_type ($event) {
    global $survey_data;
    _log("in select_incident_type");
    $incident_type_question  = ("https://raw.github.com/tethr/Sayahog/master/audio/8bit-2_1_Listen_Carefully.wav ");
    $incident_type_question .= ("https://raw.github.com/tethr/Sayahog/master/audio/8bit-2_1_Press_0.wav ");
    $incident_type_question .= ("https://raw.github.com/tethr/Sayahog/master/audio/8bit-2_1_Press_1.wav ");
    $incident_type_question .= ("https://raw.github.com/tethr/Sayahog/master/audio/8bit-2_1_Press_2.wav ");
    $incident_type_question .= ("https://raw.github.com/tethr/Sayahog/master/audio/8bit-2_1_Press_3.wav ");
    $incident_type_question .= ("https://raw.github.com/tethr/Sayahog/master/audio/8bit-2_1_Press_4.wav ");
    $incident_type_question .= ("https://raw.github.com/tethr/Sayahog/master/audio/8bit-2_1_Press_5.wav ");
    $incident_type_question .= ("https://raw.github.com/tethr/Sayahog/master/audio/8bit-2_1_Press_6.wav ");
    $incident_type_question .= ("https://raw.github.com/tethr/Sayahog/master/audio/8bit-2_1_Press_7.wav ");
    $incident_type_question .= ("https://raw.github.com/tethr/Sayahog/master/audio/8bit-2_1_Press_8.wav ");
    $incident_type_question .= ("https://raw.github.com/tethr/Sayahog/master/audio/8bit-2_1_Press_9.wav");
    $answers = range(0,9);
    _log("RAW TEXT: $incident_type_question");   
    asky($incident_type_question, $answers, 'incident_action');
}

// IVRS 2.1.i - Action
function incident_action ($event) {
    global $survey_data, $incident_code;
    _log("in incident_action");
    // add the incident type to the survey results
    $incident_type = $event->value;
    $survey_data['incident_code'] = $incident_type;
    $survey_data['incident_description'] = $incident_code[$incident_type];
    // if response is < 9 -> IVRS 3.1
    // if response is 9 -> IVRS 1.4
    if ($incident_action < 9 ) {
        money_demanded();
    } else {
        _log("somebody dialed a 9");
    }
}

// IVRS 3.1 - Money asked/spent
function money_demanded () {
    global $survey_data;
    _log("in money_demanded");
    $money_demand_question  = ("https://raw.github.com/tethr/Sayahog/master/audio/8bit-3_1_a__if_spent_less_that_500_or_more_than_500.wav ");
    $money_demand_question .= ("https://raw.github.com/tethr/Sayahog/master/audio/8bit-Less_than_500.wav ");
    $money_demand_question .= ("https://raw.github.com/tethr/Sayahog/master/audio/8bit-More_than_500.wav");
    $answers = range(1,2);
    _log("RAW TEXT: $money_demand_question");
    asky($money_demand_question, $answers, 'confirmation');
}

// IVRS 1.3 - Summary for Confirmation
function confirmation($event) {
    global $survey_data;
    _log("in confirmation");
    $money_demanded = $event->value;
    $survey_data['money_code'] = $money_demanded;
    if ($money_demanded > 1) { 
       $survey_data['money_demanded'] = 'More_than_500';
    } else { 
       $survey_data['money_demanded'] = 'Less_than_500';
    }
    $confirmation_message  = ("https://raw.github.com/tethr/Sayahog/master/audio/8bit-part_1_you.wav ");
    $confirmation_message .= ("https://raw.github.com/tethr/Sayahog/master/audio/8bit-" . $survey_data['site_number'] . "_Name.wav ");
    $confirmation_message .= ("https://raw.github.com/tethr/Sayahog/master/audio/8bit-part_2_name_of_hospital_details.wav ");
    $confirmation_message .= ("https://raw.github.com/tethr/Sayahog/master/audio/8bit-" . $survey_data['money_demanded'] . ".wav ");
    $confirmation_message .= ("https://raw.github.com/tethr/Sayahog/master/audio/8bit-part_3_amount_money.wav");
    _log("RAW TEXT: $confirmation_message");
    asky($confirmation_message, range(1,2), 'capture_or_reset');
}

// U-turn folks who want another shot
function capture_or_reset ($event) {
    global $survey_data;
    _log("in capture_or_reset");
    if ($event == 1) { 
        capture_data();
    }
    else if ($event == 2) { 
        _log("going back around for another try!");
	select_incident_type();
    }
}

// IVRS 1.4 Reporting an incident of corruption
function report_incident ($event) {
    global $survey_data;
    _log("in report_incident");
    _log(print_r($survey_data));
}

// hand data to ushahidi
function capture_data () {
    global $survey_data;
    _log(print_r($survey_data));
}
        

function byenow () {
    say("https://raw.github.com/tethr/Sayahog/master/audio/8bit-0_2_End_Message_1_Thank_You.wav");
    hangup();
}

// IVR MAIN
function main () {
    global $survey_data;
    $survey_data['caller_number'] = $currentCall->callerID;
    $survey_data['network'] = $currentCall->network;
    if ($currentCall->callerName) { $survey_data['callername'] = $currentCall->callerName; }

    _log("o hai we\'re in main");
    answer(); wait(3000);
    say("https://raw.github.com/tethr/Sayahog/master/audio/8bit-0_1_Welcome_Message.wav"); wait(3000);
    select_healthcenter(); // everything hooks into here via asky
}
// TODO: Refactor

// let's get this party started
main()

?>