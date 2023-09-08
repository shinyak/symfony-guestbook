<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HogeType extends AbstractType
{
    const LOG_FILE = '/Users/skanno/project/etc/guestbook/var/log/form_event.log';

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('hoge_requires_fuga', ChoiceType::class, [
                'label' => 'fuga必須',
                'choices' => [
                    'はい' => 'yes',
                    'いいえ' => 'no'
                ],
                'expanded' => true,
            ])
            ->add('fuga', FugaType::class, [
                    'no_submit' => true,
                    'default_requirement' => false,
                ]
            )
            ->add('hoge_submit', SubmitType::class)
        ;

        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $this->log('PRE_SUBMIT');
            $inputData = $event->getData();
            $form = $event->getForm();

            // イベント起動時点ではフォームがbuild済みなので
            // 入力必須かどうかのオプションを指定しつつ要素を追加し直す
            $form->remove('fuga');
            $form->add('fuga', FugaType::class, [
                'no_submit' => true,
                'default_requirement' => $inputData['hoge_requires_fuga'] === 'yes',
            ]);
        });




        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $this->log('PRE_SET_DATA');
        });
        $builder->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) {
            $this->log('POST_SET_DATA');
        });
        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
            $this->log('SUBMIT');
        });
        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $this->log('POST_SUBMIT');
        });
    }

    private function log(string $message): void
    {
        file_put_contents(
            self::LOG_FILE,
            date('H:i:s') . " " . $message . "\n"
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
