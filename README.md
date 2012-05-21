#sfWidgetFormPropelSelectOptgroup

sfWidgetFormPropelSelectOptgroup is a form widget for symfony extending sfWidgetFormPropelSelect. The new feature is the possibility to indicate a column which values will be used to group all the fields with that column value within `optgroup` HTML elements.

To run it you just have to indicate one extra required option: `optgroup_column`, telling, in the PhpName, which is the column to use for the optgroups.

Additionally, you can optionally provide another option: `optgroup_method`, which provides with the method that will be used to display the optgroup label. If it is not set, it defaults to the getter for the `optgroup_column`.

```php
$this->widgetSchema['field'] = new sfWidgetFormPropelSelectOptgroup(array(
    'model' => 'Table',
    'optgroup_column' => 'Column', /*In the PhpName*/,
    'optgroup_method' => 'doSomething', /*if it is not set, it will default to the 'getColumn' method*/
));
```
In addition, you have the `sfWidgetFormPropelSelectManyOptgroup` that acts as the previous one but setting `multiple` to `true` as the default.
