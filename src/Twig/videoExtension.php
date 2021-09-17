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
        if (preg_match('#youtube\.com#', $url)) {
            $url = preg_replace('#/watch\?v=#', '/embed/', $url);
        }
        
        if (preg_match('#dailymotion#', $url)) {
            $url = preg_replace('#video/#', 'embed/video/', $url);
        }

        return $url;
    }
}