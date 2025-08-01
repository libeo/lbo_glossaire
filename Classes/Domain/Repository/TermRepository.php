<?php

namespace Libeo\LboGlossaire\Domain\Repository;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Michel Tremblay <michel.tremblay@libeo.com>, Libéo
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * The repository for Terms
 */
class TermRepository extends Repository
{
    /**
     * Ordre alphabétique par défaut
     * @var array
     */
    protected $defaultOrderings = array('term' => QueryInterface::ORDER_ASCENDING);

    public function initializeObject()
    {
        /** @var Typo3QuerySettings $querySettings */
        $querySettings = GeneralUtility::makeInstance(Typo3QuerySettings::class);
        $querySettings->setRespectStoragePage(false);
        $this->setDefaultQuerySettings($querySettings);
    }

    /**
     * Return all terms to show in a list meaning hide_in_glossary_page is false
     * @return array All terms on database
     */
    public function getTermsToListFromRepository($pids = null): array
    {
        $query = $this->createQuery();

        $constraints = [$query->equals('hideInGlossaryPage', 0)];
        if(!empty($pids) && is_array($pids)){
            $constraints[] = $query->in('pid', $pids);
        }

        return $query->matching(
            $query->logicalAnd(...$constraints)
        )->execute()->toArray();
    }
}
