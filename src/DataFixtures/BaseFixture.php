<?php


namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

abstract class BaseFixture extends Fixture
{
    /** @var ObjectManager */
    private $manager;
    /** @var Generator */
    protected $faker;

    // Méthode à implémenter par les classes enfants
    // dans laquelle générer les fausses données

    abstract protected function loadData(ObjectManager $manager);

    // Méthode imposée par Doctrine

    public function load(ObjectManager $manager)
    {
        // Enregistrement du Manager et instanciation de faker
        $this->manager = $manager;
        $this->faker = factory::create('fr_FR');

        //Appel de la méthode pour générer les données
        $this->loadData($manager);
    }

    /**
     * Créer plusieurs entités
     * @param int $count  nombre d'entités à créer
     * @param callable $factory  fonction pour créer une entité
     */
    protected function createMany(int $count, callable $factory)
    {
        // Exécuter $factory $count fois
        for ($i = 0; $i < $count; $i++){
            // la $factory doit retourner l'entité créée
            $entity = $factory($i);

            if ($entity === null){
                throw new \LogicException('Tu as oublié de retourner l\'entité');
            }
            // Avertir Doctrine pour l'enregistrement de l'entité
            $this->manager->persist($entity);

            //Ajouter une référence pour l'entité
            $this->addReference(sprintf('%s_%d', $groupName,$i),$entity);

        }
    }

    /**
     * Obtenir une entité aléatoire d'un groupe
     */
    protected function getRandomReference(string $groupName)
    {
        // Si les references ne sont pas présentes dans la propriété
        if (!isset($this->references[$groupName])){
            //Récupération des références
            foreach($this->referenceRepository->getReferences()as $key =>$ref){
                if(strpos($key, $groupName . '_') === 0) {
                    $this->references[groupName][] = $ref;
                }
            }
        }

        //Retourner une référence aléatoire
        $randomReferenceKey = $this->faker->randomElement($this->references[$groupName]);
        return $this->getReference($randomReferenceKey);
    }
}