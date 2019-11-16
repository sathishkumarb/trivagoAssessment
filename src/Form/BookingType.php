<?php
namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
        ->add('zipcode', IntegerType::class)
        ->add('city', TextType::class, ['required'=>false])
        ->add('address', TextType::class, ['required'=>false])
        ->add('country', TextType::class, ['required'=>false])
    ->add('category')
    ->add('image', UrlType::class, [
                'default_protocol' => 'https',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'https://domain.com',
                    'pattern' => '^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$'
                ]
            ])
    ->add('reputation', IntegerType::class)
    ->add('availability', IntegerType::class)
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