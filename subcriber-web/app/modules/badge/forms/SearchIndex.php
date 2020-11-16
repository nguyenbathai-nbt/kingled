<?php


namespace Subscriber\Modules\Badge\Forms;


use Subscriber\Common\Models\Customer\Customers;
use Subscriber\Common\Mvc\Form\Form;
use Subscriber\Modules\Ec2\Models\Instances;

class SearchIndex extends Form
{

    public function initialize()
    {
      //  $this->add(Form::addElement('customer_id', 'Select customer', 'Select',['data-type' => 'select2','class'=>'label-input-in-line','using'=>['id','org_name']],Customers::find()));
     //   $this->add(Form::addElement('instance_id', 'Select instance', 'Select',['data-type' => 'select2','class'=>'label-input-in-line','using'=>['public_ip','url']],[]));

    }
}