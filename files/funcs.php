<?php namespace MyENA\RGW;

use MyENA\RGW\Error\ResponseError;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @param string $name
 * @param string $delimiter
 * @param bool   $lcfirst
 * @return string
 */
function sanitizeName(string $name, string $delimiter, bool $lcfirst = false): string {
    if (false !== strpos($name, $delimiter)) {
        $name = implode('', array_map('ucfirst', explode($delimiter, $name)));
    }
    return $lcfirst ? lcfirst($name) : ucfirst($name);
}

/**
 * @param string $name
 * @param string $delimiter
 * @return string
 */
function desanitizeName(string $name, string $delimiter): string {
    $len = strlen($name);
    $ds = '';
    for ($i = 0; $i < $len; $i++) {
        $chr = $name[$i];
        $ord = ord($chr);
        // TODO: maybe be less lazy?
        if (65 <= $ord && $ord <= 90) {
            $ds .= $delimiter.strtolower($chr);
        } else {
            $ds .= $chr;
        }
    }
    return $ds;
}

/**
 * @param mixed $value
 * @return string
 */
function encodeValue($value): string {
    switch (gettype($value)) {
        case 'boolean':
            return $value ? 'true' : 'false';

        default:
            return (string)$value;
    }
}

/**
 * @param mixed $value
 * @return string
 */
function stringifyValue($value): string {
    switch ($type = gettype($value)) {
        case 'string':
        case 'integer':
        case 'double':
            return (string)$value;

        case 'NULL':
            return 'null';

        case 'boolean':
            return $value ? 'true' : 'false';

        case 'array':
            return 'Array('.count($value).')';

        case 'object':
            return get_class($value);

        default:
            return $type;
    }
}

/**
 * TODO: slightly redundant.
 *
 * @param \Psr\Http\Message\RequestInterface $request
 * @return array
 */
function serviceAndRegion(RequestInterface $request): array {
    $region = 'us-east-1';
    $service = 's3';

    $parts = explode('.', $request->getUri()->getHost());
    $cnt = count($parts);
    if (4 === $cnt) {
        if ('s3' === $parts[1]) {
            $service = 's3';
        } else if (0 === strpos($parts[1], 's3-')) {
            $region = substr($parts[1], 3);
            $service = 's3';
        } else {
            $service = $parts[0];
            $region = $parts[1];
        }
    } else if (5 === $cnt) {
        $service = $parts[2];
        $region = $parts[1];
    } else {
        if (0 === strpos($parts[0], 's3-')) {
            $region = substr($parts[0], 3);
        } else {
            $service = $parts[0];
        }
    }

    if ('external-1' === $region) {
        $region = 'us-east-1';
    }

    return [$service, $region];
}

/**
 * @param \Psr\Http\Message\RequestInterface $request
 * @return bool
 */
function isS3VirtualHostedStyle(RequestInterface $request): bool {
    [$service, $_] = serviceAndRegion($request);
    return 's3' === $service && 3 === substr_count($service, '.');
}

/**
 * @param \Psr\Http\Message\ResponseInterface $response
 * @return array(
 * @type mixed|null Decoded JSON or null on error
 * @type \MyENA\RGW\Error|null Decoding error, if seen.
 * )
 */
function decodeBody(ResponseInterface $response, bool $asArray = false): array {
    $body = $response->getBody();
    if (0 === $body->getSize()) {
        $body->close();
        return [null, null];
    }
    $body->rewind();
    $contents = $body->getContents();
    $body->close();

    $decoded = json_decode($contents, $asArray);
    if (JSON_ERROR_NONE === json_last_error()) {
        return [$decoded, null];
    }

    return [null, new ResponseError(json_last_error(), json_last_error_msg(), $contents)];
}

/**
 * This function will attempt to handle multi-part json responses.  Each "part" will be returned as order-preserved
 * entry in the array
 *
 * @param \Psr\Http\Message\ResponseInterface $response
 * @param bool                                $asArray
 * @return array
 */
function decodeMultiBody(ResponseInterface $response, bool $asArray = false): array {
    static $startTokens = ['"', '[', '{'];
    $body = $response->getBody();
    if (0 === $body->getSize()) {
        $body->close();
        return [null, null];
    }
    $body->rewind();
    $contents = $body->getContents();
    $body->close();

    $parts = [];

    $len = strlen($contents);
    $i = 0;
    while ($i < $len) {
        $buff = '';
        $startCount = 0;
        $endCount = 0;
        if (in_array($contents[$i], $startTokens, true)) {
            switch ($contents[$i]) {
                case '[':
                    $startToken = '[';
                    $endToken = ']';
                    break;
                case '{':
                    $startToken = '{';
                    $endToken = '}';
                    break;

                default:
                    $startToken = $endToken = '"';
                    break;
            }
            for (; $i < $len; $i++) {
                $chr = $contents[$i];
                $buff .= $chr;

                if ($chr === $startToken) {
                    $startCount++;
                } else if ($chr === $endToken) {
                    $endCount++;
                }

                if ($startCount === $endCount) {
                    $parts[] = $buff;
                    $i++;
                    break;
                }
            }
        } else {
            while (!in_array($buff, $startTokens, true) && $i < $len) {
                $buff .= $contents[$i++];
            }
            $parts[] = $buff;
        }
    }

    if (0 === count($parts)) {
        return [[], null];
    }

    foreach ($parts as &$part) {
        $orig = $part;
        $part = json_decode($part, $asArray);
        if (JSON_ERROR_NONE !== json_last_error()) {
            return [[], new ResponseError(json_last_error(), json_last_error_msg(), $orig)];
        }
    }

    return [$parts, null];
}