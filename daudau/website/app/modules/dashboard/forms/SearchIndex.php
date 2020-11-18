<?php


namespace Daudau\Modules\Dashboard\Forms;


use Daudau\Common\Models\Customer\Customers;
use Daudau\Common\Mvc\Form\Form;
use Daudau\Modules\Ec2\Models\Instances;

class SearchIndex extends Form
{

    public function initialize()
    {
      //  $this->add(Form::addElement('customer_id', 'Select customer', 'Select',['data-type' => 'select2','class'=>'label-input-in-line','using'=>['id','org_name']],Customers::find()));
     //   $this->add(Form::addElement('instance_id', 'Select instance', 'Select',['data-type' => 'select2','class'=>'label-input-in-line','using'=>['public_ip','url']],[]));

    }
}