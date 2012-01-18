CONFIG = {
  :url => 'https://d3volapi.crowdmap.com/api/',
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

  attr_reader :credentials

  def initialize(credentials)
    @credentials = { :user => credentials[:user], :password => credentials[:password] }
  end

  def build_request_hash( url, options, payload = nil )

    request_hash = {
      :url => url,
      :headers => {
        :params => options,
        :accept => :json,
        :content_type => :json
      },
    }
    request_hash.merge!( credentials)
    request_hash.merge!( :payload => payload ) if payload
    request_hash
  end

  def get url, options
    RestClient::Request.new( build_request_hash(url, options).merge( :method => :get ) ).execute
  end

  def post url, options={ }, payload=nil
    RestClient::Request.new( build_request_hash(url, options, payload).merge( :method => :post ) ).execute
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
    gateway.post( url, { }, fill_in_arguments(report) )
  end

  private

  def fill_in_arguments report
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
