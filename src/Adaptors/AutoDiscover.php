<?php
/******************************************************************************
 * Copyright 2017 Okta, Inc.                                                  *
 *                                                                            *
 * Licensed under the Apache License, Version 2.0 (the "License");            *
 * you may not use this file except in compliance with the License.           *
 * You may obtain a copy of the License at                                    *
 *                                                                            *
 *      http://www.apache.org/licenses/LICENSE-2.0                            *
 *                                                                            *
 * Unless required by applicable law or agreed to in writing, software        *
 * distributed under the License is distributed on an "AS IS" BASIS,          *
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.   *
 * See the License for the specific language governing permissions and        *
 * limitations under the License.                                             *
 ******************************************************************************/

namespace Okta\JwtVerifier\Adaptors;

class AutoDiscover
{
    private $adaptors = [
        SpomkyLabsJose::class,
        FirebasePhpJwt::class
    ];

    public function __construct()
    {
        foreach($this->adaptors as $adaptor) {
            if($adaptor::isPackageAvailable()) {
                return new $adaptor();
            }
        }

        throw new \Exception(
            'Could not discover JWT Library, 
            Please make sure one is included and the Adaptor is used'
        );
    }
}