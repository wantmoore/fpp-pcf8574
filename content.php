<?php
$pluginPath = __DIR__;
$configFile = $pluginPath . '/config.json';
if (!file_exists($configFile)) { file_put_contents($configFile, json_encode(["i2c_bus"=>"1","i2c_addr"=>"0x21"], JSON_PRETTY_PRINT)); }
if (isset($_POST['save'])) {
    $cfg = ["i2c_bus" => trim($_POST['i2c_bus']), "i2c_addr" => trim($_POST['i2c_addr'])];
    file_put_contents($configFile, json_encode($cfg, JSON_PRETTY_PRINT));
    file_put_contents($pluginPath.'/config.env', "I2C_BUS={$cfg['i2c_bus']}\nI2C_ADDR={$cfg['i2c_addr']}\n");
    exec('sudo bash ' . $pluginPath . '/scripts/install_driver.sh > /dev/null 2>&1 &');
    echo '<div class="alert alert-success">Settings saved.</div>';
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