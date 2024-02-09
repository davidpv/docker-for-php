#!/bin/bash

# Ask the user if they want to continue
read -p "Do you want to continue, all the project data will be overwritten? (y/n): " choice

# Check if the user entered yes
if [[ $choice =~ ^[Yy]$ ]]; then
  ddev config --project-type=drupal10 --docroot=web --create-docroot
  ddev start
  ddev exec 'composer create-project drupal/recommended-project tmp && cp -r tmp/. . && rm -rf tmp'
  ddev composer require drush/drush
  ddev drush site:install --account-name=admin --account-pass=admin -y
  # use the one-time link (CTRL/CMD + Click) from the command below to edit your admin account details.
  ddev drush uli
  ddev drush site:install --db-url=mysql://db:db@db:3306/db --account-name=admin --account-pass=admin -y
  ddev describe
elif [[ $choice =~ ^[Nn]$ ]]; then
    echo "User cancelled. Exiting..."
else
    echo "Invalid input. Exiting..."
fi
