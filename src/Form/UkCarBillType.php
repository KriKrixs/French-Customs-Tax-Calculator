<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UkCarBillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('buyDate', DateType::class, ["label" => "Date d'achat", "widget" => "single_text",])
            ->add('sellerName', TextType::class, ["label" => "Nom du vendeur"])
            ->add('sellerAddress', TextType::class, ["label" => "Adresse du vendeur"])
            ->add('buyerName', TextType::class, ["label" => "Nom de l'acheteur"])
            ->add('buyerAddress', TextType::class, ["label" => "Adresse de l'acheteur"])
            ->add('carBrand', TextType::class, ["label" => "Marque"])
            ->add('carModel', TextType::class, ["label" => "Modèle"])
            ->add('carYear', IntegerType::class, ["label" => "Année de la première immatriculation"])
            ->add('carColor', TextType::class, ["label" => "Couleur (en anglais !)"])
            ->add('carRegistration', TextType::class, ["label" => "Immatriculation"])
            ->add('carMileage', IntegerType::class, ["label" => "Kilomètrage (en miles !)"])
            ->add('carVIN', TextType::class, ["label" => "VIN"])
            ->add('carPrice', IntegerType::class, ["label" => "Prix (en Livres sterling !)"])
            ->add('submit', SubmitType::class, ["label" => "Générer la facture"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
