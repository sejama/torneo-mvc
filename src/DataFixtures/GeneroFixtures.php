<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use App\Entity\Genero;

class GeneroFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $genero = new Genero();
        $genero->setId(1);
        $genero->setNombre('Femenino');
        $manager->persist($genero);

        $genero = new Genero();
        $genero->setId(2);
        $genero->setNombre('Masculino');
        $manager->persist($genero);

        // Forzar para especificar un ID
        $metadata = $manager->getClassMetaData(Genero::class);
        $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $manager->flush();
    }
}
