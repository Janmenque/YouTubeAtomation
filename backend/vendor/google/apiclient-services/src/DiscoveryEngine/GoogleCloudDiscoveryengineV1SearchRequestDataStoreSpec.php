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

namespace Google\Service\DiscoveryEngine;

class GoogleCloudDiscoveryengineV1SearchRequestDataStoreSpec extends \Google\Model
{
  protected $boostSpecType = GoogleCloudDiscoveryengineV1SearchRequestBoostSpec::class;
  protected $boostSpecDataType = '';
  /**
   * @var string
   */
  public $customSearchOperators;
  /**
   * @var string
   */
  public $dataStore;
  /**
   * @var string
   */
  public $filter;

  /**
   * @param GoogleCloudDiscoveryengineV1SearchRequestBoostSpec
   */
  public function setBoostSpec(GoogleCloudDiscoveryengineV1SearchRequestBoostSpec $boostSpec)
  {
    $this->boostSpec = $boostSpec;
  }
  /**
   * @return GoogleCloudDiscoveryengineV1SearchRequestBoostSpec
   */
  public function getBoostSpec()
  {
    return $this->boostSpec;
  }
  /**
   * @param string
   */
  public function setCustomSearchOperators($customSearchOperators)
  {
    $this->customSearchOperators = $customSearchOperators;
  }
  /**
   * @return string
   */
  public function getCustomSearchOperators()
  {
    return $this->customSearchOperators;
  }
  /**
   * @param string
   */
  public function setDataStore($dataStore)
  {
    $this->dataStore = $dataStore;
  }
  /**
   * @return string
   */
  public function getDataStore()
  {
    return $this->dataStore;
  }
  /**
   * @param string
   */
  public function setFilter($filter)
  {
    $this->filter = $filter;
  }
  /**
   * @return string
   */
  public function getFilter()
  {
    return $this->filter;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDiscoveryengineV1SearchRequestDataStoreSpec::class, 'Google_Service_DiscoveryEngine_GoogleCloudDiscoveryengineV1SearchRequestDataStoreSpec');
