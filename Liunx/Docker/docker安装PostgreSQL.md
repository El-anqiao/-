<article>
		<div id="article_content" class="article_content clearfix csdn-tracking-statistics" data-pid="blog" data-mod="popu_307" data-dsm="post">
								<div class="article-copyright">
					版权声明：本文为liuyueyi1995原创文章，转载请注明出处。					https://blog.csdn.net/liuyueyi1995/article/details/61204205				</div>
								            <div class="markdown_views">
							<!-- flowchart 箭头图标 勿删 -->
							<svg xmlns="http://www.w3.org/2000/svg" style="display: none;"><path stroke-linecap="round" d="M5,0 0,2.5 5,5z" id="raphael-marker-block" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path></svg>
							<h1 id="0-任务简介"><a name="t0"></a>0 任务简介</h1>

<ul>
<li>在<code>Ubuntu 16.04</code>虚拟机中安装<code>docker</code></li>
<li>使用<code>docker</code>安装<code>PostgreSQL</code></li>
<li>完成端口映射使得外部机器可以访问虚拟机中的数据库  </li>
</ul>

<hr>

<h1 id="1-安装docker"><a name="t1"></a>1 安装docker</h1>

<p>这一部分比较简单，不过考虑到完整性，还是列出来吧。 <br>
我这次选择的是<code>docker-ce</code>，安装流程如下：</p>

<hr>

<h2 id="11-建立-repository"><a name="t2"></a>1.1 建立 repository</h2>

<pre class="prettyprint" name="code"><code class="hljs lasso has-numbering">sudo apt<span class="hljs-attribute">-get</span> install apt<span class="hljs-attribute">-transport</span><span class="hljs-attribute">-https</span> ca<span class="hljs-attribute">-certificates</span> curl software<span class="hljs-attribute">-properties</span><span class="hljs-attribute">-common</span></code><ul class="pre-numbering" style=""><li style="color: rgb(153, 153, 153);">1</li></ul></pre>

<pre class="prettyprint" name="code"><code class="hljs avrasm has-numbering">curl -fsSL https://download<span class="hljs-preprocessor">.docker</span><span class="hljs-preprocessor">.com</span>/linux/ubuntu/gpg | sudo apt-key <span class="hljs-keyword">add</span> -</code><ul class="pre-numbering" style=""><li style="color: rgb(153, 153, 153);">1</li></ul></pre>

<pre class="prettyprint" name="code"><code class="hljs bash has-numbering"><span class="hljs-built_in">sudo</span> apt-key fingerprint <span class="hljs-number">0</span>EBFCD88</code><ul class="pre-numbering" style=""><li style="color: rgb(153, 153, 153);">1</li></ul></pre>



<pre class="prettyprint" name="code"><code class="hljs bash has-numbering"><span class="hljs-built_in">sudo</span> add-apt-repository <span class="hljs-string">"deb [arch=amd64] https://download.docker.com/linux/ubuntu <span class="hljs-variable">$(lsb_release -cs)</span> stable"</span></code><ul class="pre-numbering" style=""><li style="color: rgb(153, 153, 153);">1</li></ul></pre>

<hr>



<h2 id="12-安装docker"><a name="t3"></a>1.2 安装docker</h2>



<pre class="prettyprint" name="code"><code class="hljs bash has-numbering"><span class="hljs-built_in">sudo</span> apt-get update</code><ul class="pre-numbering" style=""><li style="color: rgb(153, 153, 153);">1</li></ul></pre>



<pre class="prettyprint" name="code"><code class="hljs lasso has-numbering">sudo apt<span class="hljs-attribute">-get</span> install docker<span class="hljs-attribute">-ce</span></code><ul class="pre-numbering" style=""><li style="color: rgb(153, 153, 153);">1</li></ul></pre>

<hr>



<h1 id="2-安装postgresql"><a name="t4"></a>2 安装PostgreSQL</h1>



