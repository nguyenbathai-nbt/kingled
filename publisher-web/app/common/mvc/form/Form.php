<?php

namespace Publisher\Common\Mvc\Form;

use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\File;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Numeric;

//use Application\form\Element\Image;
//use Application\form\Element\Search;
//use Application\form\Element\DatePicker;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Date;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;

abstract class Form extends \Phalcon\Forms\Form
{

    protected $helper;
    private static $flatStyle = 'flat';
    private $requiredValid = 'data-fv-notempty';
    private $emailValid = 'data-fv-emailaddress';
    private $minValid = 'data-fv-greaterthan';
    private $maxValid = 'data-fv-lessthan';
    private $stringLengthValid = 'data-fv-stringlength';
    private $patternValid = 'data-fv-regexp';
    private $rangeValid = 'data-fv-between';
    private $numberValid = 'data-fv-numeric';
    private $dateValid = 'data-fv-date';
    private $identicalValid = 'data-fv-identical';
    private $digitsValid = 'data-fv-digits';
    private $remoteValid = 'data-fv-remote';
    public static $listStatus = [
        '1' => 'Yes',
        '0' => 'No'
    ];

    public function renderDecorated($name)
    {
        if (!$this->has($name)) {
            return "form element '$name' not found<br />";
        }

        $this->helper = $this->getDI()->get('helper');

        $element = $this->get($name);
        $messages = $this->getMessagesFor($element->getName());

        $html = '';
//        if (count($messages)) {
//            $html .= '<div class="ui error message">';
//            $html .= '<div class="header">' . 'Error' . '</div>';
//            foreach ($messages as $message) {
//                $html .= '<p>' . $message . '</p>';
//            }
//            $html .= '</div>';
//        }

        if ($element instanceof Hidden) {
            echo $element;
        } else {
            switch (true) {
                case $element instanceof Check:
                    $html .= '<div class="form-group">';
                    $html .= '<div class="checkbox">';

                    if ($element->getLabel()) {
                        $html .= '<label>';
                        $html .= $element;
                        $html .= $element->getLabel();
                        $html .= '</label>';
                    } else {
                        $html .= $element;
                    }
                    $html .= '</div>';
                    $html .= '</div>';
                    break;

                case $element instanceof Image:
                    $html = $this->renderImage($element);
                    break;

                case $element instanceof File:
                    $html .= '<div class="inline field">';
                    $html .= $this->makeLabel($element);
                    $html .= $element;
                    $html .= '</div>';
                    break;

                default:
                    $html .= '<div class="form-group">';
                    $html .= $this->makeLabel($element);
                    $attributes = $element->getAttributes();
                    if (isset($attributes['html'])) {
                        $html .= $attributes['html'];
                        $html .= $element;
                        $html .= '<div style="display: inline;font-size: 20px">.videabiz.com</div>';
                    } else {
                        $html .= $element;
                    }

                    $html .= '</div>';
            }
        }

        return $html;
    }

    public function renderAll()
    {
        $html = '';
        if ($this->getElements()) {
            foreach ($this->getElements() as $element) {
                $html .= $this->renderDecorated($element->getName());
            }
        }
        return $html;
    }

    public function renderInlineAll()
    {
        $html = "";
        if ($this->getElements()) {
            foreach ($this->getElements() as $element) {
                if ($element instanceof Check) {
                    $html .= '<div class="form-group">';
                    $html .= $element;
                    $html .= '&nbsp;<label for="' . $element->getName() . '">' . $element->getLabel() . '</label>';
                    $html .= '</div>';
                    $html .= '&nbsp;&nbsp;&nbsp;';
                } else {
                    $html .= '<div class="form-group">';
                    $html .= '<label class="sr-only" for="' . $element->getName() . '">' . $element->getLabel() . '</label>';
                    $html .= $element;
                    $html .= '</div>';
                    $html .= '&nbsp;';
                }
            }
        }
        return $html;
    }

