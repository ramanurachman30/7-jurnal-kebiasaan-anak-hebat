<?php

if (!function_exists('generateBreadcrumbs')) {
    function generateBreadcrumbs(array $customLinks = []): array
    {
        $segments = request()->segments();
        $breadcrumbs = [];

        $locales = ['id', 'en'];
        $url = '';
        $segmentIndex = 0;

        foreach ($segments as $index => $segment) {
            if ($index === 0 && in_array($segment, $locales)) {
                continue;
            }

            $url .= '/' . $segment;

            $custom = $customLinks[$segmentIndex] ?? [];

            $label = $custom['label'] ?? ucwords(str_replace('-', ' ', $segment));
            $segmentUrl = $custom['url'] ?? ($segmentIndex < count($segments) - 2 ? $url : null);

            $breadcrumbs[] = [
                'label' => $label,
                'url' => $segmentUrl,
            ];

            $segmentIndex++;
        }

        array_unshift($breadcrumbs, [
            'label' => __('Home'),
            'url' => '/',
        ]);

        return $breadcrumbs;
    }
}
