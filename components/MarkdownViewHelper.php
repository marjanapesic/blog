<?php

class MarkdownViewHelper
{

    static $instance = null;

    private $blogMarkdown = null;

    private function __construct()
    {
        $this->blogMarkdown = new BlogMarkdown();
    }

    public static function getInstance()
    {
        if (! isset(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function getPlainText($message)
    {
        $html = $this->blogMarkdown->parse($message);
        return strip_tags($html);
    }

    public function getImageSource($message)
    {
        $message = $this->blogMarkdown->parse($message);
        $images = array();
        preg_match_all('/<img[^>]+>/i', $message, $images);
        $sources = array();
        
        if (isset($images[0][0]))
            preg_match('/src="([^"]+)"/', $images[0][0], $sources);
        return (isset($sources[1])) ? $sources[1] : null;
    }

    public function parseMarkdown($md)
    {
        $html = $this->blogMarkdown->parse($md);      
        $purifier = new CHtmlPurifier();
        return $purifier->purify($html);
    }
}
?>