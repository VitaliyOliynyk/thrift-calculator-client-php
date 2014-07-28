<?php
error_reporting(E_ALL);
require_once('ThriftTemplate.php');
use thrift\calculator\Operation;
use thrift\calculator\CalculatorServiceClient;
use thrift\discoveryservice\DiscoveryServiceClient;
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

<form method="get">
    <div>
        arg1: <input type="text" name="arg1"/> arg2:<input type="text" name="arg2"/>
    </div>
    <select name="operation">
        <option name="add">add</option>
        <option name="remove">remove</option>
        <option name="multiply">multiply</option>
        <option name="divide">divide</option>
    </select>
    <div>
        <input type="submit" value="calculate"/>
    </div>
    <?php
    if(isset($_GET['arg1'])) {

        $discoveryServiceThriftTemplate = new ThriftTemplate("127.0.0.1", 10001);
        $calculatorServicenfo = $discoveryServiceThriftTemplate->doInThrift(function($protocol) {
            $client = new DiscoveryServiceClient($protocol);
            $serverInfo = $client->getInfo("calculator");
            return $serverInfo;
        });


        $calculatorServiceThriftTemplate = new ThriftTemplate($calculatorServicenfo->host, $calculatorServicenfo->port);
        $result = $calculatorServiceThriftTemplate->doInThrift(function($protocol) {
            $client = new CalculatorServiceClient($protocol);
            $work = new thrift\calculator\Work();
            $work->arg1 = $_GET['arg1'];
            $work->arg2 = $_GET['arg2'];
            $oparations = array(
                'add' => Operation::ADD,
                'remove' => Operation::SUBTRACT,
                'multiply' => Operation::MULTIPLY,
                'divide' => Operation::DIVIDE,
            );

            $work->operation = $oparations[$_GET['operation']];

            $serverInfo = $client->calculate($work);
            return $serverInfo;
        });

        echo "Calculator service, host=" , $calculatorServicenfo->host , ", port=" , $calculatorServicenfo->port, "</br>" ;
        echo "Result: ", $result;
    }
    ?>
</form>

</body>
</html>