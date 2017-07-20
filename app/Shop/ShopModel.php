<?php

namespace App\Shop;

use Illuminate\Database\Eloquent\Model;

use App\Scopes\SortByLastUpdatedScope;

use Laravel\Scout\Searchable;

class ShopModel extends Model
{

    use Searchable;

    public $incrementing = false;
    protected $primaryKey = 'shop_id';
    protected $dates = ['source_created_at', 'source_modified_at'];

    protected $apiCtrl;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function __construct(array $attributes = array()) {

        parent::__construct($attributes);

        $this->apiCtrl = $this->apiCtrl ?: str_plural( class_basename(static::class) ) . 'Controller';

    }

    protected static function boot()
    {

        parent::boot();
        static::addGlobalScope(new SortByLastUpdatedScope());

    }

    protected function searchableLink()
    {

        return action($this->apiCtrl . '@show', ['id' => $this->getKey()]);

    }

    protected function searchableModel()
    {

        return kebab_case(class_basename(static::class));

    }

    protected function searchableSource()
    {

        return 'shop';

    }

    protected function searchableId()
    {

        return $this->searchableSource() .'/' .$this->searchableModel() .'/' .$this->shop_id;

    }

}
