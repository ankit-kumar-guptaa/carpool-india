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

namespace Google\Service\CloudDataplex;

class GoogleCloudDataplexV1ListGlossariesResponse extends \Google\Collection
{
  protected $collection_key = 'unreachableLocations';
  protected $glossariesType = GoogleCloudDataplexV1Glossary::class;
  protected $glossariesDataType = 'array';
  /**
   * @var string
   */
  public $nextPageToken;
  /**
   * @var string[]
   */
  public $unreachableLocations;

  /**
   * @param GoogleCloudDataplexV1Glossary[]
   */
  public function setGlossaries($glossaries)
  {
    $this->glossaries = $glossaries;
  }
  /**
   * @return GoogleCloudDataplexV1Glossary[]
   */
  public function getGlossaries()
  {
    return $this->glossaries;
  }
  /**
   * @param string
   */
  public function setNextPageToken($nextPageToken)
  {
    $this->nextPageToken = $nextPageToken;
  }
  /**
   * @return string
   */
  public function getNextPageToken()
  {
    return $this->nextPageToken;
  }
  /**
   * @param string[]
   */
  public function setUnreachableLocations($unreachableLocations)
  {
    $this->unreachableLocations = $unreachableLocations;
  }
  /**
   * @return string[]
   */
  public function getUnreachableLocations()
  {
    return $this->unreachableLocations;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDataplexV1ListGlossariesResponse::class, 'Google_Service_CloudDataplex_GoogleCloudDataplexV1ListGlossariesResponse');
