<?php

// debugging controls
define("DEBUG_LEVEL","MORE_THAN_YOU_COULD_POSSIBLY_REQUIRE"); // other values: $false? 0? nil?

_log("System Running. Call from " . $currentCall->callerID . "inbound.");

// create a hash for the survey to live in during this call
$survey_data = array();

// geocode stuff
define("MAPS_LOOKUP_BASE_URL", "http://maps.googleapis.com/maps/api/geocode/json");
define("USHAHIDI_BASE_URL", "http://ec2-50-112-5-172.us-west-2.compute.amazonaws.com/admin");
define("USHAHIDI_USER_NAME", "admin");
define("USHAHIDI_PASSWORD", "admin");

// base URLs for tropo hosted files
define("TROPO_BASEURL", "http://hosting.tropo.com/104666/www/");
define("AUDIO_BASEURL", TROPO_BASEURL . "sayahog/audio/");

// secret decoder ring for health facilities
// site number (key): site, location, phone
// these sites are in the Azamgar District
$sites = array();
$sites['0001'] = array('site'=>'Azamgarh Sadar Mahila Hospital', 'location'=>'26.063777,83.183628', 'phone'=>'+919451113651', 'district' => 'AZ');
$sites['0002'] = array('site'=>'Phoolpur', 'location'=>'26.044017,82.520839', 'phone'=>'+919451113651', 'district' => 'AZ');
$sites['0003'] = array('site'=>'Lalganj', 'location'=>'25.450143,82.59002', 'phone'=>'+919451113651', 'district' => 'AZ');
$sites['0004'] = array('site'=>'Atraulia', 'location'=>'26.10495,82.541362', 'phone'=>'+919451113651', 'district' => 'AZ');
$sites['0005'] = array('site'=>'Koilsa', 'location'=>'26.181165,82.581841', 'phone'=>'+919451113651', 'district' => 'AZ');
$sites['0006'] = array('site'=>'Pawayi', 'location'=>'26.155774,83.011249', 'phone'=>'+919451113651', 'district' => 'AZ');
$sites['0007'] = array('site'=>'Mehnagr', 'location'=>'25.525119,83.065119', 'phone'=>'+919451113651', 'district' => 'AZ');
$sites['0008'] = array('site'=>'Haraiya', 'location'=>'26.645412,83.928797', 'phone'=>'+919451113651', 'district' => 'AZ');
$sites['0009'] = array('site'=>'Ahiraula', 'location'=>'26.104961,82.541324', 'phone'=>'+919451113651', 'district' => 'AZ');
$sites['0010'] = array('site'=>'Martinganj', 'location'=>'25.570156,82.47313', 'phone'=>'+919451113651', 'district' => 'AZ');
$sites['0011'] = array('site'=>'Palhni', 'location'=>'26.021551,83.09345', 'phone'=>'+919451113651', 'district' => 'AZ');
$sites['0012'] = array('site'=>'Rani ki Sarai', 'location'=>'26.000459,83.062549', 'phone'=>'+919451113651', 'district' => 'AZ');
$sites['0013'] = array('site'=>'Mohammdpur', 'location'=>'25.575318,83.014912', 'phone'=>'+919451113651', 'district' => 'AZ');
$sites['0014'] = array('site'=>'Mirzapur', 'location'=>'26.035728,82.565781', 'phone'=>'+919451113651', 'district' => 'AZ');
$sites['0015'] = array('site'=>'Tahbarpur', 'location'=>'26.095543,83.060374', 'phone'=>'+919451113651', 'district' => 'AZ');
$sites['0016'] = array('site'=>'Jahanaganj', 'location'=>'25.494027,83.13071', 'phone'=>'+919451113651', 'district' => 'AZ');
$sites['0017'] = array('site'=>'Sathiyav', 'location'=>'26.075659,82.53107', 'phone'=>'+919451113651', 'district' => 'AZ');
$sites['0018'] = array('site'=>'Thekma', 'location'=>'25.530044,82.565966', 'phone'=>'+919451113651', 'district' => 'AZ');
$sites['0019'] = array('site'=>'Tarwa', 'location'=>'25.450617,83.111857', 'phone'=>'+919451113651', 'district' => 'AZ');
$sites['0020'] = array('site'=>'Ajmatgarh', 'location'=>'26.166292,83.36433', 'phone'=>'+919451113651', 'district' => 'AZ');
$sites['0021'] = array('site'=>'Bilariyaganj', 'location'=>'26.120036,83.134831', 'phone'=>'+919451113651', 'district' => 'AZ');
$sites['0022'] = array('site'=>'Maharajganj', 'location'=>'26.152813,83.064907', 'phone'=>'+919451113651', 'district' => 'AZ');
// everything below here is in the Mizrapur District
$sites['0023'] = array('site'=>'Mirzapur District Women\'s Hospital', 'location'=>'25.154094,82.577234', 'phone'=>'+919450162867', 'district' => 'MZ');
$sites['0024'] = array('site'=>'Chunar', 'location'=>'25.061756,82.520419', 'phone'=>'+919450162867', 'district' => 'MZ');
$sites['0025'] = array('site'=>'Madihan', 'location'=>'24.550976,82.403875', 'phone'=>'+919450162867', 'district' => 'MZ');
$sites['0026'] = array('site'=>'Lalganj', 'location'=>'24.594401,82.202413', 'phone'=>'+919450162867', 'district' => 'MZ');
$sites['0027'] = array('site'=>'Majavah', 'location'=>'25.266431,82.709198', 'phone'=>'+919450162867', 'district' => 'MZ');
$sites['0028'] = array('site'=>'Rajgarh', 'location'=>'24.525589,82.52173', 'phone'=>'+919450162867', 'district' => 'MZ');
$sites['0029'] = array('site'=>'Haliya', 'location'=>'24.491444,82.185563', 'phone'=>'+919450162867', 'district' => 'MZ');
$sites['0030'] = array('site'=>'Vijaypur', 'location'=>'25.073399,82.378023', 'phone'=>'+919450162867', 'district' => 'MZ');
$sites['0031'] = array('site'=>'Jamalpur', 'location'=>'25.09245,83.052788', 'phone'=>'+919450162867', 'district' => 'MZ');
$sites['0032'] = array('site'=>'Chil', 'location'=>'25.152229,82.563699', 'phone'=>'+919450162867', 'district' => 'MZ');
$sites['0033'] = array('site'=>'Kon', 'location'=>'25.214376,82.583189', 'phone'=>'+919450162867', 'district' => 'MZ');
$sites['0034'] = array('site'=>'Pahadi', 'location'=>'25.050047,82.450017', 'phone'=>'+919450162867', 'district' => 'MZ');
$sites['0035'] = array('site'=>'Nagar (Gurusandi)', 'location'=>'25.160245,82.589738', 'phone'=>'+919450162867', 'district' => 'MZ');
$sites['0036'] = array('site'=>'Patehra', 'location'=>'24.553075,82.353919', 'phone'=>'+919450162867', 'district' => 'MZ');
// end of decoder ring
_log("Site map loaded!");


