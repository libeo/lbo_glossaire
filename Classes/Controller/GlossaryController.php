<?php

namespace Libeo\LboGlossaire\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2021 Octavio Cim Jr <ocim@libeo.com>
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

use Libeo\LboGlossaire\DataHandler\Glossary;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * GlossaryController
 */
class GlossaryController extends ActionController
{

    /**
     * Show form and all terms on glossary
     */
    public function listAction(): ResponseInterface
    {
        $glossary = GeneralUtility::makeInstance(Glossary::class);
        $glossary->init($this->getPids());
        $this->view->assign('glossary', $glossary);

        return $this->htmlResponse();
    }

    protected function getPids(): ?array
    {
        $cObj = $this->request->getAttribute('currentContentObject');
        $pids = null;
        if ($cObj) {
            $pids = GeneralUtility::intExplode(',', $cObj->data['pages'] ?? '', true);
        }
        return $pids;
    }
}
