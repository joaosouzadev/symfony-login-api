<?php


namespace App\DoctrineExtensions;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Entity\Curso;
use App\Entity\Segmento;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class InstituicaoExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null): void
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, string $operationName = null, array $context = []): void
    {
        // $this->addWhere($queryBuilder, $resourceClass);
    }

    private function addWhere(QueryBuilder $queryBuilder, string $resourceClass): void
    {
        if (Segmento::class === $resourceClass || Curso::class === $resourceClass) {

            if (!$this->security->getUser()) {
                throw new NotFoundHttpException('Usuário não logado');
            }

            $instituicoes = $this->security->getUser()->getInstituicoes();
            if (count($instituicoes) > 0) {
                $rootAlias = $queryBuilder->getRootAliases()[0];

                $string = '';
                $i = 1;
                foreach ($instituicoes as $instituicao) {
                    $string .= "$rootAlias.instituicao = :instituicao_$i or ";
                    $i++;
                }

                $string = rtrim($string, ' or ');
                $queryBuilder->andWhere($string);

                $i = 1;
                foreach ($instituicoes as $instituicao) {
                    $queryBuilder->setParameter("instituicao_$i", $instituicao->getId());
                    $i++;
                }

            } else {
                throw new NotFoundHttpException('Não há instituições cadastradas');
            }
        }
    }
}