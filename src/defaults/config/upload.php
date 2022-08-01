<?php

/**
 * Usage:
 *
 * > for path
 * $path = Upload::getCustomPath('example');
 * $path = Upload::getCustomPath('example', 1);
 *
 * > for name
 * $name = Upload::getCustomName('example');
 * $name = Upload::getBaseName($exampleUrl);
 */

return [
    'disk' => [
        'default' => 'public',
        'image' => 'public',
        'csv' => 'public',
        'tmp' => [
            'default' => 'public',
            'image' => 'public',
            'csv' => 'public',
        ],
    ],
    'path' => [
        'default' => 'default',
        'image' => 'images',
        'csv' => 'csv',
        'tmp' => [
            'default' => ['tmp', 'default'],
            'image' => ['tmp', 'images'],
            'csv' => ['tmp', 'csv'],
        ],
    ],
    'extension' => [
        'image' => 'png',
        'csv' => 'csv',
    ],
    'custom' => [
        /**
         * NOTE: common folder structure:
         *
         * user/[id]/thumbnail
         * user/[id]/csv
         */
        'path' => [
            // 'example' => 'Example/Folder/Path',
            // 'example1' => ['Example/Folder', 'Path'],
        ],
        'name' => [
            // 'example' => 'ExampleName.csv'
        ],
    ],
];
