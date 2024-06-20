FROM httpd
LABEL version=1.0.0
RUN apt update
RUN apt install -y git
RUN apt install -y nano
RUN rm -rf /usr/local/apache2/htdocs
RUN mkdir /usr/local/apache2/htdocs
RUN git clone https://github.com/firstruner/tinyshop_demo.git /usr/local/apache2/htdocs
#Ajouter des arguments
ARG search_text
ARG replace_text
Arg path=/usr/local/apache2/htdocs/index.html
RUN sed -i "s/${search_text}/${replace_text}/g" ${path} 
EXPOSE 80
