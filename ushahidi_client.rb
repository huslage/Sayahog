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
      :incident_description => report,
      :incident_date => format_date( Date.new ),
      :incident_hour => get_the_time[:hours],
      :incident_minute => get_the_time[:minutes],
      :incident_ampm => get_the_time[:am_pm],
      :incident_category => '',
      :latitude => geolocation[:latitude],
      :longitude => geolocation[:longitude],
      :location_name => '',
      # 'incident_photo[]' => File.new('/Users/amantini/Desktop/werner.jpg', 'rb')
    }
  end

  def format_date date
  end

  def get_the_time
  end

  def geolocation
  end

end
