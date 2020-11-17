<?php

namespace ThriftSampleDemo;
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';

use Thrift\ClassLoader\ThriftClassLoader;

$GEN_DIR = '/Users/wanglucheng/Develop/src/private/github.com/thrift-sample-demo/gen-php';

$loader = new ThriftClassLoader();

$loader->registerNamespace('shared', $GEN_DIR);
$loader->registerNamespace('ThriftSampleDemo', $GEN_DIR);
$loader->register();

use Thrift\Protocol\TBinaryProtocol;
use Thrift\Protocol\TCompactProtocol;
use Thrift\Transport\TSocket;
use Thrift\Transport\TBufferedTransport;
use Thrift\Exception\TException;


try {


    $socket = new TSocket('localhost', 9898);
    $transport = new TBufferedTransport($socket);
    $protocol = new TCompactProtocol($transport);
    $client = new EchoClient($protocol);

    $transport->open();

    if (!isset($argv[1])) {
        echo 'please input you name';
    } else {
        //同步方式进行交互
        $recv = $client->echo(new EchoReq([
          'msg' => $argv[1]
        ]));

        echo "\n" . $recv->msg . "\n";
    }


    //todo 异步方式进行交互

    $transport->close();
} catch (TException $tx) {
    print 'TException: ' . $tx->getMessage() . "\n";
}