#!/bin/bash

pluginPath="/home/fpp/media/plugins/fpp-pcf8574"
CONFIG_FILE="$$pluginPath/config.json"

if [ ! -f "$CONFIG_FILE" ]; then
  echo "Missing config.json"
  exit 1
fi

I2C_BUS=$(jq -r .i2c_bus "$CONFIG_FILE")
I2C_ADDR=$(jq -r .i2c_addr "$CONFIG_FILE")

DRIVER_SCRIPT="/usr/local/bin/fpp-pcf8574.sh"
SERVICE_FILE="/etc/systemd/system/fpp-pcf8574.service"

# Create driver script
cat <<EOF > "$DRIVER_SCRIPT"
#!/bin/bash
modprobe gpio-pcf857x
echo pcf8574 \$I2C_ADDR > /sys/bus/i2c/devices/i2c-\$I2C_BUS/new_device
EOF
chmod +x "$DRIVER_SCRIPT"

# Create systemd service
cat <<EOF > "$SERVICE_FILE"
[Unit]
Description=Load PCF8574 GPIO driver
After=multi-user.target
ConditionPathExists=$DRIVER_SCRIPT

[Service]
Type=oneshot
ExecStart=$DRIVER_SCRIPT
RemainAfterExit=true

[Install]
WantedBy=multi-user.target
EOF

# Enable and start the service
systemctl daemon-reexec
systemctl daemon-reload
systemctl enable fpp-pcf8574.service
systemctl restart fpp-pcf8574.service