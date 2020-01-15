FROM wordpress:latest

RUN apt-get update && \
    apt-get install -y vim 
    
# Copy existing application directory contents
COPY ./*.ini /usr/local/etc/php/conf.d/
COPY vlog.conf /etc/apache2/sites-available/

RUN a2ensite vlog.conf
RUN service apache2 restart
