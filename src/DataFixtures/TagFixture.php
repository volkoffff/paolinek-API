<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $tag = new Tag();
            $tag->setName('tag '.$i);
            
            $this->addReference('tag_' . $i, $tag);

            $manager->persist($tag);
        }

        $manager->flush();
    }
}
