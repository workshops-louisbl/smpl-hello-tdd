<?php

namespace Smpl\HelloTdd;

class FileLoader
{
  public function getContent($path)
  {
    if (file_exists($path)) {
      return file_get_contents($path);
    }

    throw new \Exception("file does not exists");
  }
}
