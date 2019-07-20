<?php

namespace App\Transformers;

use Carbon\Carbon;
use JsonSerializable;

class Datum implements JsonSerializable
{

    private $datum;

    private $subdatums = [];

    public function __construct($datum)
    {

        if( is_array( $datum ) )
        {
            $datum = (object) $datum;
        }

        $this->datum = $datum;
    }

    public function __get($field)
    {

        $value = $this->datum->{$field} ?? null;

        return $this->getCleanValue( $value );

    }

    /**
     * Dual-purpose convenience method to force-return data as an array.
     * If `$fields` is omitted, it exposes all data stored in the `datum` property.
     * If `$fields` is defined, it returns the field as an array, even if it's null.
     *
     * @return array
     */
    public function all($field = null)
    {

        if( !isset( $field ) )
        {
            $datum = (array) $this->datum;

            return array_map( [$this, 'getCleanValue'], $datum );
        }

        // Note how we're getting __get() to fire here
        return $this->{$field} ?? [];

    }

    /**
     * Convenience method to return a field as a date.
     *
     * @link http://php.net/manual/en/function.strtotime.php
     *
     * @return int
     */
    public function date($field)
    {

        // Note how we're getting __get() to fire here
        $date = $this->{$field};

        if( is_string( $date ) )
        {
            return strtotime($date);
        }

        if( is_object( $date ) )
        {
            return new Carbon( $date->date, new \DateTimeZone( $date->timezone ) );
        }

        if( is_numeric( $date ) )
        {
            return $date;
        }

        return null;

    }

    public function datetime($field) {

        $timestamp = $this->date( $field );

        return isset($timestamp) ? date("Y-m-d H:i:s", $timestamp) : null;

    }

    /**
     * Exposes the `datum` property when serialized into JSON.
     *
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return object
     */
    public function jsonSerialize()
    {

        return $this->all();

    }

    /**
     * Returns an object wrapped in a Datum.
     *
     * @link http://php.net/manual/en/function.spl-object-hash.php
     *
     * @return \App\Transformers\Datum;
     */
    private function getSubDatum($object)
    {

        $hash = spl_object_hash( $object );

        if( !isset( $this->subdatums[ $hash ] ) )
        {
            $this->subdatums[ $hash ] = new Datum( $object );
        }

        return $this->subdatums[ $hash ];

    }

    /**
     * A place to standardize values, e.g. return null instead of empty strings.
     *
     * @return mixed;
     */
    private function getCleanValue($value)
    {

        if( !isset( $value ) )
        {
            return null;
        }

        if( is_string( $value ) )
        {
            // Standardize on \n newlines
            $value = str_replace(["\r\n", "\r"], "\n", $value);

            // If it's a string, trim before returning
            $value = trim( $value );

            // If it's an empty string, return null
            return empty( $value ) ? null : $value;
        }

        if( is_object( $value ) )
        {
            // If it's an object, return new datum
            return $this->getSubDatum( $value );
        }

        return $value;

    }

}
