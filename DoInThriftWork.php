<?php
require_once __DIR__ . "/thriftinc.php";
use Thrift\TProtocol;

interface DoInThriftWork {
   function doInThrift(TProtocol $protocol);
}