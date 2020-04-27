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

  public function testParseBoldReturnsStrong()
  {
    $mdParser = new MarkdownParser();
    $content = "Hello **World**!";

    $result = $mdParser->parseBold($content);

    $this->assertEquals("Hello <strong>World</strong>!", $result);
  }

  public function testParseLinkReturnsAnchor()
  {
    $mdParser = new MarkdownParser();
    $content = "[this is a link](https://www.example.com)";

    $result = $mdParser->parseLink($content);

    $this->assertEquals('<a href="https://www.example.com">this is a link</a>', $result);
  }

  public function testParseImageReturnsImg()
  {
    $mdParser = new MarkdownParser();
    $content = "![image description](path-to-image.png)";

    $result = $mdParser->parseImage($content);

    $this->assertEquals('<img src="path-to-image.png" alt="image description" />', $result);
  }

  public function testParseReturnsHtml()
  {
    $mdParser = new MarkdownParser();
    $content = "Hello **World**!".
      " [this is a link](https://www.example.com) ".
      "![image description](path-to-image.png)";

    $result = $mdParser->parse($content);

    $this->assertEquals("Hello <strong>World</strong>!".
    ' <a href="https://www.example.com">this is a link</a> '.
    '<img src="path-to-image.png" alt="image description" />', $result);

  }
}
