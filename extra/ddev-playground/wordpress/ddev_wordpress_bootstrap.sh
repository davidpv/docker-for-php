#!/bin/bash

# Ask the user if they want to continue
read -p "Do you want to continue, all the project data will be overwritten? (y/n): " choice

# Check if the user entered yes
if [[ $choice =~ ^[Yy]$ ]]; then
  ddev config  \
    --project-name=wordpress \
    --project-type=wordpress

  ddev start
  ddev wp core download
#  ddev launch
  ddev wp core install --url='$DDEV_PRIMARY_URL' --title='wordpress' --admin_user=admin --admin_email=admin@example.com --prompt=admin_password
  ddev describe
elif [[ $choice =~ ^[Nn]$ ]]; then
    echo "User cancelled. Exiting..."
else
    echo "Invalid input. Exiting..."
fi
