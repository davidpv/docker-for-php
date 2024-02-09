#!/bin/bash

# Ask the user if they want to continue
read -p "Do you want to continue, all the project data will be overwritten? (y/n): " choice

# Check if the user entered yes
if [[ $choice =~ ^[Yy]$ ]]; then
  ddev config  \
    --project-name=symfony \
    --project-type=php \
    --docroot=public \
    --create-docroot \
    --omit-containers db \
    --php-version=8.3 \
    --database=postgres:14

  ddev start
  ddev exec 'composer create-project symfony/skeleton:"7.0.*" tmp && cp -r tmp/. . && rm -rf tmp'
  ddev composer install
  ddev composer require symfony/orm-pack
  ddev composer require --dev symfony/maker-bundle
  ddev composer require --dev symfony/profiler-pack
  ddev describe
elif [[ $choice =~ ^[Nn]$ ]]; then
    echo "User cancelled. Exiting..."
else
    echo "Invalid input. Exiting..."
fi
