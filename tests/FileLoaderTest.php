<?php

namespace Smpl\HelloTdd;

use PHPUnit\Framework\TestCase;

class FileLoaderTest extends TestCase
{
  public function testFileLoaderCanBeCreated()
  {
    $instance = new FileLoader();
    $this->assertInstanceOf(FileLoader::class, $instance);
  }

  public function testFileLoaderCanLoadFileContent()
  {
    # arrange
    $fileLoader = new FileLoader();

    # act
    $content = $fileLoader->getContent(__DIR__."/simple-content.md");

    # assert
    $this->assertEquals("Hello World!\n", $content);
  }

  public function testGetContentWithNoFileThrowsException()
  {
    $fileLoader = new FileLoader();
    $this->expectExceptionMessage("file does not exist");

    $fileLoader->getContent("does_not_exists");
  }
}
