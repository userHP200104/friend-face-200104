<?php

    namespace App\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\PasswordType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    //Controller that builds our Register Form
    class UserProfileType extends AbstractType 
    {
        //function that executes the build
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('username', TextType::class) //add each individual form fields and buttons while building
                ->add('email', EmailType::class)
                ->add('password', PasswordType::class)
                ->add('submit', SubmitType::class, ['label' => "Register"]);
        }
    }

?>