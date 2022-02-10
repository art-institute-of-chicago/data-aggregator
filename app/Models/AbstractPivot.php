<?php

namespace App\Models;

use Aic\Hub\Foundation\Models\Concerns\Singletonable;
use Illuminate\Database\Eloquent\Relations\Pivot;

abstract class AbstractPivot extends Pivot
{
    use Singletonable;
    use Transformable;

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
    public static function validateId($id)
    {
        // By default, only allow numeric ids greater than 0
        return is_numeric($id) && (int) $id > 0;
    }
}
