<?php


namespace App\Doctrine;


use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Entity\Account;
use App\Entity\User;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Security;

class CurrentUserExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{
    public function __construct(private Security $security){}

    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, string $operationName = null, array $context = [])
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    private function addWhere(QueryBuilder $queryBuilder, string $resourceClass)
    {
        $entities = [Account::class];

        /** @var User $user */
        $user = $this->security->getUser();

        if(!in_array($resourceClass, $entities) || null == $user) {
            return;
        }

        $rootAlias = $queryBuilder->getRootAliases()[0];

        switch ($resourceClass) {
            case Account::class:
                $this->account($queryBuilder, $user, $rootAlias);
                break;
        }
    }

    private function account(QueryBuilder $queryBuilder, User $user, string $rootAlias): void
    {
        $queryBuilder
            ->innerJoin(sprintf('%s.users', $rootAlias), 'u')
            ->andWhere('u.id = :current_user')
            ->setParameter('current_user', $user->getId())
        ;
    }
}