<?php
/**
 * @version $Id$
 * @copyright Eric C. Weig, 2017
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @package OHMSElementSet
 */


add_plugin_hook('install', 'OHMSElementSet::install');
add_plugin_hook('uninstall', 'OHMSElementSet::uninstall');
add_plugin_hook('admin_append_to_plugin_uninstall_message', 'OHMSElementSet::plugin_uninstall_message');


/**
 *
 * Based on the OmekaElementSetExample plugin by Jeremy Boggs, 2011.
 * 
 * @package OHMSElementSet
 */

class OHMSElementSet
{
    const ELEMENT_SET_NAME = 'OHMS Element Set';
    const ELEMENT_SET_DESCRIPTION = 'Add your element set description.';
    
    public static $elements = array(
        array(
            'name'           => 'OHMS Object',
            'description'    => 'A valid URL to an OHMS object',
            'record_type'    => 'Item',
            'data_type'      => 'Tiny Text'
        ),
        array(
            'name'           => 'OHMS Object Text',
            'description'    => 'Searchable full-text from the OHMS Object',
            'record_type'    => 'Item',
            'data_type'      => 'Tiny Text'
        ),     
        array(
            'name'           => 'Topic',
            'description'    => 'Genre/Topic term from local authority list',
            'record_type'    => 'Item',
            'data_type'      => 'Tiny Text'
        ),       
        array(
            'name'           => 'Interviewee',
            'description'    => 'Person(s) interviewed',
            'record_type'    => 'Item',
            'data_type'      => 'Tiny Text'
        ),          
        array(
            'name'           => 'Interviewer',
            'description'    => 'Person(s) conducting the interview',
            'record_type'    => 'Item',
            'data_type'      => 'Tiny Text'
        ),          
        array(
            'name'           => 'Interview Format',
            'description'    => 'File format for the oral history; audio or video.',
            'record_type'    => 'Item',
            'data_type'      => 'Tiny Text'
        ),          
        array(
            'name'           => 'Collection',
            'description'    => 'Collection related to the interview.',
            'record_type'    => 'Item',
            'data_type'      => 'Tiny Text'
        ),
        array(
            'name'           => 'Interview Accession',
            'description'    => 'Unique identifier for the interview.',
            'record_type'    => 'Item',
            'data_type'      => 'Tiny Text'
        ),
        array(
            'name'           => 'Interview Keyword',
            'description'    => 'A keyword which describes the interview.',
            'record_type'    => 'Item',
            'data_type'      => 'Tiny Text'
        ),
        array(
            'name'           => 'Interview Topic',
            'description'    => 'A word or phrase which describes the main focus of the interview.',
            'record_type'    => 'Item',
            'data_type'      => 'Tiny Text'
        ),
        array(
            'name'           => 'Interview Duration',
            'description'    => 'Length of interview in minutes and seconds.',
            'record_type'    => 'Item',
            'data_type'      => 'Tiny Text'
        ),
        array(
            'name'           => 'Sort Priority',
            'description'    => 'Integer representing priority for sorting.',
            'record_type'    => 'Item',
            'data_type'      => 'Tiny Text'
        ),
        array(
            'name'           => 'Bio',
            'description'    => 'Description of person or organization.',
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
