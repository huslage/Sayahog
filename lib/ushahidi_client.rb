require 'net/http'

USHAHIDI_CONFIG = {
  :url => 'ec2-50-112-5-172.us-west-2.compute.amazonaws.com/admin',
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
      :incident_title => '',
      :incident_description => report[:incident_description],
      :incident_category => report[:category],
      :incident_date => get_date_and_time[:date],
      :incident_hour => get_date_and_time[:hours],
      :incident_minute => get_date_and_time[:minutes],
      :incident_ampm => get_date_and_time[:am_pm],
      :latitude => report[:latitude],
      :longitude => report[:longitude],
      :location_name => ''
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
