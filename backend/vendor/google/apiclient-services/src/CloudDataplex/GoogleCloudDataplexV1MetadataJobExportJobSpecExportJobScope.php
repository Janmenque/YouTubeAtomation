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

class GoogleCloudDataplexV1MetadataJobExportJobSpecExportJobScope extends \Google\Collection
{
  protected $collection_key = 'projects';
  /**
   * @var string[]
   */
  public $aspectTypes;
  /**
   * @var string[]
   */
  public $entryGroups;
  /**
   * @var string[]
   */
  public $entryTypes;
  /**
   * @var bool
   */
  public $organizationLevel;
  /**
   * @var string[]
   */
  public $projects;

  /**
   * @param string[]
   */
  public function setAspectTypes($aspectTypes)
  {
    $this->aspectTypes = $aspectTypes;
  }
  /**
   * @return string[]
   */
  public function getAspectTypes()
  {
    return $this->aspectTypes;
  }
  /**
   * @param string[]
   */
  public function setEntryGroups($entryGroups)
  {
    $this->entryGroups = $entryGroups;
  }
  /**
   * @return string[]
   */
  public function getEntryGroups()
  {
    return $this->entryGroups;
  }
  /**
   * @param string[]
   */
  public function setEntryTypes($entryTypes)
  {
    $this->entryTypes = $entryTypes;
  }
  /**
   * @return string[]
   */
  public function getEntryTypes()
  {
    return $this->entryTypes;
  }
  /**
   * @param bool
   */
  public function setOrganizationLevel($organizationLevel)
  {
    $this->organizationLevel = $organizationLevel;
  }
  /**
   * @return bool
   */
  public function getOrganizationLevel()
  {
    return $this->organizationLevel;
  }
  /**
   * @param string[]
   */
  public function setProjects($projects)
  {
    $this->projects = $projects;
  }
  /**
   * @return string[]
   */
  public function getProjects()
  {
    return $this->projects;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDataplexV1MetadataJobExportJobSpecExportJobScope::class, 'Google_Service_CloudDataplex_GoogleCloudDataplexV1MetadataJobExportJobSpecExportJobScope');
