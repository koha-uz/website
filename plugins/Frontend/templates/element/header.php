<?php
switch($theme) {
    case 'absolute':
        echo $this->element('headers/header-absolute');
        break;
    case 'gray':
        echo $this->element('headers/header-gray');
        break;
    case 'light':
        echo $this->element('headers/header-light');
        break;
    case 'primary':
        echo $this->element('headers/header-primary');
        break;
    default:
        echo $this->element('headers/header-primary');
}