<?php
namespace FluidTYPO3\Flux\Form;

/*
 * This file is part of the FluidTYPO3/Flux project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

/**
 * @package Flux
 * @subpackage Form
 */
interface FormInterface {

	/**
	 * @return array
	 */
	public function build();

	/**
	 * @param string $name
	 */
	public function setName($name);

	/**
	 * @return string
	 */
	public function getName();

	/**
	 * @param string $label
	 */
	public function setLabel($label);

	/**
	 * @return string
	 */
	public function getLabel();

	/**
	 * @param string $localLanguageFileRelativePath
	 * @return FormInterface
	 */
	public function setLocalLanguageFileRelativePath($localLanguageFileRelativePath);

	/**
	 * @return string
	 */
	public function getLocalLanguageFileRelativePath();


	/**
	 * @param boolean $disableLocalLanguageLabels
	 * @return FormInterface
	 */
	public function setDisableLocalLanguageLabels($disableLocalLanguageLabels);

	/**
	 * @return boolean
	 */
	public function getDisableLocalLanguageLabels();

	/**
	 * @param ContainerInterface $parent
	 * @return FormInterface
	 */
	public function setParent($parent);

	/**
	 * @return ContainerInterface
	 */
	public function getParent();

	/**
	 * @param array $variables
	 * @return FormInterface
	 */
	public function setVariables($variables);

	/**
	 * @return array
	 */
	public function getVariables();

	/**
	 * @param string $name
	 * @param mixed $value
	 * @return FormInterface
	 */
	public function setVariable($name, $value);

	/**
	 * @param string $name
	 * @return mixed
	 */
	public function getVariable($name);

	/**
	 * @return ContainerInterface
	 */
	public function getRoot();

	/**
	 * @return string
	 */
	public function getPath();

	/**
	 * @param string $extensionName
	 * @return FormInterface
	 */
	public function setExtensionName($extensionName);

	/**
	 * @return mixed
	 */
	public function getExtensionName();

	/**
	 * @param string $type
	 * @return boolean
	 */
	public function isChildOfType($type);

	/**
	 * @return boolean
	 */
	public function hasChildren();

	/**
	 * @param string $type
	 * @param string $name
	 * @param string $label
	 * @return FieldInterface
	 */
	public function createField($type, $name, $label = NULL);

	/**
	 * @param string $type
	 * @param string $name
	 * @param string $label
	 * @return ContainerInterface
	 */
	public function createContainer($type, $name, $label = NULL);

	/**
	 * @param string $type
	 * @param string $name
	 * @param string $label
	 * @return WizardInterface
	 */
	public function createWizard($type, $name, $label = NULL);

	/**
	 * @param integer $inherit
	 * @return FormInterface
	 */
	public function setInherit($inherit);

	/**
	 * @return integer
	 */
	public function getInherit();

	/**
	 * @param boolean $inheritEmpty
	 * @return FormInterface
	 */
	public function setInheritEmpty($inheritEmpty);

	/**
	 * @return boolean
	 */
	public function getInheritEmpty();

}
