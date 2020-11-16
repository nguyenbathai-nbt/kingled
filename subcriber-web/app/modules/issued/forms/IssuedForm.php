<?php


namespace Publisher\Modules\Issued\Forms;


use Publisher\Common\Mvc\Form\Form;

class IssuedForm extends Form
{
    public function initialize()
    {

    }

    public function createbadge()
    {
        $this->add(Form::addElement('badge_name', 'Badge name', 'Text', array_merge(['required' => true], $options)));
        $this->add(Form::addElement('badge_code', 'Badge code', 'Text', array_merge(['required' => true, 'validations' => ['pattern' => ['regexp' => '^(?!.*-_)(?!.*__)(?!.*--)(?!.*_-)^([A-Za-z0-9][A-Za-z0-9]*[A-Za-z0-9]|[A-Za-z0-9]*)$', 'message' => 'The site name must in a-z, A-Z, 0-9.']]], $options)));
        $this->add(Form::addElement('criteria', 'Criteria', 'Text', array_merge(['required' => true, 'validations' => ['pattern' => ['regexp' => '^(?!.*-_)(?!.*__)(?!.*--)(?!.*_-)^([A-Za-z0-9][A-Za-z0-9]*[A-Za-z0-9]|[A-Za-z0-9]*)$', 'message' => 'The site name must in a-z, A-Z, 0-9.']]], $options)));
        $this->add(Form::addElement('website', 'Website', 'Text', array_merge(['required' => true, 'validations' => ['pattern' => ['regexp' => '^(?!.*-_)(?!.*__)(?!.*--)(?!.*_-)^([A-Za-z0-9][A-Za-z0-9]*[A-Za-z0-9]|[A-Za-z0-9]*)$', 'message' => 'The site name must in a-z, A-Z, 0-9.']]], $options)));

    }

}