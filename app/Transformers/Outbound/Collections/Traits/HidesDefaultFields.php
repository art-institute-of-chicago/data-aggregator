<?php

namespace App\Transformers\Outbound\Collections\Traits;

trait HidesDefaultFields
{

    protected function getIds()
    {
        return [];
    }

    protected function getTitles()
    {
        return [];
    }

    protected function getDates()
    {
        return [];
    }

}
