<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class FugaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fuga_text', TextType::class, [
                'required' => $options['fuga_required'],
//                'constraints' => [
//                    new Assert\Callback([$this, 'validateFugaText'])
//                ],
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
            'fuga_required'=> false,
        ]);
    }

//    public function validateFugaText($value, ExecutionContextInterface $context)
//    {
//        // fuga_text <- fugaフォーム <- hogeフォーム 親をたどってhogeフォームを取得
//        $hoge_form = $context->getObject()->getParent()->getParent();
//        $fuga_text = $context->getObject();
//
//        if('yes' !== $hoge_form->get('hoge_requires_fuga')->getData()) {
//            return;
//        }
//
//        if (empty($fuga_text->getData())) {
//            $context
//                ->buildViolation('fuga_textの入力必須が選択されています')
//                ->addViolation();
//        }
//    }
}
