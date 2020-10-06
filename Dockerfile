FROM php:7.4-cli

COPY . /usr/src/kidney-exchange

WORKDIR /usr/src/kidney-exchange

CMD ["php", "-S", "0.0.0.0:8080"]