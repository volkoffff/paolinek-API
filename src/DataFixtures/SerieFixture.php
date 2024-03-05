<?php

namespace App\DataFixtures;

use App\Entity\Serie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SerieFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i <= 5; $i++) {
            $serie = new Serie();
            $serie->setName('Serie Collecion '.$i);
            $manager->persist($serie);

            $this->addReference('serie_' . $i, $serie);
        }

        $manager->flush();
    }
}
