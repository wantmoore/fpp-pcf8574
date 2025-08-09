#!/bin/bash
modprobe gpio-pcf857x
echo pcf8574 $I2C_ADDR > /sys/bus/i2c/devices/i2c-$I2C_BUS/new_device
