namespace :collections do

  desc 'Import all artists, artworks and galleries'
  task import_all: :environment do

    # RestClient::Response objects are a subclass of String
    response = RestClient.get(ENV['collections_data_service_url'] + '/artworks?per_page=1000') # &page=77')

    # Parse into JSON
    json = JSON.parse(response, symbolize_names: true )

    while json[:pagination][:links][:next] do
    
      # Get the data part, for now...
      data = json[:data]

      data.each do |artwork|
        artw = Artwork.find_or_create_by(api_id: artwork[:id])
        artw.api_id = artwork[:id]
        artw.title = artwork[:title]
        artw.citi_id = artwork[:ids][:citi]
        artw.main_id = artwork[:ids][:main]
        artw.lake_uid = artwork[:ids][:lake][:uid]
        artw.lake_guid = artwork[:ids][:lake][:guid]
        artw.lake_uri = artwork[:ids][:lake][:uri]
        artw.title_raw = artwork[:titles][:raw]
        artw.title_display = artwork[:titles][:display]
        artw.date_start = artwork[:dates][:start]
        artw.date_end = artwork[:dates][:end]
        artw.date_display = artwork[:dates][:display]
        artw.creator_lake_uid = artwork[:creator][:id]
        artw.cerator_raw = artwork[:creator][:raw]
        artw.creator_display = artwork[:creator][:display]
        artw.department_lake_uid = artwork[:department][:id]
        artw.department_display = artwork[:department][:display]
        artw.dimensions = artwork[:dimensions]
        artw.medium_raw = artwork[:medium][:raw]
        artw.medium_display = artwork[:medium][:display]
        artw.inscriptions = artwork[:inscriptions]
        artw.credit_line = artwork[:credit_line]
        artw.history_publications = artwork[:history][:publications]
        artw.history_exhibitions = artwork[:history][:exhibitions]
        artw.history_provenance = artwork[:history][:provenance]
        artw.api_created_at = artwork[:created_at]
        artw.api_created_by = artwork[:created_by]
        artw.api_modified_at = artwork[:modified_at]
        artw.api_modified_by = artwork[:modified_by]
        artw.save
      end

      # RestClient::Response objects are a subclass of String
      response = RestClient.get(json[:pagination][:links][:next])

      # Parse into JSON
      json = JSON.parse(response, symbolize_names: true )
    end
  end
end
