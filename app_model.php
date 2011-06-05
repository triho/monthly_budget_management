<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppModel extends Model {
    
    /**
     * Alternative finding functions
     * @param string $type
     * @param array $options
     * @return array
     */
    function find($type, $options = array()) {
        switch ($type) {
            case 'superlist':
                if(!isset($options['fields']) || count($options['fields']) < 3) {
                    return parent::find('list', $options);
                }
 
                if(!isset($options['separator'])) {
                    $options['separator'] = ' ';
                }
 
                $options['recursive'] = -1;              
                $list = parent::find('all', $options);
 
                for($i = 1; $i <= 2; $i++) {
                    $field[$i] = str_replace($this->alias.'.', '', $options['fields'][$i]);               
                }           
 
                return Set::combine($list, '{n}.'.$this->alias.'.'.$this->primaryKey,
                                 array('%s'.$options['separator'].'%s',
                                       '{n}.'.$this->alias.'.'.$field[1],
                                       '{n}.'.$this->alias.'.'.$field[2]));
            break;                      
 
            default:              
                return parent::find($type, $options);
            break;
        }
    }
}
