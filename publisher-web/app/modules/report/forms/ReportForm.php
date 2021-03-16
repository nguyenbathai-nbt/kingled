<?php


namespace Publisher\Modules\Report\Forms;

use Publisher\Common\Models\Bill\Product;
use Publisher\Common\Mvc\Form\Form;

class ReportForm extends Form
{
    public function initialize()
    {

    }

    public function index()
    {
        $this->add(Form::addElement('name', 'Tên chuyền', 'Text', ['required' => true]));
        $this->add(Form::addElement('code', 'Mã', 'Text', ['required' => true]));

    }

    public function viaMonth()
    {
        $this->add(Form::addElement('month', 'Tháng', 'Select', ['data-type' => 'select2', 'using' => ['id', 'name']], [
            '01'=>'01',
            '02'=>'02',
            '03'=>'03',
            '04'=>'04',
            '05'=>'05',
            '06'=>'06',
            '07'=>'07',
            '08'=>'08',
            '09'=>'09',
            '10'=>'10',
            '11'=>'11',
            '12'=>'12',
        ]));
        $this->add(Form::addElement('year', 'Năm', 'Text'));
    }
    public function viaProduct()
    {
        $this->add(Form::addElement('product_id', 'Tên sản phẩm', 'Select', ['data-type' => 'select2', 'using' => ['id', 'name']], Product::find()));

    }
    public function viaMonthProduct()
    {
        $this->add(Form::addElement('month', 'Tháng', 'Select', ['data-type' => 'select2', 'using' => ['id', 'name']], [
            '01'=>'01',
            '02'=>'02',
            '03'=>'03',
            '04'=>'04',
            '05'=>'05',
            '06'=>'06',
            '07'=>'07',
            '08'=>'08',
            '09'=>'09',
            '10'=>'10',
            '11'=>'11',
            '12'=>'12',
        ]));
        $this->add(Form::addElement('year', 'Năm', 'Text'));
        $this->add(Form::addElement('product_id', 'Tên sản phẩm', 'Select', ['data-type' => 'select2', 'using' => ['id', 'name']], Product::find()));

    }

}