<?php

/**
 * TODO: Everything below this is unused. However, these methods could be useful in testing.
 */

/**
 * Get a list of all the models used in the application
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

        $sourcepath = $dir .DIRECTORY_SEPARATOR .$file;
        if (is_dir($sourcepath))
        {

            $sourcefiles = scandir($sourcepath);

            foreach($sourcefiles as $sourcefile)
            {

                if (!is_dir($sourcepath .DIRECTORY_SEPARATOR .$sourcefile))
                {

                    $models[] = $namespace .$file .'\\' .preg_replace('/\.php$/', '', $sourcefile);

                }

            }

        }

    }

    return $models;

}


/**
 * Get a list of all the models that use the the given trait.
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
