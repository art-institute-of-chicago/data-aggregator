<?php

namespace App\Library;

class DimensionParser
{
    /**
     * Return a parsed array of dimensions values in millimeters
     *
     * @return array
     */
    public static function parse($dimensions)
    {
        $dims;
        $unit;

        if (preg_match('/[a-zA-Z():. ]*([0-9.]+) [x×] ([0-9.]+) [x×] ([0-9.]+) ([cmin]{2}).*/u', $dimensions, $matches)) {

            $dims = array_slice($matches, 1, 3);
            $unit = $matches[4];

        }
        elseif (preg_match('/[a-zA-Z():. ]*([0-9.]+) [x×] ([0-9.]+) ([cmin]{2}).*/u', $dimensions, $matches)) {

            $dims = array_slice($matches, 1, 2);
            $unit = $matches[3];

        }
        elseif (preg_match('/[a-zA-Z():. ]*([0-9.]+) ([cmin]{2}) [()\/0-9a-z.; ]+ ([0-9.]+) [cmin]{2}.*/u', $dimensions, $matches)) {

            $dims[] = $matches[1];
            $dims[] = $matches[3];
            $unit = $matches[2];

        }
        elseif (preg_match('/[a-zA-Z():. ]*([0-9.]+) ([cmin]{2}) [()\/0-9a-z.; ]+.*/u', $dimensions, $matches)) {

            $dims[] = $matches[1];
            $unit = $matches[2];

        }

        $dims = $dims ?? [0,0];
        $unit = $unit ?? 'mm';

        return self::dimensionsInMillimeters($dims, $unit);

    }

    private static function dimensionsInMillimeters($dims, $unit)
    {

        $ret = $dims;
        switch ($unit) {
        case 'mm':
            $ret = $dims;
            break;
        case 'cm':
            $ret = array_map(function($dim) { return $dim * 10; }, $dims);
            break;
        case 'in':
            $ret = array_map(function($dim) { return $dim * 25.4; }, $dims);
            break;
        }

        return array_pad(array_map('intval', $ret), 3, null);

    }
}
