<?php
namespace MyApp\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

class UpdateUser extends AbstractType{
	 public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('username', "text",  array("attr"=>array("placeholder"=>"username")));
        $builder->add('email', "email", array("attr" => array("placeholder" => "email")));
        $builder->add('firstname', "text");
        $builder->add('lastname', "text");
        $builder->add('password_repeated', 'repeated', array(
            'type' => 'password',
            'invalid_message' => 'The password fields must match.',
            'options' => array('required' => true),
            'first_options' => array('label' => 'Password'),
            'second_options' => array('label' => 'Repeat Password'),
        ));
        $builder->add("agreement", 'checkbox', array('label' => "I agree with the condition of use"));
    }

    public function getName() {
        return "updateuser";
    }
}
