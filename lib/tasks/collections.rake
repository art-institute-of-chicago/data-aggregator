namespace :collections do
  desc "Import all artists, artworks and galleries"
  task import_all: :environment do

    list = RestClient.get 'http://localhost:9393/v1/artworks'
    puts list
    list['data'].each do |artwork|
      puts artwork[:id]
    end

    
  end

end
