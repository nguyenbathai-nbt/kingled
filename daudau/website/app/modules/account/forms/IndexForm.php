<?php

namespace Daudau\Modules\Account\Forms;


use Daudau\Common\Models\Recipe\Quantitative;
use Daudau\Common\Models\Recipe\RawMaterial;
use Daudau\Common\Mvc\Form\Form;

class IndexForm extends Form
{
    public function initialize()
    {

    }

    public function search()
    {
        $this->add(Form::addElement('name', 'Name', 'Text'));
        $this->add(Form::addElement('code', 'Code', 'Text'));
    }

    public function create()
    {
        $this->add(Form::addElement('raw-material', 'Raw material', 'Select', ['name'=>'raw-material[]','required' => true, 'date-type' => 'select2','using'=>['id','code']],RawMaterial::find()));
        $this->add(Form::addElement('quantitative', 'Quantitative', 'Select', ['name'=>'quantitative[]','required' => true,'date-type' => 'select2','using'=>['id','code']],Quantitative::find()));
        $this->add(Form::addElement('number', 'Number', 'Text', ['name'=>'number[]','required' => true]));

    }

    public function edit()
    {
        $this->add(Form::addElement('name', 'Name', 'Text', ['required' => true]));
        $this->add(Form::addElement('code', 'Code', 'Text', ['required' => true]));

    }

    public function view()
    {
        $this->add(Form::addElement('name', 'Name', 'Text', ['required' => true, 'readonly' => true]));
        $this->add(Form::addElement('code', 'Code', 'Text', ['required' => true, 'readonly' => true]));

    }
}