```shell
#待机时 掉电快的原因
关闭命令
sudo pmset -a tcpkeepalive 0
Warning: This option disables TCP Keep Alive mechanism when sytem is sleeping. This will result in some critical features like 'Find My Mac' not to function properly.
开启命令
sudo pmset -a tcpkeepalive 1

```

