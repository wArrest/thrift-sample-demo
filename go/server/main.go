package main

import (
	"context"
	"fmt"
	"github.com/apache/thrift/lib/go/thrift"
	"thrift-sample-demo/gen-go/echo"
)

//定义服务
type EchoServer struct {
}

//实现服务
func (e EchoServer) Echo(ctx context.Context, req *echo.EchoReq) (resp *echo.EchoRes, err error) {
	fmt.Println("receive: " + req.Msg)
	return &echo.EchoRes{
		Msg: "hello: " + req.GetMsg(),
	}, nil
}

func main() {
	transport, err := thrift.NewTServerSocket(":9898")
	if err != nil {
		panic(err)
	}

	handler := &EchoServer{}
	processor := echo.NewEchoProcessor(handler)

	transportFactory := thrift.NewTBufferedTransportFactory(8192)

	protocolFactory := thrift.NewTCompactProtocolFactory()
	server := thrift.NewTSimpleServer4(
		processor,
		transport,
		transportFactory,
		protocolFactory,
	)

	if err := server.Serve(); err != nil {
		panic(err)
	}
}
