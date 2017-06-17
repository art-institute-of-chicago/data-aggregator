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
     *     @SWG\Parameter(name="id", in="path", type="string", required=false),
     *     @SWG\Parameter(name="ids", in="query", type="string"),
     *     @SWG\Parameter(name="limit", in="query", type="integer"),
     *     @SWG\Parameter(name="page", in="query", type="integer"),
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
     *         @SWG\Property(property="agent_id", description="Unique identifier of the agent"),
     *         @SWG\Property(property="agent_display", description="Agent information to display"),
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
     *         definition="Agent", 
     *         type="object",
     *         @SWG\Property(property="id", description="Unique identifier"),
     *         @SWG\Property(property="title", description="Name of the agent"),
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
     *     @SWG\Parameter(ref="#/parameters/ids"),
     *     @SWG\Parameter(ref="#/parameters/limit"),
     *     @SWG\Parameter(ref="#/parameters/page"),
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
     *     @SWG\Parameter(ref="#/parameters/id"),
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
     *     path="/api/v1/artworks/{id}/artists",
     *     summary="The artists for a given artwork",
     *     tags={"artworks"},
     *     produces={"application/json"},
     *     @SWG\Parameter(ref="#/parameters/id"),
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
    Route::any('artworks/{artwork}/artists', 'ApiController@respondMethodNotAllowed');
    Route::get('artworks/{artwork}/artists', 'ArtistsController@index');

    /**
     * @SWG\Get(
     *     path="/api/v1/artworks/{id}/categories",
     *     summary="A list of all publish categories for a given artwork",
     *     tags={"artworks"},
     *     produces={"application/json"},
     *     @SWG\Parameter(ref="#/parameters/id"),
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
     *     path="/api/v1/agents?ids={ids}&limit={limit}&page={page}",
     *     summary="A list of all agents sorted by last updated date in descending order",
     *     tags={"agents"},
     *     produces={"application/json"},
     *     @SWG\Parameter(ref="#/parameters/ids"),
     *     @SWG\Parameter(ref="#/parameters/limit"),
     *     @SWG\Parameter(ref="#/parameters/page"),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Agent")
     *         ),
     *     ),
	 * 	   @SWG\Response(
	 * 		   response="default",
	 * 		   description="error",
	 * 		   @SWG\Schema(ref="#/definitions/Error"),
	 * 	   ),
     * )
     */
    Route::any('agents', 'ApiController@respondMethodNotAllowed');
    Route::get('agents', 'AgentsController@index');


    /**
     * @SWG\Get(
     *     path="/api/v1/agents/{id}",
     *     summary="A single agent by the given identifier",
     *     tags={"agents"},
     *     produces={"application/json"},
     *     @SWG\Parameter(ref="#/parameters/id"),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(
     *             @SWG\Items(ref="#/definitions/Agent")
     *         ),
     *     ),
	 * 	   @SWG\Response(
	 * 		   response="default",
	 * 		   description="error",
	 * 		   @SWG\Schema(ref="#/definitions/Error"),
	 * 	   ),
     * )
     */
    Route::any('agents/{agent}', 'ApiController@respondMethodNotAllowed');
    Route::get('agents/{agent}', 'AgentsController@show');

    /**
     * @SWG\Get(
     *     path="/api/v1/artists?ids={ids}&limit={limit}&page={page}",
     *     summary="A list of all artists sorted by last updated date in descending order",
     *     tags={"artists"},
     *     produces={"application/json"},
     *     @SWG\Parameter(ref="#/parameters/ids"),
     *     @SWG\Parameter(ref="#/parameters/limit"),
     *     @SWG\Parameter(ref="#/parameters/page"),
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
     *     path="/api/v1/artists/{id}",
     *     summary="A single artist by the given identifier",
     *     tags={"artists"},
     *     produces={"application/json"},
     *     @SWG\Parameter(ref="#/parameters/id"),
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
    Route::any('artists/{artist}', 'ApiController@respondMethodNotAllowed');
    Route::get('artists/{artist}', 'ArtistsController@show');

    
    /**
     * @SWG\Get(
     *     path="/api/v1/departments?ids={ids}&limit={limit}&page={page}",
     *     summary="A list of all departments sorted by last updated date in descending order",
     *     tags={"departments"},
     *     produces={"application/json"},
     *     @SWG\Parameter(ref="#/parameters/ids"),
     *     @SWG\Parameter(ref="#/parameters/limit"),
     *     @SWG\Parameter(ref="#/parameters/page"),
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
     *     path="/api/v1/departments/{id}",
     *     summary="A single department by the given identifier",
     *     tags={"departments"},
     *     produces={"application/json"},
     *     @SWG\Parameter(ref="#/parameters/id"),
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
    Route::any('departments/{department}', 'ApiController@respondMethodNotAllowed');
    Route::get('departments/{department}', 'DepartmentsController@show');

    /**
     * @SWG\Get(
     *     path="/api/v1/object0types?ids={ids}&limit={limit}&page={page}",
     *     summary="A list of all object types sorted by last updated date in descending order",
     *     tags={"objectTypes"},
     *     produces={"application/json"},
     *     @SWG\Parameter(ref="#/parameters/ids"),
     *     @SWG\Parameter(ref="#/parameters/limit"),
     *     @SWG\Parameter(ref="#/parameters/page"),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/ObjectType")
     *         ),
     *     ),
	 * 	   @SWG\Response(
	 * 		   response="default",
	 * 		   description="error",
	 * 		   @SWG\Schema(ref="#/definitions/Error"),
	 * 	   ),
     * )
     */
    Route::any('object-types', 'ApiController@respondMethodNotAllowed');
    Route::get('object-types', 'ObjectTypesController@index');


    /**
     * @SWG\Get(
     *     path="/api/v1/object-types/{id}",
     *     summary="A single object type by the given identifier",
     *     tags={"objectTypes"},
     *     produces={"application/json"},
     *     @SWG\Parameter(ref="#/parameters/id"),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(
     *             @SWG\Items(ref="#/definitions/ObjectType")
     *         ),
     *     ),
	 * 	   @SWG\Response(
	 * 		   response="default",
	 * 		   description="error",
	 * 		   @SWG\Schema(ref="#/definitions/Error"),
	 * 	   ),
     * )
     */
    Route::any('object-types/{objectType}', 'ApiController@respondMethodNotAllowed');
    Route::get('object-types/{objectType}', 'ObjectTypesController@show');


    /**
     * @SWG\Get(
     *     path="/api/v1/categories?ids={ids}&limit={limit}&page={page}",
     *     summary="A list of all publish categories sorted by last updated date in descending order",
     *     tags={"categories"},
     *     produces={"application/json"},
     *     @SWG\Parameter(ref="#/parameters/ids"),
     *     @SWG\Parameter(ref="#/parameters/limit"),
     *     @SWG\Parameter(ref="#/parameters/page"),
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

    /**
     * @SWG\Get(
     *     path="/api/v1/categories/{id}",
     *     summary="A single category by the given identifier",
     *     tags={"categories"},
     *     produces={"application/json"},
     *     @SWG\Parameter(ref="#/parameters/id"),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(
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
    Route::any('categories/{category}', 'ApiController@respondMethodNotAllowed');
    Route::get('categories/{category}', 'CategoriesController@show');


    /**
     * @SWG\Get(
     *     path="/api/v1/agent-types?ids={ids}&limit={limit}&page={page}",
     *     summary="A list of all agent types sorted by last updated date in descending order",
     *     tags={"agentTypes"},
     *     produces={"application/json"},
     *     @SWG\Parameter(ref="#/parameters/ids"),
     *     @SWG\Parameter(ref="#/parameters/limit"),
     *     @SWG\Parameter(ref="#/parameters/page"),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/AgentType")
     *         ),
     *     ),
	 * 	   @SWG\Response(
	 * 		   response="default",
	 * 		   description="error",
	 * 		   @SWG\Schema(ref="#/definitions/Error"),
	 * 	   ),
     * )
     */
    Route::any('agent-types', 'ApiController@respondMethodNotAllowed');
    Route::get('agent-types', 'AgentTypesController@index');

    /**
     * @SWG\Get(
     *     path="/api/v1/agent-types/{id}",
     *     summary="A single agent type by the given identifier",
     *     tags={"agentTypes"},
     *     produces={"application/json"},
     *     @SWG\Parameter(ref="#/parameters/id"),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(
     *             @SWG\Items(ref="#/definitions/AgentType")
     *         ),
     *     ),
	 * 	   @SWG\Response(
	 * 		   response="default",
	 * 		   description="error",
	 * 		   @SWG\Schema(ref="#/definitions/Error"),
	 * 	   ),
     * )
     */
    Route::any('agent-types/{agentType}', 'ApiController@respondMethodNotAllowed');
    Route::get('agent-types/{agentType}', 'AgentTypesController@show');

});
