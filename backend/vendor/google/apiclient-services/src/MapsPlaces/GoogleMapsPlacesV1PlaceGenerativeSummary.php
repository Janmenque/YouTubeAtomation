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

namespace Google\Service\MapsPlaces;

class GoogleMapsPlacesV1PlaceGenerativeSummary extends \Google\Model
{
  protected $disclosureTextType = GoogleTypeLocalizedText::class;
  protected $disclosureTextDataType = '';
  protected $overviewType = GoogleTypeLocalizedText::class;
  protected $overviewDataType = '';
  /**
   * @var string
   */
  public $overviewFlagContentUri;

  /**
   * @param GoogleTypeLocalizedText
   */
  public function setDisclosureText(GoogleTypeLocalizedText $disclosureText)
  {
    $this->disclosureText = $disclosureText;
  }
  /**
   * @return GoogleTypeLocalizedText
   */
  public function getDisclosureText()
  {
    return $this->disclosureText;
  }
  /**
   * @param GoogleTypeLocalizedText
   */
  public function setOverview(GoogleTypeLocalizedText $overview)
  {
    $this->overview = $overview;
  }
  /**
   * @return GoogleTypeLocalizedText
   */
  public function getOverview()
  {
    return $this->overview;
  }
  /**
   * @param string
   */
  public function setOverviewFlagContentUri($overviewFlagContentUri)
  {
    $this->overviewFlagContentUri = $overviewFlagContentUri;
  }
  /**
   * @return string
   */
  public function getOverviewFlagContentUri()
  {
    return $this->overviewFlagContentUri;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleMapsPlacesV1PlaceGenerativeSummary::class, 'Google_Service_MapsPlaces_GoogleMapsPlacesV1PlaceGenerativeSummary');
