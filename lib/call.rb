class Call < ActiveRecord::Base

   cattr_reader :per_page
   @@per_page = 10

   def some_data
      data[:some_data]
   end

   def some_data= v
      data[:some_data] = v
   end
   def ushahidi_url
      data[:ushahidi_url]
   end

   def ushahidi_url= v
      data[:ushahidi_url] = v
   end

   before_create :api_call

   ##
   ## Relations
   ##

   #
   # Behaviour
   #

   ##
   ## Validations
   ##

   serialize :data, Hash

   #
   # Nested Attributes
   #

   #
   # Scopes
   #

   #
   # Filter Definitions
   #

   def api_call

      if valid?
         if foo

            tropo_options = { :call => { } }

            tropo_options[:call][:bar] = self.foo

            begin
               result = TropoClient.new.get(:calls,tropo_options)
            rescue => e
               e_message = e.message
            end

            if result
               self.some_data = result.some_data
               self.data[:some_data] = result.some_data

            else
               message = I18n.t("errors.tropo.request_failed", { :message => e_message })
               api_errors[:tropo] = message
            end
         end
         validate_api_requests_successful

         if username

            ushahidi_options = { :report => { } }

            ushahidi_options[:report][:username] = self.username

            begin
               result = UshahidiClient.new.post(:reports,ushahidi_options)
            rescue => e
               e_message = e.message
            end

            if result
               self.ushahidi_url = result.some_data
               self.data[:ushahidi_url] = result.some_data

            else
               message = I18n.t("errors.ushahidi.request_failed", { :message => e_message })
               api_errors[:ushahidi] = message
            end
         end
         validate_api_requests_successful

      end

   end

   #
   # Other
   #

end
