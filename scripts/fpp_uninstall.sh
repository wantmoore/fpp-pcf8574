#!/bin/bash

# Stop and disable the service if it's running
systemctl stop fpp-pcf8574.service 2>/dev/null
systemctl disable fpp-pcf8574.service 2>/dev/null

# Remove systemd service file
rm -f /etc/systemd/system/fpp-pcf8574.service

# Remove driver script
rm -f /usr/local/bin/fpp-pcf8574.sh

# Reload systemd to apply changes
systemctl daemon-reload

# Remove the plugin directory
rm -rf /home/fpp/media/plugins/fpp-pcf8574

echo "PCF8574 Driver has been uninstalled."
