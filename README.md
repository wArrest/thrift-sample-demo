# thrift-sample-demo

---

Thrift 是一种被广泛使用的 rpc 框架，可以比较灵活的定义数据结构和函数输入输出参数，并且可以跨语言调用。为了保证服务接口的统一性和可维护性，
我们需要在最开始就制定一系列规范并严格遵守，降低后续维护成本。


## go
~~~
#服务端
go run go/server/main.go
#客户端
go run go/client/main.go
~~~
## php
~~~
#客户端
php php/client.php [msg]
~~~
