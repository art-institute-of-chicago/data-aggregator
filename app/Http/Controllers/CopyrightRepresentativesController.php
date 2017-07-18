<?php

namespace App\Http\Controllers;

class CopyrightRepresentativesController extends AgentsController
{

    protected function agentTypeFilter()
    {

        return 'Copyright Representative';

    }

}
