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

namespace Google\Service\BigtableAdmin;

class CreateLogicalViewMetadata extends \Google\Model
{
  /**
   * @var string
   */
  public $endTime;
  protected $originalRequestType = CreateLogicalViewRequest::class;
  protected $originalRequestDataType = '';
  /**
   * @var string
   */
  public $startTime;

  /**
   * @param string
   */
  public function setEndTime($endTime)
  {
    $this->endTime = $endTime;
  }
  /**
   * @return string
   */
  public function getEndTime()
  {
    return $this->endTime;
  }
  /**
   * @param CreateLogicalViewRequest
   */
  public function setOriginalRequest(CreateLogicalViewRequest $originalRequest)
  {
    $this->originalRequest = $originalRequest;
  }
  /**
   * @return CreateLogicalViewRequest
   */
  public function getOriginalRequest()
  {
    return $this->originalRequest;
  }
  /**
   * @param string
   */
  public function setStartTime($startTime)
  {
    $this->startTime = $startTime;
  }
  /**
   * @return string
   */
  public function getStartTime()
  {
    return $this->startTime;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(CreateLogicalViewMetadata::class, 'Google_Service_BigtableAdmin_CreateLogicalViewMetadata');
