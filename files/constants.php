<?php declare(strict_types=1);

const RGW_TIME_FORMAT = 'D, d M Y H:i:s O';

const RGW_SUBRESOURCE_S3 = [
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
];

const RGW_DEFAULT_REQUEST_HEADERS = ['Content-Type' => 'application/json', 'Accept' => 'application/json'];
const RGW_CAPABILITY_TYPES = ['users', 'buckets', 'metadata', 'usage', 'zone'];
const RGW_CAPABILITY_PERMS = ['*', 'read', 'write', 'read,write', 'read, write'];

// Attempt to load config from ENV if not otherwise defined
const ENV_RGW_API_HTTP_ADDR = 'RGW_API_HTTP_ADDR';
const ENV_RGW_API_NO_SSL = 'RGW_API_NO_SSL';
const ENV_RGW_API_ADMIN_PATH = 'RGW_API_ADMIN_PATH';
const ENV_RGW_API_KEY = 'RGW_API_KEY';
const ENV_RGW_API_SECRET = 'RGW_API_SECRET';
const ENV_RGW_LOG_SILENT = 'RGW_LOG_SILENT';