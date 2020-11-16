<?php

namespace Daudau\Modules\Recipecook\Forms;


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
        $this->add(Form::addElement('raw_material', 'Nguyên liệu', 'Text', ['name'=>'raw_material[]','class'=>'raw_material','required' => true]));
        $this->add(Form::addElement('quantitative', 'Định lượng', 'Text', ['name'=>'quantitative[]','class'=>'quantitative','required' => true]));
        $this->add(Form::addElement('number', 'Number', 'Số lượng', ['name'=>'number[]','required' => true]));

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