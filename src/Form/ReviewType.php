<?php

namespace App\Form;

use App\Entity\Movie;
use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Twig\Environment;

class ReviewType extends AbstractType
{
    private $twig;
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $listener = function (FormEvent $event) {
            // $event->getData() permet de recuperer les données du formulaire
            // dd($event->getData());
            //$this->twig->addGlobal("newUser", $event->getData()["username"]);
            // On pourrait apeller un service qui envoie un mail qui dit que un nouvel utilisateur a été crée 
        };
        $builder
            ->add('username', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Courriel'
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Critique'
            ])
            ->add('rating', ChoiceType::class, [
                'choices'  => [
                    'Excellent' => 5,
                    'Très bon' => 4,
                    'Bon' => 3,
                    'Peut mieux faire' => 2,
                    'A éviter' => 1,
                ],
                'placeholder' => 'Votre choix ...'
            ])
            ->add('reactions', ChoiceType::class, [
                'choices'  => [
                    'Rire' => 'smile',
                    'Pleurer' => 'cry',
                    'Réfléchir' => 'think',
                    'Dormir' => 'sleep',
                    'Rever' => 'dream',
                ],
                'placeholder' => 'Votre choix ...',
                // Les reactions sont un tableau, donc plusieurs choix possibles (plusieurs reactions)
                'multiple' => true,
                'expanded' => true
                ])
            ->add('watchedAt', DateType::class, [
                'label' => 'Vous avez vu ce film le ...'
            ])
            // movie pas necessaire car présent dans l'url (on l'a deja)
//             ->add('movie', EntityType::class, [
//                 'class' => Movie::class,
// 'choice_label' => 'id',
//             ])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'save'],
            ])
            ->addEventListener(FormEvents::PRE_SUBMIT, $listener);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
