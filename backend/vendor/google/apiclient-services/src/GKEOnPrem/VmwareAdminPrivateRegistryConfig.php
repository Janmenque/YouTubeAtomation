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

namespace Google\Service\GKEOnPrem;

class VmwareAdminPrivateRegistryConfig extends \Google\Model
{
  /**
   * @var string
   */
  public $address;
  /**
   * @var string
   */
  public $caCert;

  /**
   * @param string
   */
  public function setAddress($address)
  {
    $this->address = $address;
  }
  /**
   * @return string
   */
  public function getAddress()
  {
    return $this->address;
  }
  /**
   * @param string
   */
  public function setCaCert($caCert)
  {
    $this->caCert = $caCert;
  }
  /**
   * @return string
   */
  public function getCaCert()
  {
    return $this->caCert;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(VmwareAdminPrivateRegistryConfig::class, 'Google_Service_GKEOnPrem_VmwareAdminPrivateRegistryConfig');
