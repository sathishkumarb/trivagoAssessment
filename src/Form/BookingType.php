<?php
namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Booking;
class BookingType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
    ->add('hotelname')
    ->add('price', MoneyType::class)
    ->add('rating', IntegerType::class)
    ->add('location')
    ->add('category')
    ->add('image')
    ->add('reputation', IntegerType::class)
    ->add('save', SubmitType::class)
    ;
  }
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => Booking::class,
      'csrf_protection' => false
    ));
  }
}