<?php

namespace App\Services\Solr;

use Laravel\Scout\Builder;
use AlgoliaSearch\Client as Algolia;
use Illuminate\Database\Eloquent\Collection;
use Laravel\Scout\Engines\Engine;
use Solarium\Client;

class SolrScoutEngine extends Engine
{

    protected $solrClient;

    public function __construct(Client $solrClient)
    {

        $this->solrClient = $solrClient;

    }
    
    public function update($models)
    {

        $endpoint = $models->first()->searchableAs();
        $update = $this->solrClient->createUpdate();

        $update->addDocuments(
            $models->map(function ($model) use ($update) {
                $array = $model->toSearchableArray();

                if (empty($array)) {
                    return;
                }
                
                return $update->createDocument($array);
            })->filter()->values()->all()
        );

        $update->addCommit();

        $result = $this->solrClient->update($update, $endpoint);

    }

    public function delete($models)
    {

        $endpoint = $models->first()->searchableAs();
        $update = $this->solrClient->createUpdate();

        dd($models->pluck('id')->all());

        $update->addDeleteByIds($models->pluck('id')->all());
        $update->addCommit();

        $result = $this->solrClient->update($update, $endpoint);

    }

    public function search(Builder $builder)
    {

        $endpoint = $builder->model->searchableAs();

        $select = $this->solrClient->createSelect();

        $searchQuery = $builder->query;
        $whereQuery = $this->buildWheresQuery($builder);

        $query = trim("$searchQuery $whereQuery");

        if ($query) {
            $select->setQuery($query);
        }

        if ($builder->limit) {
            $select->setRows($builder->limit);
        }

        foreach ($builder->orders as $order) {
            $select->addsort($order['column'], $order['direction']);
        }

        $result = $this->solrClient->select($select, $endpoint);
        $documents = $result->getDocuments();

        return $documents;

    }

    public function paginate(Builder $builder, $perPage, $page)
    {

        throw new \Exception('Not implemented yet');

    }

    public function map($results, $model)
    {

        if (count($results) === 0) {
            return Collection::make();
        }

        $keys = collect($results)
            ->pluck('text_id')->values()->all();

        return $model->whereIn(
            $model->getQualifiedKeyName(), $keys
        )->get();

    }

    public function mapIds($results)
    {

        // @todo don't hardcode the id, we need the builder
        // here to fetch the key name from the model.
        return collect($results)->pluck('text_id')->values();

    }
    
    public function getTotalCount($results)
    {
    }

    protected function buildWheresQuery(Builder $builder)
    {

        return collect($builder->wheres)
            ->map(function ($value, $key) {
                return "$key:$value";
            })->implode(' ');

    }

}