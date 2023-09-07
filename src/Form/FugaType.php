<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class FugaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // オプションdefault_requirementによって入力必須かどうかを変更する
        $builder
            ->add('fuga_text', TextType::class, [
                'required' => $options['default_requirement'],
                'constraints' => $options['default_requirement'] ? [new NotBlank(),] : [],
            ])
        ;

        if (! $options['no_submit']) {
            $builder->add('fuga_submit', SubmitType::class);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'no_submit' => false,
            'default_requirement' => true,
        ]);
    }
}
