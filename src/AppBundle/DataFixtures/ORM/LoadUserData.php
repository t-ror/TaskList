<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 27.2.18
 * Time: 20:41
 */
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface {
    private $container;
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@admin.com');
        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($user, 'abcd');
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();
    }

    /**
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}