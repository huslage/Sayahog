##
## Author: D:evolute
## proudly presented by adap:to
## devolute.org


require 'net/http'

USHAHIDI_CONFIG = {
  :url => 'ec2-50-112-5-172.us-west-2.compute.amazonaws.com/api',
  :parameters => {
    :required => { },
    :optional => {
      :task => 'task',
      :by => 'by',
      :action => 'action',
      :incident_id => 'incident_id'
    },
  },
  :authentication => {
    :basic_auth => {
      :user => 'admin',
      :password => 'admin' },
  },
}



class UshahidiGateway

  attr_reader :user, :password

  def initialize(credentials)
    @user = credentials[:user]
    @password = credentials[:password]
  end

  def get url
     raise "implement get method for the Ushahidi gateway"
  end

  def post url, payload
    response = Net::HTTP.post_form(URI.parse("http://#{user}:#{password}@" + url), payload )
    response.body
  end

end

class UshahidiClient

  attr_reader :config, :gateway, :url

  def initialize
    @config = USHAHIDI_CONFIG
    @gateway = UshahidiGateway.new( config[:authentication][:basic_auth] )
    @url = config[:url]
  end


  def post_report report
    gateway.post( url, build_options_from(report) )
  end

  private

  def build_options_from report
    payload = {
      :task => 'report',
      :incident_title => report[:title],
      :incident_description => report[:description],
      :incident_category => report[:category],
      :incident_date => get_date_and_time[:date],
      :incident_hour => get_date_and_time[:hours],
      :incident_minute => get_date_and_time[:minutes],
      :incident_ampm => get_date_and_time[:am_pm],
      :latitude => report[:latitude],
      :longitude => report[:longitude],
      :location_name => report[:location_name]
    }
  end

  def get_date_and_time
    t = Time.new
    time_hash = { }
    time_hash[:am_pm]= t.strftime("%P")
    time_hash[:hours]= t.strftime("%I")
    time_hash[:minutes]= t.strftime("%M")
    time_hash[:date]= t.strftime("%m/%d/%Y")
    time_hash
  end

end



module LocalTesting

  class CurrentCall

    def callerID
      "foo"
    end

    def network
      "vodafone"
    end

    def callerName
      "CallerName"
    end

    def isActive
      true
    end

  end


  # $currentCall = CurrentCall.new


  class Event

    def initialize(value)
      @value = value
    end

    def name
      "choice"
    end

    def value
      @value
    end

  end

  def answer
    puts "answer"
  end

  def ask(what, options)
    puts "asked #{what} - #{options}"

    @ask_count ||= 0
    @ask_count += 1

    value = case @ask_count
      when 1 then '8'
      when 2 then '0023'
      when 3 then '1'
      when 4 then '2'
      else '1'
    end

    puts "value is #{value}"

    event = Event.new(value)

    if options[:choices]
      if options[:choices].match("DIGIT")
        choices = ['0023']
      else
        choices = options[:choices].split(',')
      end
    end

    if choices
      if choices.include?(value)
        options[:onChoice].call(event) if options[:onChoice]
      else
        options[:onBadChoice].call(event) if options[:onBadChoice]
      end
    end
    event
  end

  def say(what, options={})
    puts "say #{what}"
  end

  def call(where)
    puts "calls #{where}"
  end

  def redirect(where)
    puts "redirects #{where}"
  end

  def transfer(where)
    puts "transfers #{where}"
  end

  def log(what)
    puts "logged: #{what}}"
  end

  def hangup
    puts "hung up"
    exit
  end

  def wait(howlong)
    "waiting #{howlong}"
  end
end

