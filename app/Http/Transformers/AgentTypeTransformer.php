<?php

namespace App\Http\Transformers;

use App\Collections\AgentType;
use League\Fractal\TransformerAbstract;

class AgentTypeTransformer extends ApiTransformer
{

    public $citiObject = true;

}