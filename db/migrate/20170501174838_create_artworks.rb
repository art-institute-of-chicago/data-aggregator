class CreateArtworks < ActiveRecord::Migration[5.1]
  def change
    create_table :artworks do |t|
      t.integer :api_id
      t.string :title
      t.integer :citi_id
      t.string :main_id
      t.string :lake_uid
      t.string :lake_guid
      t.string :lake_uri
      t.string :title_raw
      t.string :title_display
      t.integer :date_start
      t.integer :date_end
      t.string :date_display
      t.string :creator_lake_uid
      t.string :cerator_raw
      t.string :creator_display
      t.string :department_lake_uid
      t.string :department_display
      t.string :dimensions
      t.string :medium_raw
      t.string :medium_display
      t.string :inscriptions
      t.string :credit_line
      t.text :history_publications
      t.text :history_exhibitions
      t.text :history_provenance
      t.datetime :api_created_at
      t.string :api_created_by
      t.datetime :api_modified_at
      t.string :api_modified_by

      t.timestamps
    end
  end
end
