# This file is auto-generated from the current state of the database. Instead
# of editing this file, please use the migrations feature of Active Record to
# incrementally modify your database, and then regenerate this schema definition.
#
# Note that this schema.rb definition is the authoritative source for your
# database schema. If you need to create the application database on another
# system, you should be using db:schema:load, not running all the migrations
# from scratch. The latter is a flawed and unsustainable approach (the more migrations
# you'll amass, the slower it'll run and the greater likelihood for issues).
#
# It's strongly recommended that you check this file into your version control system.

ActiveRecord::Schema.define(version: 20170501174838) do

  create_table "artworks", force: :cascade, options: "ENGINE=InnoDB DEFAULT CHARSET=utf8" do |t|
    t.integer "api_id"
    t.string "title"
    t.integer "citi_id"
    t.string "main_id"
    t.string "lake_uid"
    t.string "lake_guid"
    t.string "lake_uri"
    t.string "title_raw"
    t.string "title_display"
    t.integer "date_start"
    t.integer "date_end"
    t.string "date_display"
    t.string "creator_lake_uid"
    t.string "cerator_raw"
    t.string "creator_display"
    t.string "department_lake_uid"
    t.string "department_display"
    t.string "dimensions"
    t.string "medium_raw"
    t.string "medium_display"
    t.string "inscriptions"
    t.string "credit_line"
    t.text "history_publications"
    t.text "history_exhibitions"
    t.text "history_provenance"
    t.datetime "api_created_at"
    t.string "api_created_by"
    t.datetime "api_modified_at"
    t.string "api_modified_by"
    t.datetime "created_at", null: false
    t.datetime "updated_at", null: false
  end

end