    private function makeLabel($element)
    {
        if ($element->getLabel()) {
            return '<label for="' . $element->getName() . ' "> ' . $element->getLabel() . '</label>';
        } else {
            return '';
        }
    }

    /**
     * @param Image $element
     * @return string $html
     */
    private function renderImage($element)
    {
        $html = '<div class="form-group">';

        if ($element->getLabel()) {
            $html .= '<label>' . $element->getLabel() . '</label>';
        }
        if ($element->getValue()) {
            $html .= '<section onclick="selectText(this);">' . $element->getValue() . '</section>';
        } else {
            $html .= '<br>';
        }

        $html .= '<div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                 style="width: 200px; min-height: 100px">';

        if ($element->getValue()) {
            $url = $this->getDI()->get('url');
            $html .= '<img src="' . $url->path() . $element->getValue() . '" width="200">';
        }

        $html .= '</div>
                        <div>
                            <span class="btn btn-default btn-file">
                                <span class="fileinput-new">Select image</span>
                                <span class="fileinput-exists">Change</span>
                                <input type="file" name="' . $element->getName() . '">
                            </span>
                            <a href="#" class="btn btn-default fileinput-exists"
                               data-dismiss="fileinput">Remove</a>
                        </div>
                    </div>
                </div>';

        return $html;
    }

