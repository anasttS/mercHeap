<?php

use App\Entity\OrderUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name', TextType::class, ['label' => 'First_name'])
            ->add('last_name', TextType::class, ['label' => 'Last_name'])
            ->add('address', TextType::class, ['label' => 'Address'])
//            ->add('shopLists', CollectionType::class, ['label' => 'ShopLists'])
            ->add('country', TextType::class, ['label'=>'Country'])
            ->add('city', TextType::class, ['label' => 'City'])
            ->add('zip', IntegerType::class, ['label' => 'Zip'])
            ->add('phone_number', IntegerType::class, ['label'=>'Phone_number']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => OrderUser::class,
        ));
    }
}