<?php

namespace App\Models;

trait TransformableRefactor
{

    public function transform(array $requestedFields = null)
    {
        $transformer = app('Resources')->getTransformerForModel(get_called_class());

        return (new $transformer)->transform($this);
    }


    /**
     * Jury-rig a connection to the transformer class.
     *
     * @return array
     */
    protected function transformMapping()
    {
        $transformerClass = app('Resources')->getTransformerForModel(get_called_class());

        $fields = (new $transformerClass)->getMappedFields();

        // TODO: Fix references to transformMapping to use keys instead of 'name'
        foreach ($fields as $fieldName => $fieldMapping)
        {
            $fields[$fieldName]['name'] = $fieldName;
        }

        return $fields;
    }

}
