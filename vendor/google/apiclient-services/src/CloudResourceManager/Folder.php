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

namespace Google\Service\CloudResourceManager;

class Folder extends \Google\Collection
{
  protected $collection_key = 'configuredCapabilities';
  /**
   * @var string[]
   */
  public $configuredCapabilities;
  /**
   * @var string
   */
  public $createTime;
  /**
   * @var string
   */
  public $deleteTime;
  /**
   * @var string
   */
  public $displayName;
  /**
   * @var string
   */
  public $etag;
  /**
   * @var string
   */
  public $managementProject;
  /**
   * @var string
   */
  public $name;
  /**
   * @var string
   */
  public $parent;
  /**
   * @var string
   */
  public $state;
  /**
   * @var string[]
   */
  public $tags;
  /**
   * @var string
   */
  public $updateTime;

  /**
   * @param string[]
   */
  public function setConfiguredCapabilities($configuredCapabilities)
  {
    $this->configuredCapabilities = $configuredCapabilities;
  }
  /**
   * @return string[]
   */
  public function getConfiguredCapabilities()
  {
    return $this->configuredCapabilities;
  }
  /**
   * @param string
   */
  public function setCreateTime($createTime)
  {
    $this->createTime = $createTime;
  }
  /**
   * @return string
   */
  public function getCreateTime()
  {
    return $this->createTime;
  }
  /**
   * @param string
   */
  public function setDeleteTime($deleteTime)
  {
    $this->deleteTime = $deleteTime;
  }
  /**
   * @return string
   */
  public function getDeleteTime()
  {
    return $this->deleteTime;
  }
  /**
   * @param string
   */
  public function setDisplayName($displayName)
  {
    $this->displayName = $displayName;
  }
  /**
   * @return string
   */
  public function getDisplayName()
  {
    return $this->displayName;
  }
  /**
   * @param string
   */
  public function setEtag($etag)
  {
    $this->etag = $etag;
  }
  /**
   * @return string
   */
  public function getEtag()
  {
    return $this->etag;
  }
  /**
   * @param string
   */
  public function setManagementProject($managementProject)
  {
    $this->managementProject = $managementProject;
  }
  /**
   * @return string
   */
  public function getManagementProject()
  {
    return $this->managementProject;
  }
  /**
   * @param string
   */
  public function setName($name)
  {
    $this->name = $name;
  }
  /**
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }
  /**
   * @param string
   */
  public function setParent($parent)
  {
    $this->parent = $parent;
  }
  /**
   * @return string
   */
  public function getParent()
  {
    return $this->parent;
  }
  /**
   * @param string
   */
  public function setState($state)
  {
    $this->state = $state;
  }
  /**
   * @return string
   */
  public function getState()
  {
    return $this->state;
  }
  /**
   * @param string[]
   */
  public function setTags($tags)
  {
    $this->tags = $tags;
  }
  /**
   * @return string[]
   */
  public function getTags()
  {
    return $this->tags;
  }
  /**
   * @param string
   */
  public function setUpdateTime($updateTime)
  {
    $this->updateTime = $updateTime;
  }
  /**
   * @return string
   */
  public function getUpdateTime()
  {
    return $this->updateTime;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Folder::class, 'Google_Service_CloudResourceManager_Folder');