    public function addElement($name, $label = '', $typeElement = '', $attributes = [], $value = [], $validation = [])
    {
        $element = null;
        $this->helper = $this->getDI()->get('helper');
        if ($typeElement == 'Select') {
            $value_explode_label = explode('Select', $label, 2);
            if (count($value_explode_label) > 1) {
                $label_explode = trim($value_explode_label[1]);
            }
            if (count($value_explode_label) == 1) {
                $label_explode = trim($value_explode_label[0]);
            }
            $label_explode = $this->helper->translate($label_explode);
        }
        $label = $this->helper->translate($label);
        if (isset($attributes['class'])) {
            $attributes['class'] = 'form-control ' . $attributes['class'];
        } else {
            $attributes['class'] = 'form-control';
        }


        $attributes['placeholder'] = $label;
        if (isset($attributes['required'])) {
            if ($attributes['required']) {
                $attributes[$this->requiredValid] = "true";
                $attributes[$this->requiredValid . '-message'] = $this->helper->translate("Please enter a value");
                $label .= '<span style="color:red"> (*)</span>';
            }
        }
        if (isset($attributes['validations'])) {
            $validations = $attributes['validations'];
            foreach ($validations as $key => $value) {
                switch ($key) {
                    case 'required':
                        $attributes['required'] = true;
                        $attributes[$this->requiredValid] = "true";
                        $attributes[$this->requiredValid . '-message'] = $this->helper->translate("Please enter a value");
                        $label .= '<span style="color:red"> (*)</span>';
                        break;
                    case 'email':
                        $attributes[$this->emailValid] = "true";
                        $attributes[$this->patternValid . '-regexp'] = '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$';
                        $attributes[$this->patternValid . '-message'] = $this->helper->translate("Please enter a valid email address");
                        break;
                    case 'min':
                        $attributes[$this->minValid] = "true";
                        $attributes[$this->minValid . '-value'] = $value;
                        break;
                    case 'max':
                        $attributes[$this->maxValid] = "true";
                        $attributes[$this->maxValid . '-value'] = $value;
                        break;
                    case 'stringlength':
                        $attributes[$this->stringLengthValid] = "true";
                        if (isset($value['min'])) {
                            $attributes[$this->stringLengthValid . '-min'] = $value['min'];
                        }
                        if (isset($value['max'])) {
                            $attributes[$this->stringLengthValid . '-max'] = $value['max'];
                        }
                        $attributes[$this->stringLengthValid . '-message'] = $this->helper->translate("Please enter string value from") . " " . $value['min'] . "-" . $value['max'];
                        break;
                    case 'pattern':
                        $attributes[$this->patternValid] = "true";
                        $attributes[$this->patternValid . '-regexp'] = $value['regexp'];
                        if (isset($value['message'])) {
                            $attributes[$this->patternValid . '-message'] = $this->helper->translate($value['message']);
                        }
                        break;
                    case 'range':
                        $attributes[$this->rangeValid] = "true";
                        if (isset($value['min'])) {
                            $attributes[$this->rangeValid . '-min'] = $value['min'];
                        }
                        if (isset($value['max'])) {
                            $attributes[$this->rangeValid . '-max'] = $value['max'];
                        }
                        break;
                    case 'number':
                        $attributes[$this->numberValid] = "true";
                        $attributes[$this->numberValid . '-message'] = $this->helper->translate("Please enter number");

                        break;
                    case 'digits':
                        $attributes[$this->digitsValid] = "true";
                        break;
                    case 'date':
                        $attributes[$this->dateValid] = "true";
                        if (isset($value['format'])) {
                            $attributes[$this->dateValid . '-format'] = $value['format'];
                        }
                        if (isset($value['min'])) {
                            $attributes[$this->dateValid . '-min'] = $value['min'];
                        }
                        if (isset($value['max'])) {
                            $attributes[$this->dateValid . '-max'] = $value['max'];
                        }
                        break;
                    case 'identical':
                        $attributes[$this->identicalValid] = "true";
                        if (isset($value['field'])) {
                            $attributes[$this->identicalValid . '-field'] = $value['field'];
                        }
                        break;
                    case 'remote':
                        $attributes[$this->remoteValid] = "true";
                        if (isset($value['field'])) {
                            $attributes[$this->remoteValid . '-field'] = $value['field'];
                        }
                        if (isset($value['message'])) {
                            $attributes[$this->remoteValid . '-message'] = $value['message'];
                        }
                        if (isset($value['url'])) {
                            $attributes[$this->remoteValid . '-url'] = $value['url'];
                        }
                        break;
                    default :
                        break;
                }
            }
            unset($attributes['validations']);
        }
        switch ($typeElement) {
            case 'Date':
                $element = (new Date($name, $attributes))->setLabel($label);
                break;
            case 'Number':
                $element = (new Numeric($name, $attributes))->setLabel($label);
                break;
            case 'Email':
                $element = (new Email($name, $attributes))->setLabel($label);
                break;

            case 'Select':
                if (isset($attributes['useEmpty']) && !$attributes['useEmpty']) {

                } else {
                    $attributes['useEmpty'] = true;
                    $attributes['emptyText'] = $this->helper->translate('Chọn') . ' ' . $label_explode;
                }
                $element = (new Select($name, $value, $attributes))->setLabel($label);
                break;
            case 'Search':
                $element = (new Search($name, $value, $attributes))->setLabel($label);
                break;
            case 'TextArea':
                $element = (new TextArea($name, $attributes))->setLabel($label);
                break;
//            case 'Select':
//                $element = (new Select($name, $attributes))->setLabel($label);
//                break;
            case 'Hidden':
                $element = new Hidden($name, $attributes);
                break;
            case 'Password':
                $element = (new Password($name, $attributes))->setLabel($label);
                break;
            case 'Check':
                unset($attributes['class']);
                $element = (new Check($name, $attributes))->setLabel($label);
                break;
            case 'File':
                $attributes['class'] = "";
                $element = (new File($name, $attributes))->setLabel($label);
                break;
            default :
                $element = (new Text($name, $attributes))->setLabel($label);
        }
        if (isset($validation)) {
            foreach ($validation as $key => $value) {
                switch ($key) {
                    case 'number':
                        $element->addValidator(new Numericality([
                            'message' => $this->helper->translate($value['message'])
                        ]));
                }
            }
        }

        return $element;
    }

}
