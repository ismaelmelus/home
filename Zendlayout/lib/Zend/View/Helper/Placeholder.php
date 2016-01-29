<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to version 1.0 of the Zend Framework
 * license, that is bundled with this package in the file LICENSE.txt, and
 * is available through the world-wide-web at the following URL:
 * http://framework.zend.com/license/new-bsd. If you did not receive
 * a copy of the Zend Framework license and are unable to obtain it
 * through the world-wide-web, please send a note to license@zend.com
 * so we can mail you a copy immediately.
 *
 * @package    Zend_View
 * @subpackage Helpers
 * @copyright  Copyright (c) 2005-2007 Zend Technologies USA Inc. (http://www.zend.com)
 * @version    $Id: Placeholder.php 7078 2007-12-11 14:29:33Z matthew $
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/** Zend_Registry */
require_once 'Zend/Registry.php';

/**
 * Helper for passing data between otherwise segregated Views. It's called
 * Placeholder to make its typical usage obvious, but can be used just as easily
 * for non-Placeholder things. That said, the support for this is only
 * guaranteed to effect subsequently rendered templates, and of course Layouts.
 *
 * @package    Zend_View
 * @subpackage Helpers
 * @copyright  Copyright (c) 2005-2007 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */ 
class Zend_View_Helper_Placeholder  
{  
    /**
     * Zend_Registry key under which placeholder registry exists
     * @const string
     */
    const REGISTRY_KEY = 'Zend_View_Helper_Placeholder_Registry';

    /**
     * @var Zend_View_Interface
     */  
    public $view;  
  
    /**
     * Placeholder items
     * @var array
     */  
    protected $_items = array();  

    /**
     * @var Zend_View_Helper_Placeholder_Registry
     */
    protected $_registry;

    /**
     * Constructor
     *
     * Retrieve container registry from Zend_Registry, or create new one and register it.
     * 
     * @return void
     */
    public function __construct()
    {
        if (Zend_Registry::isRegistered(self::REGISTRY_KEY)) {
            $this->_registry = Zend_Registry::get(self::REGISTRY_KEY);
        } else {
            require_once 'Zend/View/Helper/Placeholder/Registry.php';
            $this->_registry = new Zend_View_Helper_Placeholder_Registry();
            Zend_Registry::set(self::REGISTRY_KEY, $this->_registry);
        }
    }
  
    /**
     * Set view
     * 
     * @param  Zend_View_Interface $view 
     * @return void
     */  
    public function setView(Zend_View_Interface $view)  
    {  
        $this->view = $view;  
    }  
  
    /**
     * Placeholder helper
     * 
     * @param  string $name 
     * @return Zend_View_Helper_Placeholder_Container_Abstract
     */  
    public function placeholder($name)  
    {  
        $name = (string) $name;  
        return $this->_registry->getContainer($name);
    }  

    /**
     * Retrieve the registry
     * 
     * @return Zend_View_Helper_Placeholder_Registry
     */
    public function getRegistry()
    {
        return $this->_registry;
    }
}
