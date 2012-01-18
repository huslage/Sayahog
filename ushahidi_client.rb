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
      #  :multipart => true,
      :task => 'report',
      :incident_title => '',
      :incident_description => report[:incident_description],
      :incident_date => format_date( Date.new ),
      :incident_hour => get_the_time[:hours],
      :incident_minute => get_the_time[:minutes],
      :incident_ampm => get_the_time[:am_pm],
      :incident_category => report[:category],
      :latitude => report[:latitude],
      :longitude => report[:longitude],
      :location_name => '',
      # 'incident_photo[]' => File.new('/Users/amantini/Desktop/werner.jpg', 'rb')
    }
  end

  def format_date date
  end

  def get_the_time
  end

end
