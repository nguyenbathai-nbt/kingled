<?php


namespace Publisher\Modules\Bill\Forms;


use Publisher\Common\Models\Bill\Conveyor;
use Publisher\Common\Models\Bill\Producer;
use Publisher\Common\Models\Bill\Product;
use Publisher\Common\Models\Users\Status;
use Publisher\Common\Mvc\Form\Form;

class BillForm extends Form
{
    public function initialize()
    {

    }

    public function createissuer()
    {
        $this->add(Form::addElement('username', 'Username', 'Text', ['required' => true]));
        $this->add(Form::addElement('password', 'Password', 'Password', ['required' => true]));
        $this->add(Form::addElement('email', 'Email', 'Email', ['required' => true]));
    }


    public function editbill()
    {
        $this->add(Form::addElement('name', 'Tên', 'Text', ['required' => true, 'readonly' => true]));
        $this->add(Form::addElement('code', 'Mã', 'Text', ['required' => true, 'readonly' => true]));
        $this->add(Form::addElement('quantity', 'Số lượng', 'Text', ['required' => true,'readonly' => true]));
        $this->add(Form::addElement('status_id', 'Trạng thái', 'Select', ['required' => true, 'data-type' => 'select2', 'using' => ['id', 'name']], Status::find()));
        $this->add(Form::addElement('product_id', 'Sản phẩm', 'Select', ['required' => true, 'readonly' => true,'readonly' => true, 'data-type' => 'select2', 'using' => ['id', 'code']], Product::find()));
        $this->add(Form::addElement('conveyor_id', 'Chuyền', 'Select', ['required' => true, 'readonly' => true,'readonly' => true, 'data-type' => 'select2', 'using' => ['id', 'code']], Conveyor::find()));
        $this->add(Form::addElement('priority', 'Độ ưu tiên', 'Select', ['required' => true, 'data-type' => 'select2', 'using' => ['id', 'name']], [1=>'1',2=>'2',3=>'3',4=>'4',5=>'5']));
        $this->add(Form::addElement('description', 'Mô tả', 'TextArea', ['required' => true]));
        $this->add(Form::addElement('note', 'Ghi chú', 'TextArea', ['required' => true]));
    }
    public function createbill()
    {
        $this->add(Form::addElement('name', 'Tên', 'Text', ['required' => true]));
        $this->add(Form::addElement('code', 'Mã', 'Text', ['required' => true,'readonly' => true]));
        $this->add(Form::addElement('quantity', 'Số lượng', 'Text', ['required' => true]));
        $this->add(Form::addElement('status_id', 'Trạng thái', 'Select', ['required' => true, 'data-type' => 'select2', 'using' => ['id', 'name']], Status::find()));
        $this->add(Form::addElement('product_id', 'Sản phẩm', 'Select', ['required' => true, 'data-type' => 'select2', 'using' => ['id', 'code']], Product::find()));
        $this->add(Form::addElement('conveyor_id', 'Chuyền', 'Select', ['required' => true, 'readonly' => true,'readonly' => true, 'data-type' => 'select2', 'using' => ['id', 'code']], Conveyor::find()));
        $this->add(Form::addElement('priority', 'Độ ưu tiên', 'Select', ['required' => true, 'data-type' => 'select2', 'using' => ['id', 'name']], [1=>'1',2=>'2',3=>'3',4=>'4',5=>'5']));
        $this->add(Form::addElement('description', 'Mô tả', 'TextArea', ['required' => true]));
        $this->add(Form::addElement('note', 'Ghi chú', 'TextArea', ['required' => true]));
    }

}