<?php

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;

function generateSEO(array $options): void
{
    $defaultImage = asset('assets/frontend/image/logo/logo-id.png');

    $propertiType = $options['propertiType'] ?? null;
    $title        = $options['title'] ?? '';
    $description  = $options['description'] ?? '';
    $imageUrl     = $options['imageUrl'] ?? $defaultImage;
    $url          = $options['url'] ?? url()->current();
    $twitter      = $options['twitter'] ?? null;

    SEOTools::addImages($imageUrl);
    SEOTools::setTitle($title);
    SEOTools::setDescription($description);
    SEOTools::opengraph()->setUrl($url);
    SEOTools::setCanonical($url);
    SEOTools::opengraph()->addProperty('type', $propertiType);
    SEOTools::twitter()->setSite($twitter);
    SEOMeta::setRobots('index,follow');
}