class Call

  # include LocalTesting

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

  INCIDENTS = {
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

  MONEY_CODES = {'2' => 'More_than_500', '1' => 'Less_than_500'}

  MONEY_DESCRIPTION ={'2' => 'It was about more then 500 Rupees', '1' => 'It was about less then 500 Rupees'}

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
    @retries = {}
    @ask_default_options = {
      :mode => 'dtmf',
      :bargein => true,
      :attempts => 3,
      :onBadChoice => lambda { |event| invalid_choice }
    }
  end

  def run

    answer()

    # hangup if maintenance mode is active but not authorized
    authorize_maintainance_mode if MAINTENANCE_MODE

    # store basic caller information (name, number, set retries to 0)
    store_initial_caller_info if $currentCall.isActive

    say(isay("0_1_Welcome_Message")) if $currentCall.isActive

    wait(100) if $currentCall.isActive

    # retries getting the site till successful, or kicks out the user after too many retries
    # after it ran successfully we have a @site instance variable with the chosen site
    get_site_info if $currentCall.isActive

    # gets current incident code
    # stores the incident action, or kicks out after several retries
    get_incident_code_and_type! if $currentCall.isActive

    # either asks for the amount of money
    # or in emergency sends report to call the number
    incident_action! if $currentCall.isActive

    # report = build_report caller_info
  end

  private

  def isay msg
    AUDIO_URL + msg + AUDIO_TYPE
  end

  def authorize_maintainance_mode
    unless @maintenance_authorized
      say *MAINTENANCE_MESSAGE
      ask("", {
            :choices => MAINTENANCE_PASSWORD,
            :mode => "dtmf",
            :timeout => 120.0,
            :onTimeout => :hangup,
            :onChoice => lambda {|event| maintenance_authorized!},
            :onBadChoice => lambda {|event| hangup! }
          })
      unless @maintenance_authorized
        log("Somebody called during maintenance: #{$currentCall.callerID}" )
        hangup!
      end
    end
  end

  def check_store_and_verify_site_or_retry(choice_event)
    log("=========================== Result: #{choice_event.value} (event type: #{choice_event.name})")
    if SITES[choice_event.value]
      @site = {'id' => choice_event.value, 'data' => SITES[choice_event.value] }
      log("Found site #{choice_event.value} (#{@site.inspect})")
      verify_site
    else
      log("Didn't find site with number #{choice_event.value}}")
      get_site_info
    end
  end

  # ask user to verify the site number typed in
  def verify_site
    verification_prompt = isay("#{@site['id']}_Verification")
    event = ask(verification_prompt, {
                  :choices => "1,2",
                  :mode => "dtmf",
                  :bargein => true,
                  :attempts => 3,
                  :onBadChoice => lambda {|event| invalid_choice }
                })
    if event.name == 'choice'
      if event.value == "1"
        caller_info['site_verified'] = true
      else
        get_site_info
      end
    else
      log("received #{event.name} and #{event.value} - retrying")
      get_site_info
    end
  end

  def get_site_info
    log "Currently trying to get site info." if DEBUG

    kick_out_after_too_many_retries_for!(:get_site_info)

    question = isay("1_1_Enter_4_digit_code_number")

    event = ask(question, {
                :choices => "[4-DIGITS]",
                :mode => "dtmf",
                :bargein => true,
                :attempts => 3,
                :onBadChoice => lambda {|event| get_site_info },
                :onTimeout => lambda {|event| get_site_info },
                :onChoice => lambda {|event| check_store_and_verify_site_or_retry(event) }
                })
  end

  def get_incident_code_and_type!
    kick_out_after_too_many_retries_for!(:get_incident_code_and_type)

    prompts = isay("2_1_Options")
    options = @ask_default_options.merge(:choices => '0,1,2,3,4,5,6,7,8,9',
                                         :onChoice => lambda {|event| store_incident_code(event) ; wait(300)},
                                         :onBadChoice => lambda {|event| get_incident_code_and_type! },
                                         :onTimeout => lambda {|event| get_incident_code_and_type! })
    event = ask(prompts, options)
  end

  def store_initial_caller_info
    caller_info['caller_number'] = $currentCall.callerID
    caller_info['retries'] = 0
    caller_info['network'] = $currentCall.network
    caller_info['caller_name'] = $currentCall.callerName if $currentCall.callerName
    log( "Caller: " + caller_info['caller_number'] )
  end

  # section 1.4 in the specs
  # attention, the specs defined this to send a report for callback, instead we want to redirect
  def urgent_action
    phone = @site['data']['phone']
    transfer(phone, {:answerOnMedia => true})
  end

  # section 1.3 in the specs
  def money_demanded

    kick_out_after_too_many_retries_for!(:money_demanded)

    question = isay("3_1_a__if_spent_less_that_500_or_more_than_500")
    options = @ask_default_options.merge(:choices => "1,2",
                                         :onChoice => lambda { |event| store_and_confirm_money_code(event) },
                                         :onBadChoice => lambda { |event| money_demanded },
                                         :onTimeout => lambda { |event| money_demanded })
    event = ask(question, options)
  end



  def store_and_confirm_money_code(event)

    log("trying to store money code")

    @money_code = event.value 
    
    unless MONEY_CODES[@money_code]
      log("Something went wrong - no valid money code, but still trying to store: #{event}")
      money_demanded
    end

    log("User choose money_code #{@money_code} (#{MONEY_CODES[@money_code]})")
    log("In site #{@site['id']}")

    confirm_money_code
  end

  def confirm_money_code

    kick_out_after_too_many_retries_for!(:confirm_money_code)

    question = isay(@site['id']+"_Money_Demanded_"+MONEY_CODES[@money_code])
    event = ask(question, @ask_default_options.merge(:choices => '1,2',
                                                     :onBadChoice => lambda { |event| confirm_money_code},
                                                     :onTimeout => lambda { |event| confirm_money_code},
                                                     :onChoice => lambda { |event| react_on_confirmed_money_code(event)}))
  end

  def react_on_confirmed_money_code(event)
    if event.value == "1"
      log("User confirmed amount of money")
      byenow!
    else
      log('User did not confirm money code. Redirecting back to choosing incident')
      reset_retry_counts
      # send back to choose incident code
      get_incident_code_and_type!
    end
  end

  # def sorry_message(event)
  #   if DEBUG
  #     say("sorry! sending you back to the main menu")
  #     _log("We're in sorry_message, so something has gone horribly wrong!")
  #     caller_info.each_pair do |k,v|
  #       log("Key named: #{k} with value: #{v}")
  #     end
  #   end

  #   log("IVRS 0.3 - Caller at #{current_info['caller_number']} was unable to use the menu :(")
  #   say("ok, sending you back to the main menu!")
  #   wait(300);
  #   # TODO somethin shoud be called here, it's main in php
  # end

  def incident_action!
    log("getting the right action for incident")
    case @incident['id']
    when '0'
      urgent_action
    else
      money_demanded
    end
  end

  def store_incident_code(choice_event)
    @incident ||= {}
    @incident['id'] = choice_event.value
    @incident['data'] = INCIDENTS[choice_event.value]
    log("Incident is: #{@incident['id']}: #{@incident['data']}")
  end

  # TODO
  def capture_data!
    client = UshahidiClient.new
    log("about to post report #{report} using #{client}")
    res = client.post_report(report)
    log("got this response from ushahidi: #{res}")
  end

  def report
    lat, lon = lat_lon
    description = @incident['data']
    if money_description = MONEY_DESCRIPTION[@money_code]
      description << " #{money_description}"
    end
    {
      :title => @incident['data'],
      :category => '1',
      :latitude => lat,
      :longitude => lon,
      :description => description,
      :location_name => @site['data']['name']

    }
  end

  def lat_lon
    @site['data']['location'].split(',')
  end

  def byenow!
    say(isay("0_2_End_Message_1_Thank_You"))
    capture_data!
    hangup!
  end

  def hangup!
    hangup
  end

  def maintenance_authorized!
    @maintenance_authorized = true
    say "Maintenance mode entered. Warning, Hull breach imminent!"
  end

  def kick_out_after_too_many_retries_for!(action)
    @retries[action] ||= 0
    invalid_choice if @retries[action] > 2
    @retries[action] += 1
    log("=========================== Count for action '#{action}': #{@retries[action]}")
  end

  def reset_retry_counts
    @retries.each_pair{|k,v| @retries[k] = 0}
    log("==== retry counts resetted")
  end

  def invalid_choice
    say(isay("0_3_End_Message_2_Not_entered_a_valid_choice"))
    hangup!
  end

end

Call.new.run
