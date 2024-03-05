<?php

namespace App\DataFixtures;

use App\Entity\Oeuvre;
use App\Entity\Serie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OeuvreFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i < 20; $i++) {
            $oeuvre = new Oeuvre();
            $oeuvre->setName('Oeuvre '.$i);
            $oeuvre->setImage('https://picsum.photos/id/'.rand(50, 100).'/400/600');
            $oeuvre->setSize(mt_rand(10, 100));
            $oeuvre->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

            $oeuvre->SetSerie($this->getReference('serie_' . rand(1, 5)));
            $oeuvre->addTag($this->getReference('tag_' . rand(1, 10)));

            $manager->persist($oeuvre);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            SerieFixture::class
        ];
    }
}

