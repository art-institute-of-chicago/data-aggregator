<?php

namespace App\Console\Commands\Docs;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

abstract class AbstractDocCommand extends BaseCommand
{

    private $models;

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
            'Archive' => 'Archive',
            'Library' => 'Library',
            'Web' => 'Website',
        ];
    }

    protected function getModelsForNamespace($desiredNamespace)
    {
        return $this->getModels()
            ->filter(function ($modelNamespace, $model) use ($desiredNamespace) {
                return $modelNamespace === $desiredNamespace;
            })
            ->keys();
    }

    private function getModels()
    {
        if (isset($this->models)) {
            return $this->models;
        }

        return $this->models = collect(config('resources.outbound.base'))
            ->filter(function ($value, $key) {
                return array_key_exists('endpoint', $value) && (!array_key_exists('is_restricted', $value) || $value['is_restricted'] === false);
            })
            ->pluck('model')
            ->unique()
            ->filter()
            ->values()
            ->map(function ($model) {
                $segments = explode('\\', $model);
                return [$model => $segments[count($segments) - 2]];
            })
            ->collapse();
    }

}
