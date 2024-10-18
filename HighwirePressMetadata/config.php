<?php
function plugin_config($post)
{
    if (isset($post['highwire_mapping'])) {
        $mapping = $post['highwire_mapping'];
        set_option('highwire_press_mapping', json_encode($mapping));
    }
}

if ($_POST) {
    plugin_config($_POST);
}
?>
