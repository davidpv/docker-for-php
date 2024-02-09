ARG VERSION=2.0
FROM php:8.3-fpm-alpine as base

# para poder reutilizar el mismo argumento hay que volverlo a declarar ya que despues de cada FROM se pierde.
#ARG VERSION
RUN echo "VERSION"
RUN echo ${VERSION}