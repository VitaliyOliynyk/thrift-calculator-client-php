<?php
require_once __DIR__ . '/lib/thrift/Thrift/ClassLoader/ThriftClassLoader.php';
use Thrift\ClassLoader\ThriftClassLoader;

$GEN_DIR = realpath(dirname(__FILE__)) . '/gen/gen-php';
$loader = new ThriftClassLoader();
$loader->registerNamespace('Thrift', __DIR__ . '/lib/thrift');
$loader->registerDefinition('thrift', $GEN_DIR);
$loader->register();

use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TSocket;
use Thrift\Transport\THttpClient;
use Thrift\Transport\TBufferedTransport;
use Thrift\Exception\TException;

class ThriftClient {
    private $host;
    private $port;
    private $transport;
    protected $protocol;

    function __construct($host, $port)
    {
        $this->host = $host;
        $this->port = $port;
        $this->initThrift();
    }


    protected function initThrift()
    {
        $socket = new TSocket($this->host, $this->port);
        $this->transport = new TBufferedTransport($socket, 1024, 1024);  // ..., $rBufSize, $wBufSize
        $this->protocol = new TBinaryProtocol($this->transport);
        $this->transport->open();
    }

    public function close()
    {
        $this->transport->close();
    }
}