<pre class="prettyprint" name="code"><code class="hljs css has-numbering"><span class="hljs-tag">docker</span> <span class="hljs-tag">pull</span> <span class="hljs-tag">postgres</span><span class="hljs-pseudo">:9</span><span class="hljs-class">.4</span></code><ul class="pre-numbering" style=""><li style="color: rgb(153, 153, 153);">1</li></ul></pre>

<hr>



<h1 id="3-创建容器"><a name="t5"></a>3 创建容器</h1>

<p>docker的容器默认情况下只能由本地主机访问，即A主机上的容器不能被B主机访问，所以要做端口映射。</p>

<pre class="prettyprint" name="code"><code class="hljs lasso has-numbering">docker run <span class="hljs-subst">--</span>name postgres1 <span class="hljs-attribute">-e</span> POSTGRES_PASSWORD<span class="hljs-subst">=</span>password <span class="hljs-attribute">-p</span> <span class="hljs-number">54321</span>:<span class="hljs-number">5432</span> <span class="hljs-attribute">-d</span> postgres:<span class="hljs-number">9.4</span> </code><ul class="pre-numbering" style=""><li style="color: rgb(153, 153, 153);">1</li></ul></pre>

<p>解释： <br>
<code>run</code>，创建并运行一个容器； <br>
<code>--name</code>，指定创建的容器的名字； <br>
<code>-e POSTGRES_PASSWORD=password</code>，设置环境变量，指定数据库的登录口令为<code>password</code>； <br>
<code>-p 54321:5432</code>，端口映射将容器的5432端口映射到外部机器的54321端口； <br>
<code>-d postgres:9.4</code>，指定使用<code>postgres:9.4</code>作为镜像。</p>

<hr>

<h2 id="31-验证结果"><a name="t6"></a>3.1 验证结果</h2>

<p>之后运行<code>docker ps -a</code>，结果和下表类似：</p>

<h2 id="container-id-image-command-created-status-ports-names-f6951e0c5c77-postgres94-docker-entrypoint-38-minutes-ago-up-38-minutes-000054321-5432tcp-postgres1"><table>
<thead>
<tr>
  <th>CONTAINER ID</th>
  <th>IMAGE</th>
  <th>COMMAND</th>
  <th>CREATED</th>
  <th>STATUS</th>
  <th>PORTS</th>
  <th>NAMES</th>
</tr>
</thead>
<tbody><tr>
  <td>f6951e0c5c77</td>
  <td>postgres:9.4</td>
  <td>“docker-entrypoint…”</td>
  <td>38 minutes ago</td>
  <td>Up 38 minutes</td>
  <td>0.0.0.0:54321-&gt;5432/tcp</td>
  <td>postgres1</td>
</tr>
</tbody></table>
</h2>



<h2 id="32-关键点"><a name="t8"></a>3.2 关键点</h2>

<p>我自己安装的过程中遇到了不少的坑，我认为最重要的一点是docker命令中<strong>参数的顺序</strong>。</p>

<p>例如端口映射的<code>-p 54321:5432</code>的位置如果过于靠后，则会导致映射失败。</p>

<hr>

<h1 id="4-连接数据库"><a name="t9"></a>4 连接数据库</h1>

<p>之前的准备工作都已完成，下一步就是从外部访问数据库了。 <br>
这一步就很常规了：</p>

<pre class="prettyprint" name="code"><code class="hljs lasso has-numbering">psql <span class="hljs-attribute">-U</span> postgres <span class="hljs-attribute">-h</span> <span class="hljs-number">192.168</span><span class="hljs-number">.100</span><span class="hljs-number">.172</span> <span class="hljs-attribute">-p</span> <span class="hljs-number">54321</span></code><ul class="pre-numbering" style=""><li style="color: rgb(153, 153, 153);">1</li></ul></pre>

<p><strong>注意</strong>： <br>
postgres镜像默认的用户名为<code>postgres</code>， <br>
登陆口令为创建容器是指定的值。</p>

