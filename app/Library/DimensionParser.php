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
        $result = self::processDimensionRules($dimensions);

        return self::dimensionsInMillimeters([$result['h'], $result['w'], $result['d']], $result['u']);
    }

    private static function processDimensionRules($dimensions)
    {
        foreach (self::getDimensionRules() as $pattern => $callback) {
            if (preg_match($pattern, $dimensions, $matches)) {
                return $callback($matches);
            }
        }
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

    /**
     * Defined dynamically to avoid "Constant expression contains invalid operations" fatal error.
     */
    private static function getDimensionRules()
    {
        return [
            '/[a-zA-Z():. ]*([0-9.]+) [x×] ([0-9.]+) [x×] ([0-9.]+) ([cmin]{2}).*/u' => function ($match) {
                return [
                    'h' => $match[1],
                    'w' => $match[2],
                    'd' => $match[3],
                    'u' => $match[4],
                ];
            },
            '/[a-zA-Z():. ]*([0-9.]+) [x×] ([0-9.]+) ([cmin]{2}).*/u' => function ($match) {
                return [
                    'h' => $match[1],
                    'w' => $match[2],
                    'd' => null,
                    'u' => $match[3],
                ];
            },
            '/[a-zA-Z():. ]*([0-9.]+) ([cmin]{2}) [()\/0-9a-z.; ]+ ([0-9.]+) [cmin]{2}.*/u' => function ($match) {
                return [
                    'h' => $match[1],
                    'w' => $match[3],
                    'd' => null,
                    'u' => $match[2],
                ];
            },
            '/[a-zA-Z():. ]*([0-9.]+) ([cmin]{2}) [()\/0-9a-z.; ]+.*/u' => function ($match) {
                return [
                    'h' => $match[1],
                    'w' => null,
                    'd' => null,
                    'u' => $match[2],
                ];
            },
        ];
    }

}
