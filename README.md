QPriceFormat
==============
Wrapper for Price Format jQuery Plugin created By Eduardo Cuducos


## Instalation
Copy all extension files to your extension folder

## Usage
### With model
```php
$this->widget('ext.priceFormat.QPriceFormat',
	'model'=>$model,
	'attribute'=>'amount'
);
```
### Without model
```php
$this->widget('ext.priceFormat.QPriceFormat',
	'name'=>'amount'
);
```

### Manual Binding Element
If you just want to bind element, using createWidget() and passing 'selector' property.

Example to format all element with 'number' class :
```php
$this->createWidget('ext.priceFormat.QPriceFormat',array('selector'=>'.number'));
```


## Widget options

* `unmaskHidden` *(boolean)*

	If `true`, new hidden field will generate. This hidden field will fill by non formattedd value. Use unmaskHidden = true if you define numerical validator in your model to the attribute. Default value is `true`.

	**Notice !** : `unmaskHidden` option will not affected if you manually binding element (call `createWidget()` directly).
	
* Other widget options please refer to jquery price format documentation.

## Reference
* [jQuery Price Format](http://jquerypriceformat.com).
* [Github Project](http://www.github.com/luckynvic/QPriceFormat)

