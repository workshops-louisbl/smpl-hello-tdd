<?php

namespace Smpl\HelloTdd;

class MarkdownProcessor
{
  private $fileLoader;
  private $mdParser;

  public function __construct($fileLoader, $mdParser)
  {
    $this->fileLoader = $fileLoader;
    $this->mdParser = $mdParser;
  }

  public function process($path)
  {
    try {
      $source = $this->fileLoader->getContent($path);
    } catch (\Exception $exception) {
      return false;
    }

    $result = $this->mdParser->parse($source);

    return $result;
  }
}
