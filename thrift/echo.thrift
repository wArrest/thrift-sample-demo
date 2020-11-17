namespace go echo
namespace php ThriftSampleDemo
struct EchoReq {
    1: string msg;
}

struct EchoRes {
    1: string msg;
}

service Echo {
    EchoRes echo(1: EchoReq req);
}