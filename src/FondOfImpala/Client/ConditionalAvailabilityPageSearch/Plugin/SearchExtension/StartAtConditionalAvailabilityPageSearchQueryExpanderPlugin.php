<?php

namespace FondOfImpala\Client\ConditionalAvailabilityPageSearch\Plugin\SearchExtension;

use DateTime;
use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\Range;
use FondOfImpala\Shared\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchConstants;
use Generated\Shared\Search\ConditionalAvailabilityPeriodIndexMap;
use InvalidArgumentException;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

class StartAtConditionalAvailabilityPageSearchQueryExpanderPlugin extends AbstractPlugin implements QueryExpanderPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface $searchQuery
     * @param array $requestParameters
     *
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    public function expandQuery(QueryInterface $searchQuery, array $requestParameters = []): QueryInterface
    {
        if (!isset($requestParameters[ConditionalAvailabilityPageSearchConstants::PARAMETER_START_AT])) {
            return $searchQuery;
        }

        $startAt = new DateTime($requestParameters[ConditionalAvailabilityPageSearchConstants::PARAMETER_START_AT]);
        $boolQuery = $this->getBoolQuery($searchQuery->getSearchQuery());

        $startAtRange = (new Range())->addField(
            ConditionalAvailabilityPeriodIndexMap::START_AT,
            [
                'gte' => $startAt->format('Y-m-d H:i:s'),
            ],
        );

        $boolQuery->addFilter($startAtRange);

        return $searchQuery;
    }

    /**
     * @param \Elastica\Query $query
     *
     * @throws \InvalidArgumentException
     *
     * @return \Elastica\Query\BoolQuery
     */
    protected function getBoolQuery(Query $query): BoolQuery
    {
        $boolQuery = $query->getQuery();

        if (is_array($boolQuery)) {
            throw new InvalidArgumentException(sprintf(
                'Start at query expander available only with %s, got: array',
                BoolQuery::class,
            ));
        }

        if (!$boolQuery instanceof BoolQuery) {
            throw new InvalidArgumentException(sprintf(
                'Start at query expander available only with %s, got: %s',
                BoolQuery::class,
                $boolQuery::class,
            ));
        }

        return $boolQuery;
    }
}
