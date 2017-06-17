<?php

namespace App\Http\Controllers;

class ArtistsController extends AgentsController
{

    protected function agentTypeFilter()
    {

        return 'Artist';
        
    }

}
