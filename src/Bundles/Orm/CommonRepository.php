<?php

namespace Olla\Flow\Bundles\Orm;

use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Common\Util\Debug;

class CommonRepository  {

	protected $em;
	protected $class;
	protected $repository;

	public function __construct(ManagerRegistry $em) {
		$this->em = $em;
	}

	public function supports(string $resourceClass) {
		return false;
	}

	public function setClass(string $resourceClass) {
		$this->class = $resourceClass;
		return $this;
	}

	public function repository() {
		$manager = $this->em->getManagerForClass($this->class);
		$this->repository = $manager->getRepository($this->class);
		if (!method_exists($this->repository, 'createQueryBuilder')) {
			throw new \Exception('The repository class must have a "createQueryBuilder" method.');
		}
		return $this->repository;
	}

	public function get(array $args) {
		$queryBuilder = $this->repository()->createQueryBuilder('o');
		$rootAlias = $queryBuilder->getRootAliases()[0];
		$this->joinRelations($queryBuilder, $this->class, $rootAlias, 1);
		$queryBuilder->setFirstResult(1)->setMaxResults(10);
		$query = $queryBuilder->getQuery();
		return $query->getResult();
	}
	private function joinRelations(QueryBuilder $queryBuilder, string $resourceClass, string $parentAlias, $maxDepth) {
		
		if($maxDepth >= 3) {
			return;
		}
		$currenDepth = $maxDepth + 1;
		$entityManager = $queryBuilder->getEntityManager();
		$classMetadata = $entityManager->getClassMetadata($resourceClass);
		foreach ($classMetadata->associationMappings as $association => $mapping) {
			$isNullable = $mapping['joinColumns'][0]['nullable'] ?? true;

			if (true === $isNullable) {
				$method = 'leftJoin';
			} else {
				$method = 'innerJoin';
			}
			$associationAlias =  sprintf('%s_a%d', $association, $currenDepth);
			$columnAlias = sprintf('%s.%s', $parentAlias, $association);
		}

	}

	private function addSelect(QueryBuilder $queryBuilder, string $entity, string $associationAlias, array $propertyMetadataOptions = [])
	{
		$resourceMetadata = $this->metadataOperator->getResource($entity);
		$select = [];
		$entityManager = $queryBuilder->getEntityManager();
		$targetClassMetadata = $entityManager->getClassMetadata($entity);
		if ($targetClassMetadata->subClasses) {
			$queryBuilder->addSelect($associationAlias);
		} else {

			$properties = $resourceMetadata->getProperties();

			foreach ($properties as $property => $propertyMetadata) {
				if (true === $propertyMetadata->isIdentifier() || $property === 'id') {
					$select[] = $property;
					continue;
				}
				if($property !== 'name') {
					continue;
				}
                //the field test allows to add methods to a Resource which do not reflect real database fields
				if ($targetClassMetadata->hasField($property) && $propertyMetadata->isReadable()) {
					$select[] = $property;
				}

				if (array_key_exists($property, $targetClassMetadata->embeddedClasses)) {
              
                }
            }
            $queryBuilder->addSelect(sprintf('partial %s.{%s}', $associationAlias, implode(',', $select)));
        }
    }
}