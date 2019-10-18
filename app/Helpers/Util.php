<?php

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;

/**
 * https://tighten.co/blog/a-better-dd-for-your-tdd
 */
function ddd($variable)
{
    $cloner = new VarCloner();
    $cloner->setMaxItems(10);

    $dumper = 'cli' === PHP_SAPI ? new CliDumper() : new HtmlDumper();
    $dumper->dump($cloner->cloneVar($variable));

    die(1);
}

/**
 * Calculates the Cantor tuple function for variable length arguments.
 * Accepts an unlimited amount of ids, each as its own argument.
 *
 * @author code-kobold (Ron Metten) (www.code-kobold.de)
 * @link http://codetalk.code-kobold.de/cantor-tuple-function/
 */
function cantorTuple(...$list)
{
    if (count($list) === 0) {
        return null;
    }

    if (count($list) === 1) {
        return $list[0];
    }

    $lastElement = array_pop($list);

    return 0.5 * (cantorTuple(...$list) + $lastElement) * (cantorTuple(...$list) + $lastElement + 1) + $lastElement;
}

/**
 * Generate a unique ID based on a combination of two numbers.
 * @param  int   $x
 * @param  int   $y
 * @return int
 */
function cantorPair($x, $y)
{
    return (($x + $y) * ($x + $y + 1)) / 2 + $y;
}

/**
 * Get the two numbers that a cantor ID was based on
 * @param  int   $z
 * @return array
 */
function reverseCantorPair($z)
{
    $t = floor((-1 + sqrt(1 + 8 * $z)) / 2);
    $x = $t * ($t + 3) / 2 - $z;
    $y = $z - $t * ($t + 1) / 2;
    return [$x, $y];
}

/**
 * Helper method that converts `['item', 'hey', 'wow']` to `item, hey, and wow`.
 *
 * @return string
 */
function summation(array $array)
{
    $last = array_pop($array);

    if (empty($array)) {
        return $last;
    }

    return implode(', ', $array) . ', and ' . $last;
}

/**
 * TODO: Everything below this is unused. However, these methods could be useful in testing.
 */

/**
 * Splits an array into a given number of (approximately) equal-sized parts.
 *
 * @link http://www.php.net/manual/en/function.array-chunk.php#75022
 *
 * @param int $p
 *
 * @return array
 */
function partition(array $list, $p)
{
    $listlen = count($list);
    $partlen = floor($listlen / $p);
    $partrem = $listlen % $p;
    $partition = [];
    $mark = 0;

    for ($px = 0; $px < $p; $px++) {
        $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
        $partition[$px] = array_slice($list, $mark, $incr);
        $mark += $incr;
    }
    return $partition;
}

/**
 * Get a list of all the models used in the application
 *
 * @TODO: This might break b/c it counts traits as models.
 * @TODO: This might break b/c it counts abstract models.
 *
 * @return array
 */
function allModels()
{
    $models = [];
    $namespace = '\App\Models\\';

    $dir = app_path('Models');
    $files = scandir($dir);

    foreach ($files as $file) {
        //skip current and parent folder entries
        if ($file === '.' || $file === '..') {
            continue;
        }

        $sourcepath = $dir . DIRECTORY_SEPARATOR . $file;

        if (!is_dir($sourcepath)) {
            continue;
        }

        $sourcefiles = scandir($sourcepath);

        foreach ($sourcefiles as $sourcefile) {
            if (!is_dir($sourcepath . DIRECTORY_SEPARATOR . $sourcefile)) {
                $models[] = $namespace . $file . '\\' . preg_replace('/\.php$/', '', $sourcefile);
            }
        }
    }

    return $models;
}

/**
 * Get a list of all the models that use the the given trait.
 *
 * @TODO: Currently unused, delete?
 *
 * @return array
 */
function allModelsThatUse($trait)
{
    $modelClasses = allModels();

    $models = [];

    foreach ($modelClasses as $model) {
        if ($model::instance()->has($trait)) {
            $models[] = $model;
        }
    }

    return $models;
}

/**
 * Get a list of all the traits this class uses, include the class's parents and traits' parents
 *
 * @TODO: Use `class_uses_recursive` instead?
 *
 * @param string $modelClass  Optional model class. Otherwise it will use `get_called_class()`.
 * @param boolean $autoload  Autoload flag to pass to `class_uses()` calls.
 * @return array
 */
function class_uses_deep($modelClass, $autoload = true)
{
    $traits = class_uses($modelClass, $autoload);

    // Get traits of all parent classes
    while ($modelClass = get_parent_class($modelClass)) {
        $traits = array_merge(class_uses($modelClass, $autoload), $traits);
    }

    // Get traits of all parent traits
    $traitsToSearch = $traits;

    while (!empty($traitsToSearch)) {
        $newTraits = class_uses(array_pop($traitsToSearch), $autoload);
        $traits = array_merge($newTraits, $traits);
        $traitsToSearch = array_merge($newTraits, $traitsToSearch);
    }

    foreach ($traits as $trait => $same) {
        $traits = array_merge(class_uses($trait, $autoload), $traits);
    }

    return array_unique($traits);
}

/**
 * Check if a given ip is in a network
 *
 * @param  string $ip    IP to check in IPV4 format eg. 127.0.0.1
 * @param  string $range IP/CIDR netmask eg. 127.0.0.0/24, also 127.0.0.1 is accepted and /32 assumed
 * @return boolean true if the ip is in this range / false if not.
 * @see https://gist.github.com/tott/7684443
 */
function ipInRange($ip, $range) {
    if ( strpos( $range, '/' ) == false ) {
        $range .= '/32';
    }

    // $range is in IP/CIDR format eg 127.0.0.1/24
    list( $range, $netmask ) = explode( '/', $range, 2 );
    $range_decimal = ip2long( $range );
    $ip_decimal = ip2long( $ip );
    $wildcard_decimal = pow( 2, ( 32 - $netmask ) ) - 1;
    $netmask_decimal = ~ $wildcard_decimal;
    return ( ( $ip_decimal & $netmask_decimal ) == ( $range_decimal & $netmask_decimal ) );
}
