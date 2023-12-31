<?php

namespace FondOfImpala\Zed\ConditionalAvailabilityPageSearch\Business;

use FondOfImpala\Zed\ConditionalAvailabilityPageSearch\Business\Filter\IdConditionalAvailabilityFilter;
use FondOfImpala\Zed\ConditionalAvailabilityPageSearch\Business\Filter\IdConditionalAvailabilityFilterInterface;
use FondOfImpala\Zed\ConditionalAvailabilityPageSearch\Business\Filter\KeyFilter;
use FondOfImpala\Zed\ConditionalAvailabilityPageSearch\Business\Filter\KeyFilterInterface;
use FondOfImpala\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchDataMapper;
use FondOfImpala\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchDataMapperInterface;
use FondOfImpala\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchExpander;
use FondOfImpala\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchExpanderInterface;
use FondOfImpala\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchPublisher;
use FondOfImpala\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchPublisherInterface;
use FondOfImpala\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchUnpublisher;
use FondOfImpala\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchUnpublisherInterface;
use FondOfImpala\Zed\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchDependencyProvider;
use FondOfImpala\Zed\ConditionalAvailabilityPageSearch\Dependency\Service\ConditionalAvailabilityPageSearchToUtilEncodingServiceInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfImpala\Zed\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchConfig getConfig()
 * @method \FondOfImpala\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchEntityManagerInterface getEntityManager()
 * @method \FondOfImpala\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfImpala\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchRepositoryInterface getRepository()
 */
class ConditionalAvailabilityPageSearchBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfImpala\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchPublisherInterface
     */
    public function createConditionalAvailabilityPeriodPageSearchPublisher(): ConditionalAvailabilityPeriodPageSearchPublisherInterface
    {
        return new ConditionalAvailabilityPeriodPageSearchPublisher(
            $this->createKeyFilter(),
            $this->createIdConditionalAvailabilityFilter(),
            $this->createConditionalAvailabilityPeriodPageSearchExpander(),
            $this->createConditionalAvailabilityPeriodPageSearchDataMapper(),
            $this->getQueryContainer(),
            $this->getEntityManager(),
            $this->getUtilEncodingService(),
        );
    }

    /**
     * @return \FondOfImpala\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchUnpublisherInterface
     */
    public function createConditionalAvailabilityPeriodPageSearchUnpublisher(): ConditionalAvailabilityPeriodPageSearchUnpublisherInterface
    {
        return new ConditionalAvailabilityPeriodPageSearchUnpublisher(
            $this->createKeyFilter(),
            $this->createIdConditionalAvailabilityFilter(),
            $this->getEntityManager(),
        );
    }

    /**
     * @return \FondOfImpala\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchDataMapperInterface
     */
    protected function createConditionalAvailabilityPeriodPageSearchDataMapper(): ConditionalAvailabilityPeriodPageSearchDataMapperInterface
    {
        return new ConditionalAvailabilityPeriodPageSearchDataMapper(
            $this->getConditionalAvailabilityPeriodPageSearchDataExpanderPlugins(),
        );
    }

    /**
     * @return \FondOfImpala\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchExpanderInterface
     */
    protected function createConditionalAvailabilityPeriodPageSearchExpander(): ConditionalAvailabilityPeriodPageSearchExpanderInterface
    {
        return new ConditionalAvailabilityPeriodPageSearchExpander(
            $this->getConditionalAvailabilityPeriodPageDataExpanderPlugins(),
        );
    }

    /**
     * @return \FondOfImpala\Zed\ConditionalAvailabilityPageSearch\Business\Filter\KeyFilterInterface
     */
    protected function createKeyFilter(): KeyFilterInterface
    {
        return new KeyFilter();
    }

    /**
     * @return \FondOfImpala\Zed\ConditionalAvailabilityPageSearch\Business\Filter\IdConditionalAvailabilityFilterInterface
     */
    protected function createIdConditionalAvailabilityFilter(): IdConditionalAvailabilityFilterInterface
    {
        return new IdConditionalAvailabilityFilter();
    }

    /**
     * @return \FondOfImpala\Zed\ConditionalAvailabilityPageSearch\Dependency\Service\ConditionalAvailabilityPageSearchToUtilEncodingServiceInterface
     */
    protected function getUtilEncodingService(): ConditionalAvailabilityPageSearchToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(ConditionalAvailabilityPageSearchDependencyProvider::SERVICE_UTIL_ENCODING);
    }

    /**
     * @return array<\FondOfImpala\Zed\ConditionalAvailabilityPageSearchExtension\Dependency\Plugin\ConditionalAvailabilityPeriodPageDataExpanderPluginInterface>
     */
    protected function getConditionalAvailabilityPeriodPageDataExpanderPlugins(): array
    {
        return $this->getProvidedDependency(ConditionalAvailabilityPageSearchDependencyProvider::PLUGINS_CONDITIONAL_AVAILABILITY_PERIOD_PAGE_DATA_EXPANDER);
    }

    /**
     * @return array<\FondOfImpala\Zed\ConditionalAvailabilityPageSearchExtension\Dependency\Plugin\ConditionalAvailabilityPeriodPageSearchDataExpanderPluginInterface>
     */
    protected function getConditionalAvailabilityPeriodPageSearchDataExpanderPlugins(): array
    {
        return $this->getProvidedDependency(ConditionalAvailabilityPageSearchDependencyProvider::PLUGINS_CONDITIONAL_AVAILABILITY_PERIOD_PAGE_SEARCH_DATA_EXPANDER);
    }
}
