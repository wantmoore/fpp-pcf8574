<?php
require_once("pluginSetup.php");

$configFile = PLUGIN_PATH . '/config.json';
$config = json_decode(file_get_contents($configFile), true);

if (isset($_POST['save'])) {
    $config['i2c_bus'] = $_POST['i2c_bus'];
    $config['i2c_addr'] = $_POST['i2c_addr'];
    file_put_contents($configFile, json_encode($config, JSON_PRETTY_PRINT));
    exec("sudo bash " . PLUGIN_PATH . "/scripts/install_driver.sh > /dev/null 2>&1 &");
    echo '<div class="alert alert-success">Settings saved and service updated.</div>';
}
?>

<h2>fpp-pcf8574 Plugin Settings</h2>
<form method="post">
    <label>I2C Bus:</label>
    <input type="text" name="i2c_bus" value="<?= $config['i2c_bus']; ?>" required><br><br>
    <label>I2C Address (e.g., 0x21):</label>
    <input type="text" name="i2c_addr" value="<?= $config['i2c_addr']; ?>" required><br><br>
    <input type="submit" name="save" value="Save Settings">
</form>