class Call

  attr_accessor :caller_info

  # debugging messages
  DEBUG = true

  # ?  !!! MAINTENANCE MODE LEVER !!!
  MAINTENANCE_MODE = true
  MAINTENANCE_PASSWORD = '8'
  MAINTENANCE_MESSAGE = ["The help line is currently undergoing maintenance. Please call again later.", {"voice" => "kate"}]

  # where all them audio files at?!
  AUDIO_URL = "http://hosting.tropo.com/104666/www/sayahog/audio/"
  AUDIO_TYPE = ".gsm"


  # incident code -> description

  #SHOULDNT: it be an instance variable in ruby

  INCIDENT_CODE = {
    '1' => 'Health worker asked for bribe to admit you or treat you in hospital.',
    '2' => 'You were asked to pay money after delivery.',
    '3' => 'You were asked to pay for drugs, blood, tests, etc.',
    '4' => 'You were asked to purchase drugs, gloves, soap etc from outside.',
    '5' => 'The staff asked you to go to another hospital without a referral slip.',
    '6' => 'You were asked a bribe for payments of JSY.',
    '7' => 'Had to pay for the vehicle that brought you to hospital.',
    '8' => 'Were asked to pay for or not provided with food during your stay in the JSSK hospitals.',
    '9' => 'Were not provided with free drop back facility from JSSK hospitals.',
    '0' => 'This is a situation which might result in death of the woman/child and no action is being taken by the staff.',
  }


  # secret decoder ring for health facilities
  # site number (key): site, location, phone
  # these sites are in the Azamgar District
  SITES = {
    '0001' => {'name'=>'Azamgarh Sadar Mahila Hospital', 'location'=>'26.063777,83.183628', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District'},
    '0002' => {'name'=>'Phoolpur', 'location'=>'26.044017,82.520839', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District'},
    '0003' => {'name'=>'Lalganj', 'location'=>'25.450143,82.59002', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District'},
    '0004' => {'name'=>'Atraulia', 'location'=>'26.10495,82.541362', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District'},
    '0005' => {'name'=>'Koilsa', 'location'=>'26.181165,82.581841', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District'},
    '0006' => {'name'=>'Pawayi', 'location'=>'26.155774,83.011249', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District'},
    '0007' => {'name'=>'Mehnagr', 'location'=>'25.525119,83.065119', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District'},
    '0008' => {'name'=>'Haraiya', 'location'=>'26.645412,83.928797', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District'},
    '0009' => {'name'=>'Ahiraula', 'location'=>'26.104961,82.541324', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District'},
    '0010' => {'name'=>'Martinganj', 'location'=>'25.570156,82.47313', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District'},
    '0011' => {'name'=>'Palhni', 'location'=>'26.021551,83.09345', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District'},
    '0012' => {'name'=>'Rani ki Sarai', 'location'=>'26.000459,83.062549', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District'},
    '0013' => {'name'=>'Mohammdpur', 'location'=>'25.575318,83.014912', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District'},
    '0014' => {'name'=>'Mirzapur', 'location'=>'26.035728,82.565781', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District'},
    '0015' => {'name'=>'Tahbarpur', 'location'=>'26.095543,83.060374', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District'},
    '0016' => {'name'=>'Jahanaganj', 'location'=>'25.494027,83.13071', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District'},
    '0017' => {'name'=>'Sathiyav', 'location'=>'26.075659,82.53107', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District'},
    '0018' => {'name'=>'Thekma', 'location'=>'25.530044,82.565966', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District'},
    '0019' => {'name'=>'Tarwa', 'location'=>'25.450617,83.111857', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District'},
    '0020' => {'name'=>'Ajmatgarh', 'location'=>'26.166292,83.36433', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District'},
    '0021' => {'name'=>'Bilariyaganj', 'location'=>'26.120036,83.134831', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District'},
    '0022' => {'name'=>'Maharajganj', 'location'=>'26.152813,83.064907', 'phone'=>'+919451113651', 'district' => 'Azamgarh_Zila_District'},
    # everything below here is in the Mizrapur District
    '0023' => {'name'=>'Mirzapur District Women\'s Hospital', 'location'=>'25.154094,82.577234', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District'},
    '0024' => {'name'=>'Chunar', 'location'=>'25.061756,82.520419', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District'},
    '0025' => {'name'=>'Madihan', 'location'=>'24.550976,82.403875', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District'},
    '0026' => {'name'=>'Lalganj', 'location'=>'24.594401,82.202413', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District'},
    '0027' => {'name'=>'Majavah', 'location'=>'25.266431,82.709198', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District'},
    '0028' => {'name'=>'Rajgarh', 'location'=>'24.525589,82.52173', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District'},
    '0029' => {'name'=>'Haliya', 'location'=>'24.491444,82.185563', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District'},
    '0030' => {'name'=>'Vijaypur', 'location'=>'25.073399,82.378023', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District'},
    '0031' => {'name'=>'Jamalpur', 'location'=>'25.09245,83.052788', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District'},
    '0032' => {'name'=>'Chil', 'location'=>'25.152229,82.563699', 'phone'=>'+919450162867', 'district' => 'Mirazpur_Zila_District'}
  }
  # end decoder ring

  ##    $cinfo = array();
  ####  $icode = NULL;  # WHY?!



  def initialize
    @maintainance_authorized = false
    @caller_info = {}
  end

  def run( maintainance_authorized = false )

    answer()

    # hangup if maintenance mode is active but not authorized
    authorize_maintainance_mode if MAINTENANCE

    # store basic caller information (name, number, set retries to 0)
    store_initial_caller_info

    isay "0_1_Welcome_Message"

    wait(100)

    get_site_info

    # TODO: DEPRECATED, BUT CHECK THAT NOTHING IS MISSING IN OUR CODE
    #  caller_info[ ] = get_site_info()
    #  caller_info[:incident_code] = get_incident_type()
    #  caller_info[:incident_type] = INCIDENT_CODE[ caller_info[:icode] ]
    #  caller_info[ ] = get_site_info()

    # we were told this is a leftover
    ## $saybye = create_function('$event', 'isay("0_2_End_Message_1_Thank_You")');

    get_incident_code_and_type!

    # report = build_report caller_info

  end

  private

  def isay msg
    AUDIO_URL + msg + AUDIO_TYPE
  end

  supervisor = lambda do
    # @maintenance_authorized = true
    run( true ) # @maintenance_authorized )
  end


  def authorize_maintainance_mode
    unless @maintainance_authorized
      say *MAINTENANCE_MESSAGE
      ask("", {
            :choices => MAINTENANCE_PASSWORD,
            :mode => "dtmf",
            :timeout => 120.0,
            :onTimeout => :hangup,
            :onChoice => lambda {|event| maintenance_authorized!}
          })
      log("Somebody called during maintenance: #{$currentCall.callerID}" )
      hangup()
    end
  end


  def get_site_info

    log "Currently trying to get site info." if DEBUG

    invalid_choice if caller_info[:retries] > 2

    caller_info[:retries] += 1

    log("=========================== Count: #{event.value}" )

    question = isay("1_1_Enter_4_digit_code_number")

    choices = "[4-DIGITS]"

    event = ask( question )

  end

  def store_initial_caller_info
    caller_info[:caller_number] = $currentCall.callerID
    caller_info[:retries] = 0
    caller_info[:network] = $currentCall.network
    caller_info[:caller_name] = $currentCall.callerName if $currentCall.callerName
    log( "Caller: " + caller_info[:caller_number] )
  end




  def get_incident_code_and_type!
    prompts = isay("2_1_Options")
    event = ask(prompts, :choices => '0,1,2,3,4,5,6,7,8,9',
                :mode => 'dtmf',
                :bargein => true,
                :attempts => 3,
                :onBadChoice => "byenow")
    caller_info[:incident_code] = event.value
    caller_info[:incident_type] = INCIDENT_CODE[ caller_info[:incident_code] ]
    log("get_incident_type -> incident_action")
    wait(300)
    # TODO call incident action after this method
  end

  def byenow

  end

  def maintenance_authorized!
    @maintenance_authorized = true
    say "Maintenance mode entered. Warning, Hull breach imminent!"
  end


end


Call.new.run
