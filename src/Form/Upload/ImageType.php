<?php

namespace App\Form\Upload;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ImageType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('name')
      ->add('description', TextareaType::class)
      ->add('imageFile', VichImageType::class, [
        'required' => true,
        'allow_delete' => false,
      ]);
  }
}
