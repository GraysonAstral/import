<?php

/**
 * TechDivision\Import\Handler\AbstractHandler
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/wagnert/csv-import
 * @link      http://www.appserver.io
 */

namespace TechDivision\Import\Handler;

use Psr\Log\LoggerInterface;
use TechDivision\Import\Services\RegistryAwareInterface;
use TechDivision\Import\Services\RegistryProcessor;
use TechDivision\Import\Services\ProductProcessor;

/**
 * An abstract action implementation.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/wagnert/csv-import
 * @link      http://www.appserver.io
 */
abstract class AbstractHandler implements RegistryAwareInterface
{

    /**
     * The system logger implementation.
     *
     * @var \Psr\Log\LoggerInterface
     */
    protected $systemLogger;

    /**
     * The RegistryProcessor instance to handle running threads.
     *
     * @var \TechDivision\Importer\Services\RegistryProcessor
     */
    protected $registryProcessor;

    /**
     * The processor to read/write the necessary product data.
     *
     * @var \TechDivision\Importer\Services\ProductProcessor
     */
    protected $productProcessor;

    /**
     * The actions unique serial.
     *
     * @var string
     */
    protected $serial;

    /**
     * The default source date format.
     *
     * @var string
     */
    protected $sourceDateFormat = 'n/d/y, g:i A';

    /**
     * Set's the system logger.
     *
     * @param \Psr\Log\LoggerInterface $systemLogger The system logger
     *
     * @return void
     */
    public function setSystemLogger(LoggerInterface $systemLogger)
    {
        $this->systemLogger = $systemLogger;
    }

    /**
     * Return's the system logger.
     *
     * @return \Psr\Log\LoggerInterface The system logger instance
     */
    public function getSystemLogger()
    {
        return $this->systemLogger;
    }

    /**
     * Sets's the RegistryProcessor instance to handle the running threads.
     *
     * @param \AppserverIo\RemoteMethodInvocation\RemoteObjectInterface $registryProcessor
     *
     * @return void
     */
    public function setRegistryProcessor($registryProcessor)
    {
        $this->registryProcessor = $registryProcessor;
    }

    /**
     * Return's the RegistryProcessor instance to handle the running threads.
     *
     * @return \AppserverIo\RemoteMethodInvocation\RemoteObjectInterface The instance
     */
    public function getRegistryProcessor()
    {
        return $this->registryProcessor;
    }

    /**
     * Set's the product processor instance.
     *
     * @param Importer\Csv\Services\Pdo\ProductProcessor $productProcessor The product processor instance
     *
     * @return void
     */
    public function setProductProcessor($productProcessor)
    {
        $this->productProcessor = $productProcessor;
    }

    /**
     * Return's the product processor instance.
     *
     * @return \Importer\Csv\Services\Pdo\ProductProcessor The product processor instance
     */
    public function getProductProcessor()
    {
        return $this->productProcessor;
    }

    /**
     * Set's the unique serial for this import process.
     *
     * @param string $serial The unique serial
     *
     * @return void
     */
    public function setSerial($serial)
    {
        $this->serial = $serial;
    }

    /**
     * Return's the unique serial for this import process.
     *
     * @return string The unique serial
     */
    public function getSerial()
    {
        return $this->serial;
    }

    /**
     * Set's the source date format to use.
     *
     * @param string $sourceFormat The source date format
     *
     * @return void
     */
    public function setSourceDateFormat($sourceDateFormat)
    {
        $this->sourceDateFormat = $sourceDateFormat;
    }

    /**
     * Return's the source date format to use.
     *
     * @return string The source date format
     */
    public function getSourceDateFormat()
    {
        return $this->sourceDateFormat;
    }

    /**
     * Return's the initialized PDO connection.
     *
     * @return \PDO The initialized PDO connection
     */
    public function getConnection()
    {
        return $this->getProductProcessor()->getConnection();
    }
}
