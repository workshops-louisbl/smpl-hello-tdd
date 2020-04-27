<?php

namespace Smpl\HelloTdd;

use PHPUnit\Framework\TestCase;

class MarkdownProcessorTest extends TestCase
{
  public function testMarkdownProcessorCanBeCreated()
  {
    $mockFileLoader = $this->createMock(FileLoader::class);
    $mockMdParser = $this->createMock(MarkdownParser::class);

    $instance = new MarkdownProcessor($mockFileLoader, $mockMdParser);

    $this->assertInstanceOf(MarkdownProcessor::class, $instance);
  }

  public function testMDProcessorWithPathReturnsHtml()
  {
    $filePath = "file path";
    $expected = "HTML result";

    $mockFileLoader = $this->createMock(FileLoader::class);
    $mockFileLoader->method('getContent')->willReturn("MD source");

    $mockMdParser = $this->createMock(MarkdownParser::class);
    $mockMdParser->method('parse')->willReturn($expected);

    $mdProcessor = new MarkdownProcessor($mockFileLoader, $mockMdParser);

    $result = $mdProcessor->process($filePath);

    $this->assertEquals($expected, $result);
  }

  public function testProcessWithoutFileReturnsFalse()
  {
    $filePath = "file_not_found";

    $mockFileLoader = $this->createMock(FileLoader::class);
    $mockFileLoader->method('getContent')
      ->will($this->throwException(new \Exception("file not found")));

    $mockMdParser = $this->createMock(MarkdownParser::class);
    $mockMdParser->method('parse')
      ->will($this->throwException(new \Exception("parse should not be called")));

    $mdProcessor = new MarkdownProcessor($mockFileLoader, $mockMdParser);

    $result = $mdProcessor->process($filePath);

    $this->assertFalse($result);
  }
}
