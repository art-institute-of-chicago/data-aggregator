<?php

namespace App\Transformers\Outbound\Collections\Traits;

trait IsCC0
{

    public function getLicenseText()
    {
        return 'The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.';
    }

    public function getLicenseLinks()
    {
        return [
            'https://creativecommons.org/publicdomain/zero/1.0/',
            'https://www.artic.edu/terms',
        ];
    }

    public function getLicensePriority()
    {
        return 10;
    }
}
