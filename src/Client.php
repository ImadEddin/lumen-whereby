<?php

namespace Whereby;

use Whereby\Http\WherebyRequest;
/**
 * Description of WherebyRequest
 *
 * @author Adel Jerbi <adel.jerbi@we-conect.com>
 */
class Client {

    protected $baseUrl;
    protected $apiPrefix;
    protected $accessToken;

    public function __construct($token) {
        $this->baseUrl = config('whereby.restApiEndpoint');
        $this->apiPrefix = config('whereby.restApiPrefix');
        $this->accessToken = $token;
    }

    public function createRequest($requestType, $endpoint) {
        return new WherebyRequest(
                $requestType, $endpoint, $this->accessToken, $this->baseUrl, $this->apiPrefix
        );
    }

}
