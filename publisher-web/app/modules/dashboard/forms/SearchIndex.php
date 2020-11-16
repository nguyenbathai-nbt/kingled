<?php


namespace Publisher\Modules\Dashboard\Forms;


use Publisher\Common\Models\Customer\Customers;
use Publisher\Common\Mvc\Form\Form;
use Publisher\Modules\Ec2\Models\Instances;

class SearchIndex extends Form
{

    public function initialize()
    {
      //  $this->add(Form::addElement('customer_id', 'Select customer', 'Select',['data-type' => 'select2','class'=>'label-input-in-line','using'=>['id','org_name']],Customers::find()));
     //   $this->add(Form::addElement('instance_id', 'Select instance', 'Select',['data-type' => 'select2','class'=>'label-input-in-line','using'=>['public_ip','url']],[]));

    }
}