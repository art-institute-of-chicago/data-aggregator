<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function()
{

    /**
     * @SWG\Swagger(
     *     schemes={"https"},
     *     host="artic.edu",
     *     basePath="/api/v1",
     *     @SWG\Info(
     *         version="1.0.0",
     *         title="Art Institution of Chicago API",
     *         description="An API for an aggregator of Art Institute of Chicago data",
     *         termsOfService="",
     *         @SWG\Contact(
     *             email="museumtechnology@artic.edu"
     *         ),
     *         @SWG\License(
     *             name="",
     *         )
     *     ),
     *     @SWG\ExternalDocumentation(
     *         description="Find out more about open source at the Art Institute of Chicago",
     *         url="http://www.github.com/art-insititute-of-chicago"
     *     ),
     *     @SWG\Parameter(parameter="id_in_path", name="id", type="integer", in="path", required=false),
     *     @SWG\Parameter(parameter="ids_in_query", name="ids", type="integer", in="query", required=false),
     *     @SWG\Parameter(parameter="limit_in_query", name="limit", type="integer", in="query", required=false),
     *     @SWG\Parameter(parameter="page_in_query", name="page", type="integer", in="query", required=false),
     * 	   @SWG\Definition(
     * 		   definition="Error",
     * 		   required={"status", "error", "detail"},
     *		   @SWG\Property(property="status", type="integer"),
     *		   @SWG\Property(property="error", type="string"),
     *		   @SWG\Property(property="detail", type="string"),
     * 	   ),
     *     @SWG\Definition(
     *         definition="Artwork", 
     *         type="object",
     *         @SWG\Property(property="id", description="Unique identifier"),
     *         @SWG\Property(property="title", description="Name of the artwork"),
     *         @SWG\Property(property="main_reference_number"),
     *         @SWG\Property(property="date_start", description="Earliest creation date"),
     *         @SWG\Property(property="date_end", description="Latest creation date"),
     *         @SWG\Property(property="date_display", description="Date information to display"),
     *         @SWG\Property(property="artist_id", description="Unique identifier of the artist"),
     *         @SWG\Property(property="artist_display", description="Artist information to display"),
     *         @SWG\Property(property="deparment_id", description="Uniqie identifier of the department"),
     *         @SWG\Property(property="dimension"),
     *         @SWG\Property(property="medium"),
     *         @SWG\Property(property="inscriptions"),
     *         @SWG\Property(property="credit_line"),
     *         @SWG\Property(property="publication_history"),
     *         @SWG\Property(property="exhibition_history"),
     *         @SWG\Property(property="provenance_text"),
     *         @SWG\Property(property="last_updated_lpm_fedora"),
     *         @SWG\Property(property="last_updated_lpm_solr"),
     *         @SWG\Property(property="last_updated"),
     * 	   ),
     *     @SWG\Definition(
     *         definition="Artist", 
     *         type="object",
     *         @SWG\Property(property="id", description="Unique identifier"),
     *         @SWG\Property(property="title", description="Name of the artist"),
     *         @SWG\Property(property="birth_date"),
     *         @SWG\Property(property="death_date"),
     *         @SWG\Property(property="last_updated_lpm_fedora"),
     *         @SWG\Property(property="last_updated_lpm_solr"),
     *         @SWG\Property(property="last_updated"),
     * 	   ),
     *     @SWG\Definition(
     *         definition="Category",
     *         type="object",
     *         @SWG\Property(property="id", description="Unique identifier"),
     *         @SWG\Property(property="title", description="Name of the publish category"),
     *         @SWG\Property(property="last_updated_lpm_fedora"),
     *         @SWG\Property(property="last_updated_lpm_solr"),
     *         @SWG\Property(property="last_updated"),
     * 	   ),
     *     @SWG\Definition(
     *         definition="Department",
     *         type="object",
     *         @SWG\Property(property="id", description="Unique identifier"),
     *         @SWG\Property(property="title", description="Name of the department"),
     *         @SWG\Property(property="last_updated_lpm_fedora"),
     *         @SWG\Property(property="last_updated_lpm_solr"),
     *         @SWG\Property(property="last_updated"),
     * 	   ),
     * )
     */
    Route::get('swagger.json', 'SwaggerController@index');

    /**
     * @SWG\Get(
     *     path="/api/v1/artworks?ids={ids}&limit={limit}&page={page}",
     *     summary="A list of all artworks sorted by last updated date in descending order",
     *     tags={"artworks"},
     *     produces={"application/json"},
     *     @SWG\Parameter(ref="#/parameters/ids_in_query"),
     *     @SWG\Parameter(ref="#/parameters/limit_in_query"),
     *     @SWG\Parameter(ref="#/parameters/page_in_query"),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Artwork")
     *         ),
     *     ),
	 * 	   @SWG\Response(
	 * 		   response="default",
	 * 		   description="error",
	 * 		   @SWG\Schema(ref="#/definitions/Error"),
	 * 	   ),
     * )
     */
    Route::any('artworks', 'ApiController@respondMethodNotAllowed');
    Route::get('artworks', 'ArtworksController@index');

    /**
     * @SWG\Get(
     *     path="/api/v1/artworks/{id}",
     *     summary="A single artwork by the given identifier",
     *     tags={"artworks"},
     *     produces={"application/json"},
     *     @SWG\Parameter(ref="#/parameters/id_in_path"),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(
     *             @SWG\Items(ref="#/definitions/Artwork")
     *         ),
     *     ),
	 * 	   @SWG\Response(
	 * 		   response="default",
	 * 		   description="error",
	 * 		   @SWG\Schema(ref="#/definitions/Error"),
	 * 	   ),
     * )
     */
    Route::any('artworks/{artwork}', 'ApiController@respondMethodNotAllowed');
    Route::get('artworks/{artwork}', 'ArtworksController@show');

    /**
     * @SWG\Get(
     *     path="/api/v1/artworks/{id}/artist",
     *     summary="The artist for a given artwork",
     *     tags={"artworks"},
     *     produces={"application/json"},
     *     @SWG\Parameter(ref="#/parameters/id_in_path"),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(
     *             @SWG\Items(ref="#/definitions/Artist")
     *         ),
     *     ),
	 * 	   @SWG\Response(
	 * 		   response="default",
	 * 		   description="error",
	 * 		   @SWG\Schema(ref="#/definitions/Error"),
	 * 	   ),
     * )
     */
    Route::any('artworks/{artwork}/artist', 'ApiController@respondMethodNotAllowed');
    Route::get('artworks/{artwork}/artist', 'ArtistsController@index');

    /**
     * @SWG\Get(
     *     path="/api/v1/artworks/{id}/department",
     *     summary="The department for a given artwork",
     *     tags={"artworks"},
     *     produces={"application/json"},
     *     @SWG\Parameter(ref="#/parameters/id_in_path"),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(
     *             @SWG\Items(ref="#/definitions/Department")
     *         ),
     *     ),
	 * 	   @SWG\Response(
	 * 		   response="default",
	 * 		   description="error",
	 * 		   @SWG\Schema(ref="#/definitions/Error"),
	 * 	   ),
     * )
     */
    Route::any('artworks/{artwork}/department', 'ApiController@respondMethodNotAllowed');
    Route::get('artworks/{artwork}/department', 'DepartmentsController@index');

    /**
     * @SWG\Get(
     *     path="/api/v1/artworks/{id}/categories",
     *     summary="A list of all publish categories for a given artwork",
     *     tags={"artworks"},
     *     produces={"application/json"},
     *     @SWG\Parameter(ref="#/parameters/id_in_path"),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Category")
     *         ),
     *     ),
	 * 	   @SWG\Response(
	 * 		   response="default",
	 * 		   description="error",
	 * 		   @SWG\Schema(ref="#/definitions/Error"),
	 * 	   ),
     * )
     */
    Route::any('artworks/{artwork}/categories', 'ApiController@respondMethodNotAllowed');
    Route::get('artworks/{artwork}/categories', 'CategoriesController@index');


    /**
     * @SWG\Get(
     *     path="/api/v1/artists?ids={ids}&limit={limit}&page={page}",
     *     summary="A list of all artists sorted by last updated date in descending order",
     *     tags={"artists"},
     *     produces={"application/json"},
     *     @SWG\Parameter(ref="#/parameters/ids_in_query"),
     *     @SWG\Parameter(ref="#/parameters/limit_in_query"),
     *     @SWG\Parameter(ref="#/parameters/page_in_query"),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Artist")
     *         ),
     *     ),
	 * 	   @SWG\Response(
	 * 		   response="default",
	 * 		   description="error",
	 * 		   @SWG\Schema(ref="#/definitions/Error"),
	 * 	   ),
     * )
     */
    Route::any('artists', 'ApiController@respondMethodNotAllowed');
    Route::get('artists', 'ArtistsController@index');


    /**
     * @SWG\Get(
     *     path="/api/v1/departments?ids={ids}&limit={limit}&page={page}",
     *     summary="A list of all departments sorted by last updated date in descending order",
     *     tags={"departments"},
     *     produces={"application/json"},
     *     @SWG\Parameter(ref="#/parameters/ids_in_query"),
     *     @SWG\Parameter(ref="#/parameters/limit_in_query"),
     *     @SWG\Parameter(ref="#/parameters/page_in_query"),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Department")
     *         ),
     *     ),
	 * 	   @SWG\Response(
	 * 		   response="default",
	 * 		   description="error",
	 * 		   @SWG\Schema(ref="#/definitions/Error"),
	 * 	   ),
     * )
     */
    Route::any('departments', 'ApiController@respondMethodNotAllowed');
    Route::get('departments', 'DepartmentsController@index');


    /**
     * @SWG\Get(
     *     path="/api/v1/categories?ids={ids}&limit={limit}&page={page}",
     *     summary="A list of all publish categories sorted by last updated date in descending order",
     *     tags={"categories"},
     *     produces={"application/json"},
     *     @SWG\Parameter(ref="#/parameters/ids_in_query"),
     *     @SWG\Parameter(ref="#/parameters/limit_in_query"),
     *     @SWG\Parameter(ref="#/parameters/page_in_query"),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Category")
     *         ),
     *     ),
	 * 	   @SWG\Response(
	 * 		   response="default",
	 * 		   description="error",
	 * 		   @SWG\Schema(ref="#/definitions/Error"),
	 * 	   ),
     * )
     */
    Route::any('categories', 'ApiController@respondMethodNotAllowed');
    Route::get('categories', 'CategoriesController@index');

});
