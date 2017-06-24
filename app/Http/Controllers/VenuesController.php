<?php

namespace App\Http\Controllers;

class VenuesController extends AgentsController
{

    protected function agentTypeFilter()
    {

        return 'Corporate Body';
        
    }

}
