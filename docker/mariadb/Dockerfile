FROM mariadb:10.3.4

COPY ./mariadb.conf /etc/mysql/conf.d

# log query
#RUN sed -i -E 's!#general_log_file!general_log_file!g' /etc/mysql/my.cnf
#RUN sed -i -E 's!#general_log!general_log!g' /etc/mysql/my.cnf
#RUN sed -i -E 's!#slow_query_log.*!slow_query_log=1!g' /etc/mysql/my.cnf
#RUN sed -i -E 's!long_query_time = 10!long_query_time = 1!g' /etc/mysql/my.cnf

RUN chmod -R 0644 /etc/mysql/conf.d