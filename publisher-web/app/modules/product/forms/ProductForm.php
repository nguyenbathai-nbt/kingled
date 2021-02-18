<?php


namespace Publisher\Modules\Product\Forms;


use AcademicAffairs\Model\OutcomePeriod;
use Publisher\Common\Mvc\Form\Form;

class ProductForm extends Form
{
    public function initialize()
    {

    }

    public function createproduct()
    {
        $this->add(Form::addElement('name', 'Tên sản phẩm', 'Text', ['required' => true]));
        $this->add(Form::addElement('code', 'Mã sản phẩm', 'Text', ['required' => true]));
        $this->add(Form::addElement('description', 'Mô tả', 'Text'));

    }
    public function importproduct() {
        $auth = $this->session->get('auth');
        $this->add(Form::addElement('import', 'Choose File (.xls file)', 'File', ['validations' => ['required' => true, 'file' => ['extension' => 'xls']]]));
    }



    public function searchRecipient()
    {

    }

}