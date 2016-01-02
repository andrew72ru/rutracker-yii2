# Sphinx configuration

Sphinx 2.2.9.

File `/etc/sphinxsearch/sphinx.conf`

```
source torrentz {
    type = mysql
    sql_host = localhost
    sql_user = webmaster
    sql_pass = webmaster
    sql_db = rutracker
    sql_port = 3306

    sql_query_pre = SET NAMES utf8
    sql_query_pre = SET CHARACTER SET utf8

    sql_query = SELECT id, id AS id_attr, \
        size, size AS size_attr, \
        datetime, datetime as datetime_attr, \
        topic_name, topic_name AS name_attr, \
        topic_id, topic_id AS topic_id_attr, \
        category_id, category_id AS category_attr, \
        forum_name_id, forum_name_id AS forum_name_id_attr \
        FROM torrents

    sql_attr_string = name_attr
    sql_attr_uint = id_attr
    sql_attr_uint = size_attr
    sql_attr_uint = datetime_attr
    sql_attr_uint = topic_id_attr
    sql_attr_uint = category_attr
    sql_attr_uint = forum_name_id_attr

}

index torrentz {
    source = torrentz
    path = /var/lib/sphinxsearch/data/
    docinfo = extern
    morphology = stem_enru
    min_word_len = 2
    charset_table = 0..9, A..Z->a..z, _, a..z, U+410..U+42C->U+430..U+44C, U+42E..U+42F->U+44E..U+44F, U+430..U+44C, U+44E..U+44F, U+0401->U+0435, U+0451->U+0435, U+042D->U+0435, U+044D->U+0435
    min_infix_len = 2
}

indexer {
    mem_limit = 512M
}

searchd {
    listen = 0.0.0.0:9306:mysql41
    log = /var/log/sphinxsearch/searchd.log
    query_log = /var/log/sphinxsearch/query.log
    read_timeout = 5
    max_children = 30
    pid_file = /var/run/sphinxsearch/searchd.pid
}
```