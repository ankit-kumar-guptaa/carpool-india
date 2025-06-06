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

namespace Google\Service\Aiplatform\Resource;

use Google\Service\Aiplatform\GoogleCloudAiplatformV1BatchPredictionJob;
use Google\Service\Aiplatform\GoogleCloudAiplatformV1ListBatchPredictionJobsResponse;

/**
 * The "batchPredictionJobs" collection of methods.
 * Typical usage is:
 *  <code>
 *   $aiplatformService = new Google\Service\Aiplatform(...);
 *   $batchPredictionJobs = $aiplatformService->batchPredictionJobs;
 *  </code>
 */
class BatchPredictionJobs extends \Google\Service\Resource
{
  /**
   * Creates a BatchPredictionJob. A BatchPredictionJob once created will right
   * away be attempted to start. (batchPredictionJobs.create)
   *
   * @param GoogleCloudAiplatformV1BatchPredictionJob $postBody
   * @param array $optParams Optional parameters.
   *
   * @opt_param string parent Required. The resource name of the Location to
   * create the BatchPredictionJob in. Format:
   * `projects/{project}/locations/{location}`
   * @return GoogleCloudAiplatformV1BatchPredictionJob
   * @throws \Google\Service\Exception
   */
  public function create(GoogleCloudAiplatformV1BatchPredictionJob $postBody, $optParams = [])
  {
    $params = ['postBody' => $postBody];
    $params = array_merge($params, $optParams);
    return $this->call('create', [$params], GoogleCloudAiplatformV1BatchPredictionJob::class);
  }
  /**
   * Gets a BatchPredictionJob (batchPredictionJobs.get)
   *
   * @param string $name Required. The name of the BatchPredictionJob resource.
   * Format: `projects/{project}/locations/{location}/batchPredictionJobs/{batch_p
   * rediction_job}`
   * @param array $optParams Optional parameters.
   * @return GoogleCloudAiplatformV1BatchPredictionJob
   * @throws \Google\Service\Exception
   */
  public function get($name, $optParams = [])
  {
    $params = ['name' => $name];
    $params = array_merge($params, $optParams);
    return $this->call('get', [$params], GoogleCloudAiplatformV1BatchPredictionJob::class);
  }
  /**
   * Lists BatchPredictionJobs in a Location.
   * (batchPredictionJobs.listBatchPredictionJobs)
   *
   * @param array $optParams Optional parameters.
   *
   * @opt_param string filter The standard list filter. Supported fields: *
   * `display_name` supports `=`, `!=` comparisons, and `:` wildcard. *
   * `model_display_name` supports `=`, `!=` comparisons. * `state` supports `=`,
   * `!=` comparisons. * `create_time` supports `=`, `!=`,`<`, `<=`,`>`, `>=`
   * comparisons. `create_time` must be in RFC 3339 format. * `labels` supports
   * general map functions that is: `labels.key=value` - key:value equality
   * `labels.key:* - key existence Some examples of using the filter are: *
   * `state="JOB_STATE_SUCCEEDED" AND display_name:"my_job_*"` *
   * `state!="JOB_STATE_FAILED" OR display_name="my_job"` * `NOT
   * display_name="my_job"` * `create_time>"2021-05-18T00:00:00Z"` *
   * `labels.keyA=valueA` * `labels.keyB:*`
   * @opt_param int pageSize The standard list page size.
   * @opt_param string pageToken The standard list page token. Typically obtained
   * via ListBatchPredictionJobsResponse.next_page_token of the previous
   * JobService.ListBatchPredictionJobs call.
   * @opt_param string parent Required. The resource name of the Location to list
   * the BatchPredictionJobs from. Format:
   * `projects/{project}/locations/{location}`
   * @opt_param string readMask Mask specifying which fields to read.
   * @return GoogleCloudAiplatformV1ListBatchPredictionJobsResponse
   * @throws \Google\Service\Exception
   */
  public function listBatchPredictionJobs($optParams = [])
  {
    $params = [];
    $params = array_merge($params, $optParams);
    return $this->call('list', [$params], GoogleCloudAiplatformV1ListBatchPredictionJobsResponse::class);
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(BatchPredictionJobs::class, 'Google_Service_Aiplatform_Resource_BatchPredictionJobs');
