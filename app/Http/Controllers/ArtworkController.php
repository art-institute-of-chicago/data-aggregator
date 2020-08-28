<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\ArraySerializer;

use App\Models\Collections\Artwork;
use App\Transformers\Outbound\Collections\ArtworkManifest;

use Aic\Hub\Foundation\Exceptions\InvalidSyntaxException;
use Aic\Hub\Foundation\Exceptions\ItemNotFoundException;

class ArtworkController extends ResourceController
{

    public function __construct()
    {
        $this->fractal = app()->make('League\Fractal\Manager');
        $this->fractal->setSerializer(new ArraySerializer());
    }
    public function manifest(Request $request, $id)
    {
        $this->validateMethod($request);

        if (!$this->validateId($id)) {
            throw new InvalidSyntaxException();
        }

        $item = Artwork::find($id);

        if (!$item) {
            throw new ItemNotFoundException();
        }

        $resource = new Item($item, new ArtworkManifest());
        return $this->fractal->createData($resource)->toArray();

    }

}
