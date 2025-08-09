<?php
# Menu entries for this plugin. Valid 'type' values:
#   status  => Status/Control
#   content => Content Setup
#   output  => Input/Output
#   help    => Help

$menuEntries = Array(
    Array(
        'text' => 'PCF8574 Driver',
        'type' => 'content',
        'page' => 'content.php',
        'wrap' => 1
    )
);

##############################################################################
# Display the menu entries for this plugin.
#
# $plugin = plugin repo/folder name
# $menu   = current menu section type (status/content/output/help)
foreach ($menuEntries as $entry)
{
    if ($entry['type'] != $menu)
        continue;

    if (preg_match('/^http.?:\/\//', $entry['page']))
    {
        printf("<li><a href='%s' target='_blank'>%s</a></li>\n",
            $entry['page'], $entry['text']);
    }
    else
    {
        $nopage = '';
        if (isset($entry['wrap']) && ($entry['wrap'] == 0))
            $nopage = '&nopage=1';

        printf("<li><a href='plugin.php?plugin=%s&page=%s%s'>%s</a></li>\n",
            $plugin, $entry['page'], $nopage, $entry['text']);
    }
}
?>
