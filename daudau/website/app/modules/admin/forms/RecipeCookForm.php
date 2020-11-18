<?php


namespace Daudau\Modules\Admin\Forms;


use Daudau\Common\Models\Bookmark\CategoryType;
use Daudau\Common\Models\Recipe\Quantitative;
use Daudau\Common\Models\Users\Status;
use Daudau\Common\Mvc\Form\Form;

class RecipeCookForm extends Form
{

    public function initialize()
    {

    }

    public function search()
    {

    }


    public function edit()
    {
        $this->add(Form::addElement('name', 'Tên', 'Text', ['required' => true]));
        $this->add(Form::addElement('code', 'Mã số', 'Text', ['required' => true]));
        $this->add(Form::addElement('level', 'Cấp độ', 'Text', ['required' => true]));
        $this->add(Form::addElement('time_do', 'Thời gian', 'Number', ['required' => true]));
        $this->add(Form::addElement('link_video', 'Link Video', 'Text'));
        $this->add(Form::addElement('link_share', 'Link chia sẻ', 'Text', ['required' => true]));
        $this->add(Form::addElement('description', 'Mô tả', 'Text', ['required' => true]));
        $this->add(Form::addElement('status_id', 'Trạng thái', 'Select', ['required' => true, 'date-type' => 'select2', 'using' => ['id', 'name']], Status::find()));
    }

    public function create()
    {
        $this->add(Form::addElement('name', 'Name', 'Text', ['required' => true]));
        $this->add(Form::addElement('code   ', 'Code', 'Text', ['required' => true]));
        $this->add(Form::addElement('type_id', 'category Type', 'Select', [ 'data-type' => 'select2', 'using' => ['id', 'code']], CategoryType::find()));
        $this->add(Form::addElement('status_id', 'Status', 'Select', ['required' => true, 'date-type' => 'select2', 'using' => ['id', 'name']], Status::find()));
    }

    public function delete()
    {

    }
}