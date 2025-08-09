# PCF8574 Driver for FPP (Falcon Player)

A plugin for FPP (Falcon Player) that provides support for PCF8574 I2C GPIO expanders, allowing you to add more input/output pins to your FPP setup.

## Features

- Easy configuration of I2C bus and address
- Automatic driver loading at system boot
- Simple web interface for configuration
- Supports multiple PCF8574 chips

## Installation

1. Copy the `fpp-pcf8574` directory to `/home/fpp/media/plugins/` on your FPP system
2. Run the plugin setup (usually via the FPP web interface)
3. Configure the I2C bus and address in the plugin settings

## Configuration

Configure the plugin settings through the FPP web interface:

1. Go to the FPP web interface
2. Navigate to the Plugin Manager
3. Find "PCF8574 Driver" in the list and click the gear icon
4. Configure the following settings:
   - **I2C Bus**: The I2C bus number (typically 1 for Raspberry Pi)
   - **I2C Address**: The I2C address of your PCF8574 chip (0x20-0x27 for PCF8574, 0x38-0x3F for PCF8574A)
5. Click "Save" to apply your changes

These settings will be saved to `config.json` in the plugin directory.

## Usage

Once installed and configured, the PCF8574 GPIOs will be available in the FPP GPIO Input/Output interfaces.

### Pin Mapping

- P0: GPIO 0
- P1: GPIO 1
- ...
- P7: GPIO 7

## Requirements

- FPP (Falcon Player) 5.0 or later
- Linux kernel with PCF857x driver support
- I2C enabled on your system

## Development

This plugin follows the standard FPP plugin structure. The main components are:

- `pluginInfo.json`: Plugin metadata and configuration
- `pluginSetup.php`: Plugin installation and setup
- `content.php`: Web interface for configuration
- `scripts/`: Contains installation and driver scripts

## License

MIT License

## Author

Justin Moore
