namespace :collections do

  desc "Import all artists, artworks and galleries"
  task import_all: :environment do

  	# RestClient::Response objects are a subclass of String
    response = RestClient.get('http://localhost:9393/v1/artworks')

    # Parse into JSON
    json = JSON.parse(response, {:symbolize_names => true})

    # Get the data part, for now...
    data = json[:data]

    data.each do |artwork|
      puts artwork[:id]
    end

  end

end
