<?php

require_once __DIR__. '/ThriftClient.php';

class DiscoveryServiceClient extends ThriftClient
{


    function __construct($host, $port)
    {
        parent::__construct($host, $port);
    }

    /**
     * @param $serviceName
     * @return thrift\discoveryservice\ServiceInfo
     */
    public function getServerInfo($serviceName)
    {
        $client = new thrift\discoveryservice\DiscoveryServiceClient($this->protocol);
        $serverInfo = $client->getInfo($serviceName);
        $this->close();
        return $serverInfo;
    }


}