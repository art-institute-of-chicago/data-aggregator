<?php

namespace App\Transformers\Outbound\Collections\Traits;

trait IsCCBy
{
    public function getLicenseText()
    {
        return 'The data in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu.';
    }

    public function getLicenseLinks()
    {
        return [
            'https://creativecommons.org/licenses/by/4.0/',
            'https://www.artic.edu/terms',
        ];
    }

    public function getLicensePriority()
    {
        return 50;
    }
}
