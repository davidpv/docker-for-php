#!/bin/bash
CHECK_DIR="/var/www/html/config"
if [ -d "$CHECK_DIR" ]; then
  echo "SYMFONY ALREADY INSTALLED!!!."
else
  git config --global user.email "me@me.com" && git config --global user.name "me"
  cd /var/www/html
  rm -rf tmp
  symfony new --dir=tmp --version=${SYMFONY_VERSION} --no-git --debug && cp -r tmp/. . && rm -rf tmp
fi