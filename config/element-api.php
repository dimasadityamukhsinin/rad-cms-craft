<?php

use craft\elements\Entry;
use craft\helpers\UrlHelper;
use craft\elements\MatrixBlock;

return [
    'endpoints' => [
        'projects.json' => function() {
            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'projects'],
                'transformer' => function(Entry $entry) {
                    $images = [];
                    foreach ($entry->image->all() as $image) {
                        $images[] = $image->url;
                    }
                    return [
                        'title' => $entry->title,
                        'description' => $entry->description,
                        'image' => $images,
                    ];
                },
            ];
        },
        'projects/<slug:{slug}>.json' => function($slug) {
            return [
                'elementType' => Entry::class,
                'criteria' => [
                    'section' => 'projects',
                    'slug' => $slug],
                'one' => true,
                'transformer' => function(Entry $entry) {
                    $images = [];
                    foreach ($entry->image->all() as $image) {
                        $images[] = $image->url;
                    }
                    return [
                        'title' => $entry->title,
                        'description' => $entry->description,
                        'image' => $images,
                    ];
                },
            ];
        },
        'about.json' => function() {
            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'about'],
                'paginate' => false,
                'transformer' => function(Entry $entry) {
                    return [
                        'title' => $entry->title,
                        'description' => $entry->description,
                    ];
                },
            ];
        },
        'contact.json' => function() {
            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'contact'],
                'paginate' => false,
                'transformer' => function(Entry $entry) {
                    $medsos = [];
                    foreach ($entry->mediaSocial->all() as $sosmed) {
                        $medsos[] = Array(
                            'name'  => $sosmed->medSosName,
                            'url'   => $sosmed->urlMedsos
                        );
                    }
                    return [
                        'title' => $entry->title,
                        'phoneNumber' => $entry->phoneNumber,
                        'email' => $entry->email,
                        'address' => $entry->address,
                        'MediaSocial' => $medsos,
                    ];
                },
            ];
        },
    ]
];