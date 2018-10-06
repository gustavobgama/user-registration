FROM node:8.12.0-alpine

LABEL maintainer "Gustavo Gama <gustavobgama@gmail.com>"

RUN echo "http://dl-cdn.alpinelinux.org/alpine/edge/community" >> /etc/apk/repositories
RUN apk update && apk --no-cache add \
  curl

ENV YARN_VERSION v1.12.0
RUN curl -O -sL https://github.com/yarnpkg/yarn/releases/download/$YARN_VERSION/yarn-$YARN_VERSION.tar.gz \
  && mkdir /usr/local/yarn \
  && tar -C /usr/local/yarn --strip-components=1 -zxvf yarn-$YARN_VERSION.tar.gz \
  && rm yarn-$YARN_VERSION.tar.gz

WORKDIR /opt/app

CMD ./docker/node/start.sh