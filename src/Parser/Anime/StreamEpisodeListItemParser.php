<?php

namespace Jikan\Parser\Anime;

use Jikan\Helper\Parser;
use Jikan\Model\StreamEpisodeListItem;
use Jikan\Parser\ParserInterface;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class StreamEpisodeListItemParser
 *
 * @package Jikan\Parser\Episode
 */
class StreamEpisodeListItemParser implements ParserInterface
{
    /**
     * @var Crawler
     */
    private $crawler;

    /**
     * EpisodeListItemParser constructor.
     *
     * @param Crawler $crawler
     */
    public function __construct(Crawler $crawler)
    {
        $this->crawler = $crawler;
    }

    /**
     * @return StreamEpisodeListItem
     */
    public function getModel(): StreamEpisodeListItem
    {
        return StreamEpisodeListItem::fromParser($this);
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->crawler->filterXPath('//a/div/span/span[@class="episode-title"]')->text();
    }

    /**
     * @return string
     */
    public function getEpisode(): string
    {
        return Parser::removeChildNodes($this->crawler->filterXPath('//a/div/span[@class="title"]'))->text();
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->crawler->filterXPath('//a')->attr('href');
    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->crawler->filterXPath('//a/img')->attr('data-src');
    }
}
