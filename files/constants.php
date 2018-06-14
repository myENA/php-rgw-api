<?php

define('RGW_TIME_FORMAT', 'D, d M Y H:i:s O');
define(
    'RGW_SUBRESOURCE_S3',
    [
        'acl',
        'lifecycle',
        'location',
        'logging',
        'notification',
        'partNumber',
        'policy',
        'requestPayment',
        'torrent',
        'uploadId',
        'uploads',
        'versionId',
        'versioning',
        'versions',
        'website',
    ]
);
define('RGW_DEFAULT_REQUEST_HEADERS', ['Content-Type' => 'application/json', 'Accept' => 'application/json']);
define('RGW_CAPABILITY_TYPES', ['users', 'buckets', 'metadata', 'usage', 'zone']);
define('RGW_CAPABILITY_VALUES', ['*', 'read', 'write', 'read,write', 'read, write']);