<?php namespace Phphub\Markdown;

use League\HTMLToMarkdown\HtmlConverter;
use Parsedown;
use Purifier;
use ParsedownExtra;
use Phphub\Markdown\ParsedownExtreme;

class Markdown
{
    protected $htmlParser;
    protected $markdownParser;

    public function __construct()
    {
        $this->htmlParser = new HtmlConverter(['header_style' => 'atx']);
        $this->markdownParser = new ParsedownExtreme();
    }

    public function convertHtmlToMarkdown($html)
    {
        return $this->htmlParser->convert($html);
    }

    public function convertMarkdownToHtml($markdown)
    {
        $convertedHmtl = $this->markdownParser->katex(true)->text($markdown);
        $convertedHmtl = Purifier::clean($convertedHmtl, 'user_topic_body');
        $convertedHmtl = str_replace("<pre><code>", '<pre><code class=" language-php">', $convertedHmtl);

        return $convertedHmtl;
    }
}
