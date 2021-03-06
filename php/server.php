<?php


namespace ThriftSampleDemo;


use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TBufferedTransport;
use Thrift\Transport\TPhpStream;

class EchoHandler  implements EchoIf {

    public function echo(EchoReq $req) {
       return 'php hello:'.$req->msg;
    }
}

header('Content-Type', 'application/x-thrift');
if (php_sapi_name() == 'cli') {
    echo "\r\n";
}

$handler = new EchoHandler();
$processor = new EchoProcessor($handler);

$transport = new TBufferedTransport(new TPhpStream(TPhpStream::MODE_R | TPhpStream::MODE_W));
$protocol = new TBinaryProtocol($transport, true, true);

$transport->open();
$processor->process($protocol, $protocol);
$transport->close();