// helper function for the ask function
function asky ($question, $options, $nextfunc) {
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
    _log("in sorry_message with $event->value");
    say(AUDIO_BASEURL . "0_2_End_Message_1_Thank_You.gsm");
    _log("IVRS 0.3 - Caller at $currentCall->CallerId was unable to use the menu");
    hangup();
}
  
// IVRS 1.1 - Please enter the 4 digit code of the health centre
function select_healthcenter () {
    _log("in select_healthcenter");
    asky ("1_1_Enter_4_digit_code_number.gsm", array_keys($sites), "verify_selection");
}

// IVRS 1.2 - Verify they selected the correct center
function verify_selection ($event) {
    _log("in verify_selection");
    $site = $event->value; _log($site);
    // record the survey data. it'll be overwritten by the next run if they got it wrong.
    $survey_data['Site'] = $site;
    say(AUDIO_BASEURL . "part_1__you_have_entered_the_code_xxxx.gsm");
    say(AUDIO_BASEURL . $site . "_Code.gsm");
    say(AUDIO_BASEURL . "part_2__which_corresponds_to.gsm");
    say(AUDIO_BASEURL . $site . "_Name.gsm"); wait(3000);
    asky((AUDIO_BASEURL . "part_3__end_of_1st_sentence_and_2nd_sentence_press_1_or_2.gsm"), "1,2", "select_incident_type");
}

// IVRS 2.1 - Type of incident
function select_incident_type ($event) {
    say(AUDIO_BASEURL . "2_1_Listen_Carefully.gsm");
}


// IVR MAIN
function main () {
    _log("o hai we\'re in main");
    answer(); wait(3000);
    say(AUDIO_BASEURL . "0_1_Welcome_Message.gsm"); wait(3000);
    select_healthcenter();
}
// TODO: Refactor

// let's get this party started
main()

?>