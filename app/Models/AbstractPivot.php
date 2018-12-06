<?php

namespace App\Models;

use App\Models\Instancable;
use App\Models\Transformable;
use App\Models\Fakeable;

use Illuminate\Database\Eloquent\Relations\Pivot;

abstract class AbstractPivot extends Pivot
{

    use Instancable, Transformable, Fakeable;

    // TODO: Abstract `getDate` logic from BaseModel into Trait, so that we can `use` it here?

    /**
     * Validate an id. Useful for validating routes or query string params.
     *
     * By default, only numeric ids greater than zero are accepted. Override this
     * method in child classes to implement different validation rules (e.g. UUID).
     *
     * @param mixed $id
     * @return boolean
     */
    public static function validateId( $id )
    {

        // By default, only allow numeric ids greater than 0
        return is_numeric($id) && intval($id) > 0;

    }

}
