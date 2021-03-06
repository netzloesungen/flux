<?php
namespace FluidTYPO3\Flux\Tests\Unit\ViewHelpers\Field;

/*
 * This file is part of the FluidTYPO3/Flux project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use FluidTYPO3\Flux\Tests\Unit\ViewHelpers\Field\AbstractFieldViewHelperTestCase;
use TYPO3\CMS\Extbase\Reflection\ObjectAccess;
use TYPO3\CMS\Fluid\Core\Parser\SyntaxTree\TextNode;
use TYPO3\CMS\Fluid\Core\Parser\SyntaxTree\ViewHelperNode;
use TYPO3\CMS\Fluid\Core\ViewHelper\TemplateVariableContainer;

/**
 * @package Flux
 */
class CustomViewHelperTest extends AbstractFieldViewHelperTestCase {

	/**
	 * @test
	 */
	public function canGenerateAndExecuteClosureWithoutArgumentCollision() {
		$this->executeViewHelperClosure();
	}

	/**
	 * @test
	 */
	public function canGenerateAndExecuteClosureWithArgumentCollisionAndBackups() {
		$arguments = array(
			'parameters' => 'Fake parameter'
		);
		$container = $this->executeViewHelperClosure($arguments);
		$this->assertSame($container->get('parameters'), $arguments['parameters']);
	}

	/**
	 * @param array $templateVariableContainerArguments
	 * @return TemplateVariableContainer
	 */
	protected function executeViewHelperClosure($templateVariableContainerArguments = array()) {
		$instance = $this->objectManager->get('FluidTYPO3\Flux\ViewHelpers\Field\CustomViewHelper');
		$container = $this->objectManager->get('TYPO3\CMS\Fluid\Core\ViewHelper\TemplateVariableContainer');
		$arguments = array(
			'name' => 'custom'
		);
		foreach ($templateVariableContainerArguments as $name => $value) {
			$container->add($name, $value);
		}
		$node = new ViewHelperNode($instance, $arguments);
		$childNode = new TextNode('Hello world!');
		$renderingContext = $this->getAccessibleMock('TYPO3\CMS\Fluid\Core\Rendering\RenderingContext');
		ObjectAccess::setProperty($renderingContext, 'templateVariableContainer', $container);
		$node->addChildNode($childNode);
		ObjectAccess::setProperty($instance, 'templateVariableContainer', $container, TRUE);
		ObjectAccess::setProperty($instance, 'renderingContext', $renderingContext, TRUE);
		$instance->setViewHelperNode($node);
		/** @var \Closure $closure */
		$closure = $this->callInaccessibleMethod($instance, 'buildClosure');
		$parameters = array(
			'itemFormElName' => 'test',
			'itemFormElLabel' => 'Test label',
		);
		$output = $closure($parameters);
		$this->assertNotEmpty($output);
		$this->assertSame('Hello world!', $output);
		return $instance->getTemplateVariableContainer();
	}

}
