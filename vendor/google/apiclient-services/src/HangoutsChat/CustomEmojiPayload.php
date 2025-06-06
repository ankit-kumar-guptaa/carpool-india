<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\HangoutsChat;

class CustomEmojiPayload extends \Google\Model
{
  /**
   * @var string
   */
  public $fileContent;
  /**
   * @var string
   */
  public $filename;

  /**
   * @param string
   */
  public function setFileContent($fileContent)
  {
    $this->fileContent = $fileContent;
  }
  /**
   * @return string
   */
  public function getFileContent()
  {
    return $this->fileContent;
  }
  /**
   * @param string
   */
  public function setFilename($filename)
  {
    $this->filename = $filename;
  }
  /**
   * @return string
   */
  public function getFilename()
  {
    return $this->filename;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(CustomEmojiPayload::class, 'Google_Service_HangoutsChat_CustomEmojiPayload');
