<?php
return [
    // Used for button elements in button().
    'button' => '<button{{attrs}}>{{text}}</button>',
    // Used for checkboxes in checkbox() and multiCheckbox().
    'checkbox' => '<input type="checkbox" class="custom-control-input" name="{{name}}" value="{{value}}"{{attrs}}>',
    // Input group wrapper for checkboxes created via control().
    'checkboxFormGroup' => '{{label}}',
    // Wrapper container for checkboxes.
    'checkboxWrapper' => '<div class="checkbox">{{label}}</div>',
    'checkboxContainer' => '<div class="form-group custom-control custom-checkbox">{{content}}</div>',
    // Widget ordering for date/time/datetime pickers.
    'dateWidget' => '{{year}}{{month}}{{day}}{{hour}}{{minute}}{{second}}{{meridian}}',
    // Error message wrapper elements.
    'error' => '<div class="invalid-feedback d-block mb-2">{{content}}</div>',
    // Container for error items.
    'errorList' => '<ul>{{content}}</ul>',
    // Error item wrapper.
    'errorItem' => '<li>{{text}}</li>',
    // File input used by file().
    'file' => '<div class="custom-file"><input type="file" class="custom-file-input" name="{{name}}"{{attrs}}><label class="custom-file-label" for="customFile">' . __d('panel', 'Choose file') . '</label></div>',
    // Fieldset element used by allControls().
    'fieldset' => '<fieldset{{attrs}}>{{content}}</fieldset>',
    // Open tag used by create().
    'formStart' => '<form{{attrs}}"autocomplete"="off">',
    // Close tag used by end().
    'formEnd' => '</form>',
    // General grouping container for control(). Defines input/label ordering.
    'formGroup' => '{{label}}{{input}}',
    // Wrapper content used to hide other content.
    'hiddenBlock' => '<div style="display:none;">{{content}}</div>',
    // Generic input element.
    'input' => '<input type="{{type}}" autocomplete="off" name="{{name}}"{{attrs}}class="form-control"/>',
    // Submit input element.
    'inputSubmit' => '<input class="btn btn-primary js-waves-off" type="{{type}}"{{attrs}}/>',
    // Container element used by control().
    'inputContainer' => '<div class="form-group{{required}}">{{content}}</div>',
    // Container element used by control() when a field has an error.
    'inputContainerError' => '<div class="input {{type}}{{required}}">{{content}}{{error}}</div>',
    // Label element when inputs are not nested inside the label.
    'label' => '<label{{attrs}} class="form-label">{{text}}</label>',
    // Label element used for radio and multi-checkbox inputs.
    'nestingLabel' => '{{hidden}}{{input}}<label class="custom-control-label"{{attrs}}>{{text}}</label>',
    // Legends created by allControls()
    'legend' => '<legend>{{text}}</legend>',
    // Multi-Checkbox input set title element.
    'multicheckboxTitle' => '<legend>{{text}}</legend>',
    // Multi-Checkbox wrapping container.
    'multicheckboxWrapper' => '<fieldset{{attrs}}>{{content}}</fieldset>',
    // Option element used in select pickers.
    'option' => '<option value="{{value}}"{{attrs}}>{{text}}</option>',
    // Option group element used in select pickers.
    'optgroup' => '<optgroup label="{{label}}"{{attrs}}>{{content}}</optgroup>',
    // Select element,
    'select' => '<select name="{{name}}"{{attrs}} class="form-control">{{content}}</select>',
    // Multi-select element,
    'selectMultiple' => '<select name="{{name}}[]" multiple="multiple"{{attrs}}>{{content}}</select>',
    // Radio input element,
    'radio' => '<input type="radio" class="custom-control-input" name="{{name}}" value="{{value}}"{{attrs}}>',
    // Wrapping container for radio input/label,
    'radioWrapper' => '<div class="custom-control custom-radio custom-control-inline">{{label}}</div>',
    // Textarea input element,
    'textarea' => '<textarea name="{{name}}" {{attrs}} class="form-control">{{value}}</textarea>',
    // Container for submit buttons.
    'submitContainer' => '{{content}}',
    //Confirm javascript template for postLink()
    'confirmJs' => '{{confirm}}'
];
