require 'test_helper'

class ArtworksControllerTest < ActionDispatch::IntegrationTest
  setup do
    @artwork = artworks(:one)
  end

  test "should get index" do
    get artworks_url
    assert_response :success
  end

  test "should get new" do
    get new_artwork_url
    assert_response :success
  end

  test "should create artwork" do
    assert_difference('Artwork.count') do
      post artworks_url, params: { artwork: { api_created_at: @artwork.api_created_at, api_created_by: @artwork.api_created_by, api_id: @artwork.api_id, api_modified_at: @artwork.api_modified_at, api_modified_by: @artwork.api_modified_by, cerator_raw: @artwork.cerator_raw, citi_id: @artwork.citi_id, creator_display: @artwork.creator_display, creator_lake_uid: @artwork.creator_lake_uid, credit_line: @artwork.credit_line, date_display: @artwork.date_display, date_end: @artwork.date_end, date_start: @artwork.date_start, department_display: @artwork.department_display, department_lake_uid: @artwork.department_lake_uid, dimensions: @artwork.dimensions, history_exhibitions: @artwork.history_exhibitions, history_provenance: @artwork.history_provenance, history_publications: @artwork.history_publications, inscriptions: @artwork.inscriptions, lake_guid: @artwork.lake_guid, lake_uid: @artwork.lake_uid, lake_uri: @artwork.lake_uri, main_id: @artwork.main_id, medium_display: @artwork.medium_display, medium_raw: @artwork.medium_raw, title: @artwork.title, title_display: @artwork.title_display, title_raw: @artwork.title_raw } }
    end

    assert_redirected_to artwork_url(Artwork.last)
  end

  test "should show artwork" do
    get artwork_url(@artwork)
    assert_response :success
  end

  test "should get edit" do
    get edit_artwork_url(@artwork)
    assert_response :success
  end

  test "should update artwork" do
    patch artwork_url(@artwork), params: { artwork: { api_created_at: @artwork.api_created_at, api_created_by: @artwork.api_created_by, api_id: @artwork.api_id, api_modified_at: @artwork.api_modified_at, api_modified_by: @artwork.api_modified_by, cerator_raw: @artwork.cerator_raw, citi_id: @artwork.citi_id, creator_display: @artwork.creator_display, creator_lake_uid: @artwork.creator_lake_uid, credit_line: @artwork.credit_line, date_display: @artwork.date_display, date_end: @artwork.date_end, date_start: @artwork.date_start, department_display: @artwork.department_display, department_lake_uid: @artwork.department_lake_uid, dimensions: @artwork.dimensions, history_exhibitions: @artwork.history_exhibitions, history_provenance: @artwork.history_provenance, history_publications: @artwork.history_publications, inscriptions: @artwork.inscriptions, lake_guid: @artwork.lake_guid, lake_uid: @artwork.lake_uid, lake_uri: @artwork.lake_uri, main_id: @artwork.main_id, medium_display: @artwork.medium_display, medium_raw: @artwork.medium_raw, title: @artwork.title, title_display: @artwork.title_display, title_raw: @artwork.title_raw } }
    assert_redirected_to artwork_url(@artwork)
  end

  test "should destroy artwork" do
    assert_difference('Artwork.count', -1) do
      delete artwork_url(@artwork)
    end

    assert_redirected_to artworks_url
  end
end
