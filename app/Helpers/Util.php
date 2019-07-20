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
function cantorTuple( ...$list )
{
    if (count($list) == 0) {
        return null;
    }

    if (count($list) == 1) {
        return $list[0];
    }

    $lastElement = array_pop($list);

    return (0.5 * (cantorTuple(...$list) + $lastElement) * (cantorTuple(...$list) + $lastElement + 1) + $lastElement);
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
 * @param array
 * @return string
 */
function summation(array $array)
{
    $last = array_pop($array);

    if (empty($array))
    {
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
 * @param Array $list
 * @param int $p
 *
 * @return multitype:multitype:
 */
function partition(Array $list, $p) {
    $listlen = count($list);
    $partlen = floor($listlen / $p);
    $partrem = $listlen % $p;
    $partition = [];
    $mark = 0;

    for($px = 0; $px < $p; $px ++) {
        $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
        $partition[$px] = array_slice($list, $mark, $incr);
        $mark += $incr;
    }
    return $partition;
}


function getLakeUri($lake_id)
{
    return env('LAKE_URL', 'https://localhost')
        . '/' . substr($lake_id, 0, 2)
        . '/' . substr($lake_id, 2, 2)
        . '/' . substr($lake_id, 4, 2)
        . '/' . substr($lake_id, 6, 2)
        . '/' . $lake_id;
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

    foreach($files as $file)
    {

        //skip current and parent folder entries
        if ($file == '.' || $file == '..') continue;

        $sourcepath = $dir . DIRECTORY_SEPARATOR . $file;

        if (is_dir($sourcepath))
        {

            $sourcefiles = scandir($sourcepath);

            foreach($sourcefiles as $sourcefile)
            {

                if (!is_dir($sourcepath . DIRECTORY_SEPARATOR . $sourcefile))
                {

                    $models[] = $namespace . $file . '\\' . preg_replace('/\.php$/', '', $sourcefile);

                }

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

    foreach ($modelClasses as $model)
    {

        if ($model::instance()->has($trait))
        {

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
 * @param string Optional model class. Otherwise it will use `get_called_class()`.
 * @param boolean Autoload flag to pass to `class_uses()` calls.
 * @return array
 */
function class_uses_deep($modelClass, $autoload = true)
{

    $traits = class_uses($modelClass, $autoload);

    // Get traits of all parent classes
    while ($modelClass = get_parent_class($modelClass))
    {

        $traits = array_merge(class_uses($modelClass, $autoload), $traits);

    }

    // Get traits of all parent traits
    $traitsToSearch = $traits;

    while (!empty($traitsToSearch))
    {

        $newTraits = class_uses(array_pop($traitsToSearch), $autoload);
        $traits = array_merge($newTraits, $traits);
        $traitsToSearch = array_merge($newTraits, $traitsToSearch);

    }

    foreach ($traits as $trait => $same)
    {

        $traits = array_merge(class_uses($trait, $autoload), $traits);

    }

    return array_unique($traits);

}
