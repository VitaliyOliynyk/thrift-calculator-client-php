<?php
require_once __DIR__ . "/thriftinc.php";

use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TSocket;
use Thrift\Transport\TBufferedTransport;
use Thrift\Exception\TException;

class ThriftTemplate {
    private  $host;
    private $port;

    function __construct($host, $port)
    {
        $this->host = $host;
        $this->port = $port;
    }

    public function doInThrift($doInThriftWork) {
        $socket = new TSocket($this->host, $this->port);
        $this->transport = new TBufferedTransport($socket, 1024, 1024);
        $this->protocol = new TBinaryProtocol($this->transport);
        try {
            $this->transport->open();
            return $doInThriftWork($this->protocol);
        } catch (TException $e) {
             if ($this->transport) {
                 @$this->transport->close();
             }
            throw $e;
        }
    }

}