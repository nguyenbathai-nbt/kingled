<?php


namespace Publisher\Modules\Bill\Forms;



use Publisher\Common\Models\Bill\Conveyors;
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

    public function searchbill()
    {
        $this->add(Form::addElement('code_bill', 'Mã lệnh sản xuất', 'Text', ['required' => true]));
        $this->add(Form::addElement('time_start', 'Thời gian', 'Date', ['required' => true]));
    }

    public function editbill()
    {
        $this->add(Form::addElement('name', 'Lệnh sản xuất', 'Text', ['required' => true,'readonly' => true]));
        $this->add(Form::addElement('quantity', 'Số lượng', 'Text', ['required' => true]));
        $this->add(Form::addElement('status_id', 'Trạng thái', 'Select', ['required' => true, 'data-type' => 'select2', 'using' => ['id', 'name']], Status::find()));
        $this->add(Form::addElement('product_id', 'Mã sản phẩm', 'Select', ['required' => true, 'data-type' => 'select2', 'using' => ['id', 'code']], Product::find()));
        $this->add(Form::addElement('product_name', 'Tên sản phẩm', 'Text', ['readonly' => true]));
        $this->add(Form::addElement('conveyor_id', 'Chuyền', 'Select', ['readonly' => true, 'data-type' => 'select2', 'using' => ['id', 'code']], Conveyors::find()));
        $this->add(Form::addElement('priority', 'Độ ưu tiên', 'Select', ['required' => true, 'data-type' => 'select2', 'using' => ['id', 'name']], [1=>'1',2=>'2',3=>'3',4=>'4',5=>'5']));
        $this->add(Form::addElement('description', 'Mô tả', 'TextArea'));
        $this->add(Form::addElement('note', 'Ghi chú', 'TextArea'));
    }
    public function createbill()
    {
        $this->add(Form::addElement('name', 'Lệnh sản xuất', 'Text', ['required' => true,'readonly' => true]));
        $this->add(Form::addElement('quantity', 'Số lượng', 'Text', ['required' => true]));
        $this->add(Form::addElement('status_id', 'Trạng thái', 'Select', ['required' => true, 'data-type' => 'select2', 'using' => ['id', 'name']], Status::find()));
        $this->add(Form::addElement('product_id', 'Mã sản phẩm', 'Select', ['required' => true, 'data-type' => 'select2', 'using' => ['id', 'code']], Product::find()));
        $this->add(Form::addElement('product_name', 'Tên sản phẩm', 'Text', ['readonly' => true]));
        $this->add(Form::addElement('conveyor_id', 'Chuyền', 'Select', ['readonly' => true, 'data-type' => 'select2', 'using' => ['id', 'code']], Conveyors::find()));
        $this->add(Form::addElement('priority', 'Độ ưu tiên', 'Select', ['required' => true, 'data-type' => 'select2', 'using' => ['id', 'name']], [1=>'1',2=>'2',3=>'3',4=>'4',5=>'5']));
        $this->add(Form::addElement('description', 'Mô tả', 'TextArea'));
        $this->add(Form::addElement('note', 'Ghi chú', 'TextArea'));
    }

    public function importbill() {
        $auth = $this->session->get('auth');
        $this->add(Form::addElement('import', 'Choose File (.xls file)', 'File', ['validations' => ['required' => true, 'file' => ['extension' => 'xls']]]));
    }

}