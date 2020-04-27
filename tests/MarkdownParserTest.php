<?php

namespace Smpl\HelloTdd;

use PHPUnit\Framework\TestCase;

class MarkdownParserTest extends TestCase
{
  public function testMarkdownParserCanBeCreated()
  {
    $instance = new MarkdownParser();
    $this->assertInstanceOf(MarkdownParser::class, $instance);
  }



}
