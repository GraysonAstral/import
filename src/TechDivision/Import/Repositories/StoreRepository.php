<?php

/**
 * TechDivision\Import\Repositories\StoreRepository
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

namespace TechDivision\Import\Repositories;

use TechDivision\Import\Utils\MemberNames;

/**
 * A SLSB that handles the product import process.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/wagnert/csv-import
 * @link      http://www.appserver.io
 */
class StoreRepository extends AbstractRepository
{

    /**
     * Initializes the repository's prepared statements.
     *
     * @return void
     * @PostConstruct
     */
    public function init()
    {

        // load the utility class name
        $utilityClassName = $this->getUtilityClassName();

        // initialize the prepared statements
        $this->storesStmt = $this->getConnection()->prepare($utilityClassName::STORES);
    }

    /**
     * Return's an array with the available stores and their
     * store codes as keys.
     *
     * @return array The array with all available stores
     */
    public function findAll()
    {

        // initialize the array with the available stores
        $stores = array();

        // execute the prepared statement
        $this->storesStmt->execute();

        // fetch the stores and assemble them as array with the store code as key
        foreach ($this->storesStmt->fetchAll() as $store) {
            $stores[$store[MemberNames::CODE]] = $store;
        }

        // return the array with the stores
        return $stores;
    }
}
