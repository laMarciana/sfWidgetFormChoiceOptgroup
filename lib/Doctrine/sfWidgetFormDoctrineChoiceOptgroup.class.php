<?php

/*
 * (c) Marc Busqué <marc@lamarciana.com>
 *
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfWidgetFormDoctrineChoiceOptgroup represents a select HTML tag for a model.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Marc Busqué <marc@lamarciana.com>
 * @link       https://github.com/laMarciana/sfWidgetFormChoiceOptgroup
 * @license    MIT
 */
class sfWidgetFormDoctrineChoiceOptgroup extends sfWidgetFormDoctrineChoice
{
   /**
    * @see sfWidget
    */
   public function __construct($options = array(), $attributes = array())
   {
      $options['choices'] = new sfCallable(array($this, 'getChoices'));

      parent::__construct($options, $attributes);
   }

   /**
    * Constructor.
    *
    * Available options:
    *
    *  * optgroup_column:    The column to group the results within optgroup HTML elements, in the PhpName format (required)
    *  * optgroup_method:    The method used to show the optgroup label. If not set, defaults to the getter for 'optgroup_column'
    *
    * @see sfWidgetFormDoctrineChoice
    */
   protected function configure($options = array(), $attributes = array())
   {
      $this->addRequiredOption('optgroup_column');
      $this->addOption('optgroup_method', null);

      parent::configure($options, $attributes);
   }

   /**
    * Returns the choices associated to the model grouped by optcolumn column values
    *
    * @return array An array of choices
    */
   public function getChoices()
   {
      $choices = array();
      if (false !== $this->getOption('add_empty'))
      {
         $choices[''] = true === $this->getOption('add_empty') ? '' : $this->translate($this->getOption('add_empty'));
      }

      if (null === $this->getOption('table_method'))
      {
         $query = null === $this->getOption('query') ? Doctrine_Core::getTable($this->getOption('model'))->createQuery() : $this->getOption('query');
         if ($order = $this->getOption('order_by'))
         {
            $query->addOrderBy($order[0] . ' ' . $order[1]);
         }
         $objects = $query->execute();
      }
      else
      {
         $tableMethod = $this->getOption('table_method');
         $results = Doctrine_Core::getTable($this->getOption('model'))->$tableMethod();

         if ($results instanceof Doctrine_Query)
         {
            $objects = $results->execute();
         }
         else if ($results instanceof Doctrine_Collection)
         {
            $objects = $results;
         }
         else if ($results instanceof Doctrine_Record)
         {
            $objects = new Doctrine_Collection($this->getOption('model'));
            $objects[] = $results;
         }
         else
         {
            $objects = array();
         }
      }

      $method = $this->getOption('method');
      $keyMethod = $this->getOption('key_method');

      if (!$this->getOption('optgroup_method')) {
         $methodOptgroup = 'get'.$this->getOption('optgroup_column');
         $methodOptgroup = 'getAnswer';
      } else {
         $methodOptgroup = $this->getOption('optgroup_method');
      }

      foreach ($objects as $object)
      {
         $choices[$object->$methodOptgroup()][$object->$keyMethod()] = $object->$method();
      }

      return $choices;
   }
}
