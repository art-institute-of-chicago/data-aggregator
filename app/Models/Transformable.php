<?php

namespace App\Models;

trait Transformable
{

    public function transform(array $requestedFields = null)
    {
        $transformer = app('Resources')->getTransformerForModel(get_called_class());

        // WEB-1953: Set $isRestricted to false here; index all fields
        return (new $transformer(null, false, false))->transform($this);
    }

    /**
     * Jury-rig a connection to the transformer class.
     *
     * @return array
     */
    protected function transformMapping()
    {
        $transformerClass = app('Resources')->getTransformerForModel(get_called_class());

        $fields = (new $transformerClass())->getMappedFields();

        // TODO: Fix references to transformMapping to use keys instead of 'name'
        foreach ($fields as $fieldName => $fieldMapping) {
            $fields[$fieldName]['name'] = $fieldName;
        }

        return $fields;
    }
}
