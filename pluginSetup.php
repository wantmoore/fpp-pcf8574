<?php
// Called when plugin is installed
define('PLUGIN_NAME', 'fpp-pcf8574');
define('PLUGIN_PATH', '/home/fpp/media/plugins/' . PLUGIN_NAME);

function plugin_setup() {
    // Create scripts dir if it doesn't exist
    if (!is_dir(PLUGIN_PATH . '/scripts')) {
        mkdir(PLUGIN_PATH . '/scripts', 0755, true);
    }
    
    // Set default config if not present
    if (!file_exists(PLUGIN_PATH . '/config.json')) {
        $default = ["i2c_bus" => "2", "i2c_addr" => "0x21"];
        file_put_contents(PLUGIN_PATH . '/config.json', json_encode($default, JSON_PRETTY_PRINT));
    }
    
    // Run installer script
    exec("sudo bash " . PLUGIN_PATH . "/scripts/install_driver.sh > /dev/null 2>&1 &");
}
?>