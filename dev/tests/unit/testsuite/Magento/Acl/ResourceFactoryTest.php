<?php
/**
 * Test class for \Magento\Acl\ResourceFactory
 *
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Magento\Acl;

class ResourceFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\Acl\ResourceFactory
     */
    protected $_model;

    /**
     * @var \Magento\ObjectManager
     */
    protected $_objectManager;

    /**
     * @var \Magento\Acl\Resource
     */
    protected $_expectedObject;

    protected function setUp()
    {
        $helper = new \Magento\TestFramework\Helper\ObjectManager($this);

        $this->_objectManager = $this->getMockForAbstractClass('Magento\ObjectManager', array(), '', true, true, true,
            array('create'));

        $this->_expectedObject = $this->getMock('Magento\Acl\Resource', array(), array(), '', false);

        $this->_model = $helper->getObject('Magento\Acl\ResourceFactory', array(
            'objectManager' => $this->_objectManager,
        ));
    }

    public function testCreateResource()
    {
        $arguments = array('5', '6');
        $this->_objectManager->expects($this->once())
            ->method('create')
            ->with('Magento\Acl\Resource', $arguments)
            ->will($this->returnValue($this->_expectedObject));
        $this->assertEquals($this->_expectedObject, $this->_model->createResource($arguments));
    }
}
