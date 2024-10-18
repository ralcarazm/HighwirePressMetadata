<?php
class HighwirePressMetadataPlugin extends Omeka_Plugin_AbstractPlugin
{
    protected $_hooks = array(
        'install',
        'uninstall',
        'config_form',
        'config',
        'public_head',
    );

    public function hookInstall()
    {
        set_option('highwire_press_mapping', json_encode(array()));
    }

    public function hookUninstall()
    {
        delete_option('highwire_press_mapping');
    }

    public function hookConfigForm()
    {
        include 'views/admin/config_form.php';
    }

    public function hookConfig($args)
    {
        $post = $args['post'];
        if (isset($post['highwire_mapping'])) {
            $mapping = $post['highwire_mapping'];
            set_option('highwire_press_mapping', json_encode($mapping));
        }
    }

    public function hookPublicHead($args)
    {

        $item = get_current_record('item', false);

        if ($item) {
            $this->addHighwirePressMetadata($item);
        }
    }

    public function addHighwirePressMetadata($item)
    {
        $mapping = json_decode(get_option('highwire_press_mapping'), true);

        if ($mapping && is_array($mapping)) {
            foreach ($mapping as $highwireElement => $dcElement) {
                if (!empty($dcElement)) {
                    try {
                        $elementTexts = metadata($item, array('Dublin Core', $dcElement), array('all' => true));

                        if (!empty($elementTexts)) {
                            foreach ($elementTexts as $text) {
                                echo '<meta name="' . htmlspecialchars($highwireElement) . '" content="' . htmlspecialchars($text) . '">';
                            }
                        }
                    } catch (Omeka_Record_Exception $e) {
                        error_log("Error al obtener el elemento: " . $dcElement . ". " . $e->getMessage());
                    }
                }
            }
        }
    }
}
