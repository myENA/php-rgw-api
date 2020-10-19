<?php declare(strict_types=1);

namespace MyENA\RGW\Chain;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Chain\Usage\Info;
use MyENA\RGW\Links\HeaderLink;
use MyENA\RGW\Links\UriLink;

/**
 * Class UsageRootLink
 * @package MyENA\RGW\Chain
 */
class UsageRootLink extends AbstractLink implements UriLink, HeaderLink
{
    public const PATH = '/usage';

    /**
     * @return string
     */
    public function getUriPart(): string
    {
        return self::PATH;
    }

    /**
     * @return array
     */
    public function getRequestHeaders(): array
    {
        return RGW_DEFAULT_REQUEST_HEADERS;
    }

    /**
     * @param string|null $uid
     * @param \DateTime|string|null $start
     * @param \DateTime|string|null $end
     * @param bool $showEntries
     * @param bool $showSummary
     * @return \MyENA\RGW\Chain\Usage\Info
     */
    public function Info(
        ?string $uid = null,
        $start = null,
        $end = null,
        ?bool $showEntries = null,
        ?bool $showSummary = null
    ): Info {
        return Info::new($this, [
            Info::PARAM_UID          => $uid,
            Info::PARAM_START        => $start,
            Info::PARAM_END          => $end,
            Info::PARAM_SHOW_ENTRIES => $showEntries,
            Info::PARAM_SHOW_SUMMARY => $showSummary,
        ]);
    }
}