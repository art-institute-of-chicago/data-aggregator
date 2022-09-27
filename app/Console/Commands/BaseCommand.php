<?php

namespace App\Console\Commands;

use Aic\Hub\Foundation\AbstractCommand;

abstract class BaseCommand extends AbstractCommand
{

    /**
     * Keys are namespaces under `\App\Models`. Values are human-readable headings for the docs.
     * Here, order determines order of sections in the docs. Resources under these sections will
     * be ordered according to their definitions in `config/resources.php`.
     *
     * @TODO: Consider moving this to `resources.sources`?
     *
     * @return array
     */
    protected function getCategories()
    {
        return [
            'Collections' => 'Collections',
            'Shop' => 'Shop',
            //'Membership' => 'Membership',
            'Mobile' => 'Mobile',
            'Dsc' => 'Digital Scholarly Catalogs',
            'StaticArchive' => 'Static Archive',
            'Web' => 'Website',
        ];
    }

    protected function getModelsForNamespace($desiredNamespace)
    {
        return $this->getModels()
            ->filter(function ($modelNamespace, $model) use ($desiredNamespace) {
                return $modelNamespace === $desiredNamespace;
            })
            ->filter(function ($modelNamespace, $model) {
                // Filter out classes that extend CategoryTerm
                return get_parent_class($model) !== 'App\Models\Collections\CategoryTerm';
            })
            ->keys();
    }

    protected function getModels()
    {
        if (isset($this->models)) {
            return $this->models;
        }

        return $this->models = collect(config('resources.outbound.base'))
            ->filter(function ($value, $key) {
                return array_key_exists('endpoint', $value) &&
                    (!array_key_exists('is_restricted', $value) || $value['is_restricted'] === false) &&
                    (!array_key_exists('no_dump', $value) || $value['no_dump'] === false);
            })
            ->pluck('model')
            ->unique()
            ->filter()
            ->filter(function ($model) {
                // Filter out classes that extend CategoryTerm
                return get_parent_class($model) !== 'App\Models\Collections\CategoryTerm';
            })
            ->values()
            ->map(function ($model) {
                $segments = explode('\\', $model);
                return [$model => $segments[count($segments) - 2]];
            })
            ->collapse();
    }
}
