# Dragon-Nest-Simple-Website
PHP >= 8.1 and Nginx


## ****[nginx.conf]****

```
worker_processes  1;

events {
    worker_connections  1024;
}


http {
    include       mime.types;
    default_type  application/octet-stream;

    sendfile        on;
    keepalive_timeout  65;

    server {
        listen       80;
        server_name  localhost;
		
        location / {
			root   html;
			try_files $uri $uri.html $uri/ @extensionless-php;
			index  index.php index.html index.htm;
        }
		
        error_page   500 502 503 504  /50x.html;
		
        location = /50x.html {
            root   html;
        }
		
		location @extensionless-php {
			rewrite ^(.*)$ $1.php last;
		}

        location ~ \.php$ {
			root           html;
			try_files $uri = 404;
            fastcgi_pass    127.0.0.1:8080;
            fastcgi_index   index.php;
            fastcgi_param   SCRIPT_FILENAME  $document_root$fastcgi_script_name;
            include         fastcgi_params;
        }
    }
}
```