<hr>

<h1 id="5-参考文献"><a name="t10"></a>5 参考文献</h1>

<p>[1] <a href="https://docs.docker.com/engine/installation/linux/ubuntu/" rel="nofollow" target="_blank">docker官网</a> <br>
[2] <a href="https://hub.docker.com/_/postgres/" rel="nofollow" target="_blank">postgres镜像官方文档</a> <br>
[3] <a href="http://www.open-open.com/lib/view/open1423703640748.html" rel="nofollow" target="_blank">非常详细的 Docker 学习笔记</a></p>            </div>


------

#### 安装插件

```powershell
下载镜像
docker run --name postgres2 -e POSTGRES_PASSWORD=password -p 54321:5432 -d postgres:10
docker exec -ti postgres1 /bin/bash

安装 图片识别
apt-get update && apt-get install --no-install-recommends -y wget unzip make gcc postgresql-server-dev-10 libgd-dev ca-certificates libc6-dev && \
    wget https://github.com/postgrespro/imgsmlr/archive/master.zip -O /opt/imgsmlr.zip && \
    cd /opt && unzip imgsmlr.zip && \
    cd /opt/imgsmlr-master && make USE_PGXS=1 && make install USE_PGXS=1 && \
    
添加扩展
psql --u postgres  postgres -c "CREATE EXTENSION imgsmlr;"
    

创建表、
create table image (id serial, data bytea,type varchar(50));

转换数据、
CREATE TABLE pat AS (
	SELECT
		ID,
		shuffle_pattern (pattern) AS pattern,
		pattern2signature (pattern) AS signature
	FROM
		(
			SELECT
				ID,
				CASE TYPE
			WHEN 'jpg' THEN
				jpeg2pattern (DATA)
			WHEN 'png' THEN
				png2pattern (DATA)
			WHEN 'gif' THEN
				gif2pattern (DATA)
			END AS pattern
			FROM
				image
		) x
);

ALTER TABLE pat ADD PRIMARY KEY (ID);

CREATE INDEX pat_signature_idx ON pat USING gist (signature);

查询
SELECT  
	id,smlr, pattern
FROM  
(  
	SELECT  
		id,pattern <-> (SELECT pattern from pat WHERE id = 2) AS smlr  ,pattern
	FROM pat  
	WHERE id <> 2  
	ORDER BY  
		signature <-> (SELECT signature from pat WHERE id = 2)  
	LIMIT 100  
) x  

ORDER BY x.smlr ASC   
LIMIT 10  

```







```php
##php 存数据 

$host        = "host=192.168.99.100";
        $port        = "port=54321";
        $dbname      = "dbname=postgres";
        $credentials = "user=postgres password=password";
        echo $host;

        $db = pg_connect( "$host $port $dbname $credentials");
        if(!$db){
            echo "Error : Unable to connect PostgreSQL\n";

        } else {
            echo "connect PostgreSQL successfully\n";
            //$result = pg_query($db, 'SELECT * FROM "public"."image";');
           // $arr = pg_fetch_array($result);
            //var_dump($arr);

            //将文件插入数据库的tb_doc_res_data
            $path=dirname(dirname(__DIR__)).'/public/data/' ;
            $handler = opendir($path);
            $tb_docmaxid=1;
            while (($filename = readdir($handler)) !== false) {//务必使用!==，防止目录下出现类似文件名“0”等情况
                if ($filename != "." && $filename != "..") {

                    $data=file_get_contents($path.$filename);//文献的完整路径
                    $escaped=pg_escape_bytea($data); //关键处
                    $type=end(explode('.',$filename));

                    $insertSQL="insert into image values(".$tb_docmaxid.",'{$escaped}','{$type}')";
                    //var_dump($insertSQL);die;
                    $result3=pg_query($db,$insertSQL); //执行插入语句命令
                    $tb_docmaxid++;
                    var_dump($result3);
                }
            }
            closedir($handler);

        }

```

