FROM alpine:3.14

RUN apk add --no-cache  --repository http://dl-cdn.alpinelinux.org/alpine/edge/community php
RUN php -v
