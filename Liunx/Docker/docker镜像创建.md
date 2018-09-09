# docker镜像创建

#h1 进入已经运行的容器
docker ps
docker exec -it hera /bin/bash

docker run --name hera -p 8088:8088 -itv  /Users/anqiao/Documents/CodeStructure:/www  swoft/swoft:latest  /bin/bash



/usr/lib/php/extensions/no-debug-non-zts-20160303

# mysql

```
docker run --name mysql -p 3306:3306 -e MYSQL_ROOT_PASSWORD=root -d mysql

docker exec -it mysql /bin/bash
```