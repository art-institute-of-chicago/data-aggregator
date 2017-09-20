<?php

return [

    /*
    |--------------------------------------------------------------------------
    | No `data` wrapper in API output
    |--------------------------------------------------------------------------
    |
    | When including elements in our API, the default behavior is to wrap the
    | incuded data in a `data` element. This is unpretty, and implies that
    | features like pagination are available with included elements, which
    | they are not. This constant is used when passed to included element
    | Transformers to omit the `data` element.
    */

    'no_data_wrapper' => false,

];
