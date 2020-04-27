<?php

namespace Smpl\HelloTdd;

use PHPUnit\Framework\TestCase;

class MarkdownProcessorTest extends TestCase
{
  public function testMarkdownProcessorCanBeCreated()
  {
    $stubFileLoader = $this->createMock(FileLoader::class);
    $stubMdParser = $this->createMock(MarkdownParser::class);

    $instance = new MarkdownProcessor($stubFileLoader, $stubMdParser);

    $this->assertInstanceOf(MarkdownProcessor::class, $instance);
  }

  public function testMDProcessorWithPathReturnsHtml()
  {
    $filePath = "file path";
    $expected = "HTML result";

    $stubFileLoader = $this->createMock(FileLoader::class);
    $stubFileLoader->method('getContent')->willReturn("MD source");

    $stubMdParser = $this->createMock(MarkdownParser::class);
    $stubMdParser->method('parse')->willReturn($expected);

    $mdProcessor = new MarkdownProcessor($stubFileLoader, $stubMdParser);

    $result = $mdProcessor->process($filePath);

    $this->assertEquals($expected, $result);
  }

  public function testProcessWithoutFileReturnsFalse()
  {
    $filePath = "file_not_found";

    $stubFileLoader = $this->createMock(FileLoader::class);
    $stubFileLoader->method('getContent')
      ->will($this->throwException(new \Exception("file not found")));

    $stubMdParser = $this->createMock(MarkdownParser::class);
    $stubMdParser->method('parse')
      ->will($this->throwException(new \Exception("parse should not be called")));

    $mdProcessor = new MarkdownProcessor($stubFileLoader, $stubMdParser);

    $result = $mdProcessor->process($filePath);

    $this->assertFalse($result);
  }
}
