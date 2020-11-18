<?php
namespace Daudau\Modules\Admin\Forms;


use Daudau\Common\Models\Users\Role;
use Daudau\Common\Models\Users\Status;
use Daudau\Common\Mvc\Form\Form;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
class StatusForm extends Form
{
    public function initialize()
    {

    }
    public function search()
    {
        $this->add(Form::addElement('name', 'Tên', 'Text'));
        $this->add(Form::addElement('code', 'Mã số', 'Text'));
    }

    public function create()
    {
        $this->add(Form::addElement('name', 'Tên', 'Text', ['required' => true]));
        $this->add(Form::addElement('code', 'Mã số', 'Text', ['required' => true]));

    }

    public function edit()
    {
        $this->add(Form::addElement('name', 'Tên', 'Text', ['required' => true]));
        $this->add(Form::addElement('code', 'Mã số', 'Text', ['required' => true]));

    }

    public function view()
    {
        $this->add(Form::addElement('name', 'Tên', 'Text', ['required' => true, 'readonly' => true]));
        $this->add(Form::addElement('code', 'Mã số', 'Text', ['required' => true, 'readonly' => true]));

    }
}