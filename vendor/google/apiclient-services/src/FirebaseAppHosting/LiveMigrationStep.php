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

namespace Google\Service\FirebaseAppHosting;

class LiveMigrationStep extends \Google\Collection
{
  protected $collection_key = 'relevantDomainStates';
  protected $dnsUpdatesType = DnsUpdates::class;
  protected $dnsUpdatesDataType = 'array';
  protected $issuesType = Status::class;
  protected $issuesDataType = 'array';
  /**
   * @var string[]
   */
  public $relevantDomainStates;
  /**
   * @var string
   */
  public $stepState;

  /**
   * @param DnsUpdates[]
   */
  public function setDnsUpdates($dnsUpdates)
  {
    $this->dnsUpdates = $dnsUpdates;
  }
  /**
   * @return DnsUpdates[]
   */
  public function getDnsUpdates()
  {
    return $this->dnsUpdates;
  }
  /**
   * @param Status[]
   */
  public function setIssues($issues)
  {
    $this->issues = $issues;
  }
  /**
   * @return Status[]
   */
  public function getIssues()
  {
    return $this->issues;
  }
  /**
   * @param string[]
   */
  public function setRelevantDomainStates($relevantDomainStates)
  {
    $this->relevantDomainStates = $relevantDomainStates;
  }
  /**
   * @return string[]
   */
  public function getRelevantDomainStates()
  {
    return $this->relevantDomainStates;
  }
  /**
   * @param string
   */
  public function setStepState($stepState)
  {
    $this->stepState = $stepState;
  }
  /**
   * @return string
   */
  public function getStepState()
  {
    return $this->stepState;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(LiveMigrationStep::class, 'Google_Service_FirebaseAppHosting_LiveMigrationStep');
