<?php

namespace App\Form\Photo;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Image;

class PhotoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
      ->add('imageFile', FileType::class, [
        'mapped' => false,
        'constraints' => [
          new Image([
            'maxSize' => '5M',
          ]),
        ],
      ])
      ->add('directory', TextType::class, [
        'required' => false,
      ])
      ->add('uploader', TextType::class);
    }
}
