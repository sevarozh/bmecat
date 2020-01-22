<?php
/**
 * This file is part of the BMEcat php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\BMEcat;

use SE\Component\BMEcat\Exception\UnknownNodeException;
use SE\Component\BMEcat\Exception\UnknownNodeTypeException;
use SE\Component\BMEcat\Node\AbstractNode;

/**
 *
 * @package SE\Component\BMEcat
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class NodeLoader
{
    const DOCUMENT_NODE         = 'document.node';
    const HEADER_NODE           = 'header.node';
    const NEW_CATALOG_NODE      = 'newcatalog.node';
    const SUPPLIER_NODE         = 'supplier.node';
    const CATALOG_NODE          = 'catalog.node';
    const ARTICLE_NODE          = 'article.node';
    const PRODUCT_FEATURE_NODE  = 'product.feature.node';
    const PRODUCT_DETAILS_NODE = 'product.details.node';
    const PRODUCT_PRICE_NODE    = 'product.price.node';
    const DATE_TIME_NODE        = 'datetime.node';

    /**
     *
     * @var array
     */
    protected $default = [
        self::DOCUMENT_NODE             => '\SE\Component\BMEcat\Node\DocumentNode',
        self::HEADER_NODE               => '\SE\Component\BMEcat\Node\HeaderNode',
        self::NEW_CATALOG_NODE          => '\SE\Component\BMEcat\Node\NewCatalogNode',
        self::SUPPLIER_NODE             => '\SE\Component\BMEcat\Node\SupplierNode',
        self::CATALOG_NODE              => '\SE\Component\BMEcat\Node\CatalogNode',
        self::ARTICLE_NODE              => '\SE\Component\BMEcat\Node\ArticleNode',
        self::PRODUCT_FEATURE_NODE      => '\SE\Component\BMEcat\Node\ProductFeatureNode',
        self::PRODUCT_DETAILS_NODE => '\SE\Component\BMEcat\Node\ProductDetailsNode',
        self::PRODUCT_PRICE_NODE        => '\SE\Component\BMEcat\Node\ProductPriceNode',
        self::DATE_TIME_NODE            => '\SE\Component\BMEcat\Node\DateTimeNode',
    ];

    /**
     *
     * @var array
     */
    protected $custom = [];

    /**
     *
     * @param string $nodeName
     * @return AbstractNode
     * @throws UnknownNodeException
     */
    public function getInstance($nodeName)
    {
        if(isset($this->custom[$nodeName]) === true) {
            return new $this->custom[$nodeName];
        }

        if(isset($this->default[$nodeName]) === true) {
            return new $this->default[$nodeName];
        }

        throw new UnknownNodeException(sprintf('Node %s not found.', $nodeName));
    }

    /**
     *
     * @param string $nodeName
     * @param string $class
     * @throws UnknownNodeTypeException
     */
    public function set($nodeName, $class)
    {
        if(isset($this->default[$nodeName]) === false) {
            throw new UnknownNodeTypeException(sprintf('Node name %s not found.', $nodeName));
        }

        $this->custom[$nodeName] = $class;
    }

    /**
     *
     * @param string $nodeName
     * @return $class
     * @throws UnknownNodeTypeException
     */
    public function get($nodeName)
    {
        if(isset($this->custom[$nodeName]) === true) {
            return $this->custom[$nodeName];
        }

        if(isset($this->default[$nodeName]) === true) {
            return $this->default[$nodeName];
        }

        throw new UnknownNodeTypeException(sprintf('Node name %s not found.', $nodeName));
    }
}