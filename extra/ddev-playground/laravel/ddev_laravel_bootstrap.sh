#!/bin/bash

# Ask the user if they want to continue
read -p "Do you want to continue, all the project data will be overwritten? (y/n): " choice

# Check if the user entered yes
if [[ $choice =~ ^[Yy]$ ]]; then
  ddev config \
    --project-name=laravel \
    --project-type=laravel \
    --docroot=public \
    --create-docroot \
    --php-version=8.3 \
    --database=postgres:14 \
    --omit-containers db
  ddev start
  ddev exec 'composer create-project laravel/laravel tmp && cp -r tmp/. . && rm -rf tmp'
  ddev describe
elif [[ $choice =~ ^[Nn]$ ]]; then
    echo "User cancelled. Exiting..."
else
    echo "Invalid input. Exiting..."
fi
