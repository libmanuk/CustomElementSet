<?php
/**
 * @version $Id$
 * @copyright Eric C. Weig, 2017
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @package SPOKEdboElementSet
 */

add_plugin_hook('install', 'SPOKEdboElementSet::install');
add_plugin_hook('uninstall', 'SPOKEdboElementSet::uninstall');
add_plugin_hook('admin_append_to_plugin_uninstall_message', 'SPOKEdboElementSet::plugin_uninstall_message');

/**
 *
 * Based on the OmekaElementSetExample plugin by Jeremy Boggs, 2011.
 * 
 * @package SPOKEdboElementSet
 */

class SPOKEdboElementSet
{
    const ELEMENT_SET_NAME = 'SPOKEdbo Element Set';
    const ELEMENT_SET_DESCRIPTION = 'Add your element set description.';
    
    public static $elements = array(
        array(
            'name'           => 'OHMS Object',
            'description'    => 'Description of First Element',
            'record_type'    => 'Item',
            'data_type'      => 'Tiny Text'
        ),
        array(
            'name'           => 'Interview Format',
            'description'    => 'Description of Second Element',
            'record_type'    => 'Item',
            'data_type'      => 'Tiny Text'
        ),
    );
    
    public static function install()
    {        
        if (get_db()->getTable('ElementSet')->findByName(self::ELEMENT_SET_NAME)) {
            throw new Exception('An element set by the name "' . self::ELEMENT_SET_NAME . '" already exists. You must delete that element set to install this plugin.');
        }
        
        $elementSetMetadata = array(
            'name'        => self::ELEMENT_SET_NAME, 
            'description' => self::ELEMENT_SET_DESCRIPTION
        );
        
        insert_element_set($elementSetMetadata, self::$elements);
    }
    
    public static function uninstall()
    {
        if ($elementSet = get_db()->getTable('ElementSet')->findByName(self::ELEMENT_SET_NAME)) {
            $elementSet->delete();
        }
    }
    
    public static function plugin_uninstall_message()
    {
        echo '<p><strong>Warning</strong>: This will permanently delete the "' . self::ELEMENT_SET_NAME . '" element set and all its associated metadata. You may deactivate this plugin if you do not want to lose data.</p>';
    }
}
