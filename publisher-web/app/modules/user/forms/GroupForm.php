<?php


namespace Publisher\Modules\Group\Forms;


use Publisher\Common\Mvc\Form\Form;

class GroupForm extends Form
{
    public function initialize()
    {

    }

    public function creategroup()
    {
        $this->add(Form::addElement('group_name', 'Group name', 'Text', ['required' => true]));
        $this->add(Form::addElement('import', 'Upload image (20KB size .png or .svg images are acceptable) ', 'File', ['validations' => ['required' => true, 'file' => ['extension' => 'xls']]]));
        $this->add(Form::addElement('description', 'Description', 'Text', ['required' => true]));
        $this->add(Form::addElement('default_url', 'Default url', 'Text', ['required' => true, 'validations' => ['pattern' => ['regexp' => '^(https?|http)://[^\s/$.?#].[^\s]*[^.]$', 'message' => 'The site name must in a-z, A-Z, 0-9.']]]));

    }

    public function editgroup()
    {
        $this->add(Form::addElement('group_name', 'Group name', 'Text', ['required' => true]));
        $this->add(Form::addElement('import', 'Upload image', 'File', ['validations' => ['file' => ['extension' => 'xls']]]));
        $this->add(Form::addElement('description', 'Description', 'Text', ['required' => true]));
        $this->add(Form::addElement('default_url', 'Default url', 'Text', ['required' => true, 'validations' => ['pattern' => ['regexp' => '^(https?|http)://[^\s/$.?#].[^\s]*[^.]$', 'message' => 'The site name must in a-z, A-Z, 0-9.']]]));
    }

    public function searchRecipient()
    {

    }

}