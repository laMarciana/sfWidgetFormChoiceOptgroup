<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfWidgetFormPropelSelectManyOptgroup represents a select HTML tag for a model.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Marc Busqué <marc@lamarciana.com>
 */
class sfWidgetFormPropelSelectManyOptgroup extends sfWidgetFormPropelSelectOptgroup
{
  /**
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetFormPropelSelectOptgroup
   */
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);

    $this->setOption('multiple', true);
  }
}
