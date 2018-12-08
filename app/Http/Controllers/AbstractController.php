<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Closure;

use Aic\Hub\Foundation\Exceptions\BigLimitException;
use Aic\Hub\Foundation\Exceptions\InvalidSyntaxException;
use Aic\Hub\Foundation\Exceptions\ItemNotFoundException;
use Aic\Hub\Foundation\Exceptions\TooManyIdsException;

use Aic\Hub\Foundation\AbstractController as BaseController;

abstract class AbstractController extends BaseController
{

    /**
     * Return a response with a single resource, given an Eloquent Model.
     *
     * @param  \Illuminate\Database\Eloquent\Model $item
     * @param  array|string|null $fields
     * @return \Illuminate\Http\Response
     */
    protected function itemResponse(Model $item, $fields = null)
    {
        return response()->item($item, new $this->transformer($fields));
    }


    /**
     * Return a response with multiple resources, given an arrayable object.
     * For multiple ids, this is a an Eloquent Collection.
     * For pagination, this is LengthAwarePaginator.
     *
     * @param  \Illuminate\Contracts\Support\Arrayable $arrayable
     * @param  array|string|null $fields
     * @return \Illuminate\Http\Response
     */
    protected function collectionResponse(Arrayable $arrayable, $fields = null)
    {
        return response()->collection($arrayable, new $this->transformer($fields));
    }


    /**
     * Return a single resource. Not meant to be called directly in routes.
     * `$callback` should return an Eloquent Model.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $callback
     * @return \Illuminate\Http\Response
     */
    protected function select( Request $request, Closure $callback )
    {

        $this->validateMethod( $request );

        $id = $request->route('id');

        if (!$this->validateId( $id ))
        {
            throw new InvalidSyntaxException();
        }

        $item = $callback( $id );

        if (!$item)
        {
            throw new ItemNotFoundException();
        }

        $fields = Input::get('fields');

        return $this->itemResponse($item, $fields);

    }


    /**
     * Return a list of resources. Not meant to be called directly in routes.
     * `$callback` should return LengthAwarePaginator.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $callback
     * @return \Illuminate\Http\Response
     */
    protected function collect( Request $request, Closure $callback )
    {

        $this->validateMethod( $request );

        // Process ?ids= query param
        $ids = $request->input('ids');

        if ($ids)
        {
            return $this->showMutliple($ids);
        }

        // Check if the ?limit= is too big
        $limit = $request->input('limit') ?: 12;

        if ($limit > static::LIMIT_MAX)
        {
            throw new BigLimitException();
        }

        // This would happen for subresources
        $id = $request->route('id');

        // Assumes the inheriting class set model and transformer
        // \Illuminate\Contracts\Pagination\LengthAwarePaginator
        $all = $callback( $limit, $id );

        $fields = Input::get('fields');

        return $this->collectionResponse($all, $fields);

    }


    /**
     * Display multiple resources.
     *
     * @param string $ids
     * @return \Illuminate\Http\Response
     */
    protected function showMutliple($ids = '')
    {

        // TODO: Accept an array, not just comma-separated string
        $ids = explode(',', $ids);

        if (count($ids) > static::LIMIT_MAX)
        {
            throw new TooManyIdsException();
        }

        // Validate the syntax for each $id
        foreach( $ids as $id )
        {

            if (!$this->validateId( $id ))
            {
                throw new InvalidSyntaxException();
            }

        }

        // Illuminate\Database\Eloquent\Collection
        $all = $this->find($ids);

        $fields = Input::get('fields');

        return $this->collectionResponse($all, $fields);

    }

}
