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

namespace Google\Service\Dialogflow;

class GoogleCloudDialogflowCxV3SafetySettings extends \Google\Collection
{
  protected $collection_key = 'bannedPhrases';
  protected $bannedPhrasesType = GoogleCloudDialogflowCxV3SafetySettingsPhrase::class;
  protected $bannedPhrasesDataType = 'array';
  /**
   * @var string
   */
  public $defaultBannedPhraseMatchStrategy;

  /**
   * @param GoogleCloudDialogflowCxV3SafetySettingsPhrase[]
   */
  public function setBannedPhrases($bannedPhrases)
  {
    $this->bannedPhrases = $bannedPhrases;
  }
  /**
   * @return GoogleCloudDialogflowCxV3SafetySettingsPhrase[]
   */
  public function getBannedPhrases()
  {
    return $this->bannedPhrases;
  }
  /**
   * @param string
   */
  public function setDefaultBannedPhraseMatchStrategy($defaultBannedPhraseMatchStrategy)
  {
    $this->defaultBannedPhraseMatchStrategy = $defaultBannedPhraseMatchStrategy;
  }
  /**
   * @return string
   */
  public function getDefaultBannedPhraseMatchStrategy()
  {
    return $this->defaultBannedPhraseMatchStrategy;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDialogflowCxV3SafetySettings::class, 'Google_Service_Dialogflow_GoogleCloudDialogflowCxV3SafetySettings');
