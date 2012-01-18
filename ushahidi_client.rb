require 'net/http'

CONFIG = {
  :url => 'd3volapi.crowdmap.com/api',
  :geo_url => 'http://maps.googleapis.com/maps/api/geocode/json',
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
      :user => 'apitests@0xb5.org',
      :password => 'd3volute!' },
  },
}



class UshahidiGateway

  attr_reader :user, :password

  def initialize(credentials)
    # @credentials = { :user => credentials[:user], :password => credentials[:password] }
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
    @config = CONFIG
    @gateway = UshahidiGateway.new( config[:authentication][:basic_auth] )
    @url = config[:url]
  end


  def post_report report
    gateway.post( url, build_options_from(report) )
  end

  private

  def build_options_from report
    payload = {
      #  :multipart => true,
      :task => 'report',
      :incident_title => '',
      :incident_description => report[:incident_description],
      :incident_date => get_date_and_time[:date],
      :incident_hour => get_date_and_time[:hours],
      :incident_minute => get_date_and_time[:minutes],
      :incident_ampm => get_date_and_time[:am_pm],
      :incident_category => '',
      :latitude => report[:latitude],
      :longitude => report[:longitude],
      :location_name => '',
      # 'incident_photo[]' => File.new('/Users/amantini/Desktop/werner.jpg', 'rb')
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
