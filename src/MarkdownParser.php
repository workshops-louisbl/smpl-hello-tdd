<?php

namespace Smpl\HelloTdd;

class MarkdownParser
{

  public function parseBold($content)
  {
    $boldPattern = '/\*\*(.*)\*\*/';
    $boldReplace = '<strong>$1</strong>';
    return preg_replace($boldPattern, $boldReplace, $content);
  }

  public function parseLink($content)
  {
    $linkPattern = '/\[(.*)\]\((.*)\)/';
    $linkReplace = '<a href="$2">$1</a>';
    return preg_replace($linkPattern, $linkReplace, $content);
  }

  public function parseImage($content)
  {
    $imagePattern = '/!\[(.*)\]\((.*)\)/';
    $imageReplace = '<img src="$2" alt="$1" />';
    return preg_replace($imagePattern, $imageReplace, $content);
  }

  public function parse($content)
  {
    $content = $this->parseBold($content);
    $content = $this->parseImage($content);
    return $this->parseLink($content);
  }
}
