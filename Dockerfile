ARG from=ubuntu:16.04

FROM ${from}
RUN apt-get update
RUN apt-get install -y software-properties-common python-software-properties
RUN LC_ALL=C.UTF-8 add-apt-repository -y ppa:ondrej/php
RUN apt-get update
RUN apt-get install -y nginx git wget curl vim php7.0 php7.0-fpm php7.0-mysql supervisor && \
rm -rf /var/lib/apt/lists/*

RUN mkdir -p /usr/local/src/repositories

WORKDIR /usr/local/src/repositories
ARG source=https://github.com/HotOnMik/Docker_HotOnMik.git
ARG release=HotOnMik/freeradius
RUN git clone -b ${release} ${source}

ENV repo_dir /usr/local/src/repositories/HotOnMik
ENV nginx_vhost /etc/nginx/sites-available
ENV nginx_vhost_enabled /etc/nginx/sites-enabled
ENV php_conf /etc/php/7.0/fpm/php.ini
ENV nginx_conf /etc/nginx/nginx.conf
ENV supervisor_conf /etc/supervisor/conf.d/supervisord.conf

RUN sed -i -e 's/;extension=php_mysqli.dll/extension=php_mysqli.dll/g' ${php_conf}
RUN sed -i -e 's/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/g' ${php_conf} && \
echo "\ndaemon off;" >> ${nginx_conf}
WORKDIR ${repo_dir}

RUN rm -r /var/www/html/*
RUN cp -r web_site-files/* /var/www/html/

RUN rm ${nginx_vhost}/*
RUN rm ${nginx_vhost_enabled}/*

RUN cp -r web_nginx-configs/hs.HotOnMik.local.conf ${nginx_vhost}
RUN cp -r web_nginx-configs/login.mik.hs.HotOnMik.local.conf ${nginx_vhost}

RUN ln -s ${nginx_vhost}/* ${nginx_vhost_enabled}/

RUN cp supervisord.conf ${supervisor_conf}
RUN cp start.sh /start.sh

RUN mkdir -p /run/php && \
chown -R www-data:www-data /var/www/html && \
chown -R www-data:www-data /run/php

WORKDIR /
CMD ["./start.sh"]

EXPOSE 80
