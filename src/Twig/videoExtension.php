<?php

namespace App\Twig;

use Twig\TwigFilter;
use Twig\Extension\AbstractExtension;

class videoExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [new TwigFilter('formatVideo', [$this, 'formatVideo'])];
    }

    public function formatVideo($url)
    {
        $url = preg_replace('#/watch\?v=#', '/embed/', $url);

        return $url;
    }
}