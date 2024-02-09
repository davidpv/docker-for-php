#!/bin/bash

# Ask the user if they want to continue
read -p "Do you want to continue, all the project data will be overwritten? (y/n): " choice

# Check if the user entered yes
if [[ $choice =~ ^[Yy]$ ]]; then
  ddev config  \
    --project-name=sylius \
    --project-type=php \
    --docroot=public \
    --create-docroot \
#    --omit-containers db \
    --php-version=8.3 \
    --database=postgres:14

  ddev start
  ddev exec 'composer create-project sylius/sylius-standard tmp && cp -r tmp/. . && rm -rf tmp'
  ddev composer config extra.symfony.require "^6.4"
  ddev composer update
  ddev exec touch .env.dev.local
  ddev exec echo 'DATABASE_URL=mysql://db:db@db/db?serverVersion=mariadb-10.4.11' > .env.dev.local
  ddev exec 'bin/console sylius:install'
  ddev exec 'yarn install && yarn build'
  ddev describe
elif [[ $choice =~ ^[Nn]$ ]]; then
    echo "User cancelled. Exiting..."
else
    echo "Invalid input. Exiting..."
fi
