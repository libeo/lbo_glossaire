<?php

namespace Libeo\LboGlossaire\DataHandler;

use Libeo\LboGlossaire\Domain\Model\GlossaryLetterGroup;
use Libeo\LboGlossaire\Domain\Model\Term;
use Libeo\LboGlossaire\Domain\Repository\TermRepository;
use Libeo\LboGlossaire\Utility\StringUtility;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Glossary implements SingletonInterface
{

    /**
     * @var string
     */
    private string $indexNonLetters = '0-9';

    /**
     * @var array
     */
    private array $terms = [];

    /**
     * All terms grouped by first letter of term [a] => [], [b] => => [], etc
     * @var array
     */
    private array $letterGroups = [];

    /**
     * All terms that doesn't start with a letter
     * @var GlossaryLetterGroup
     */
    private GlossaryLetterGroup $noLetterGroup;

    /**
     * @TYPO3\CMS\Extbase\Annotation\Inject
     * @var TermRepository|null
     */
    private ?TermRepository $termRepository = null;


    public function __construct(TermRepository $termRepository)
    {
        $this->termRepository = $termRepository;
        $this->terms = $this->termRepository->getTermsToListFromRepository();
        $this->indexSplitAlphaOthers();
    }

    /**
     * Returns an array with all terms, index will be first character of term
     * @return array
     */
    private function getTermsIndexedByFirstCharacter(): array
    {
        $termsByFirstCharacter = [];
        /** @var Term $term */
        foreach ($this->getTerms() as $term) {
            $firstCharacter = strtoupper(mb_substr(StringUtility::normalize($term->getTerm()), 0, 1));

            if (!isset($termsByFirstCharacter[$firstCharacter])) {
                $termsByFirstCharacter[$firstCharacter] = [];
            }

            $termsByFirstCharacter[$firstCharacter][] = $term;
        }

        return $termsByFirstCharacter;
    }

    /**
     * Split all terms in 2 categories (Letters and others non letters)
     * @see $letterGroups and
     * @see $noLetterGroup
     */
    private function indexSplitAlphaOthers(): void
    {
        $this->letterGroups = array_fill_keys(range('A', 'Z'), []);
        $others = [];

        $termIndexed = $this->getTermsIndexedByFirstCharacter();
        foreach ($termIndexed as $firstCharacter => $terms) {
            if (ctype_alpha($firstCharacter)) {
                $this->letterGroups[$firstCharacter] = GeneralUtility::makeInstance(GlossaryLetterGroup::class, $firstCharacter, $terms);
            } else {
                $others = array_merge($others, $terms);
            }
        }

        ksort($this->letterGroups);

        $this->noLetterGroup = GeneralUtility::makeInstance(GlossaryLetterGroup::class, $this->indexNonLetters, $others);
    }


    /**
     * Return all terms that aren't hide it
     * @return array
     */
    public function getTerms(): array
    {
        return $this->terms;
    }

    /**
     * Return an array of all terms index by a letter that begins with
     * [a] => [,,,,], [b] => => [,,,,].....
     * @return array
     */
    public function getLetterGroups(): array
    {
        return $this->letterGroups;
    }

    /**
     * Return a list with all letters of alphabet + 0-9 grouped numbers at the beginning
     * 0-9, A, B .....
     * @return array
     */
    public function getLetterGroupsAndOthers(): array
    {
        return array_merge([$this->indexNonLetters => $this->getNotLetter()], $this->getLetterGroups());
    }

    /**
     * Return a list with all letters of alphabet + 0-9 grouped numbers at the end
     * A, B ....., Z, 0-9
     * @return array
     */
    public function getLetterGroupsAndOthersInverted(): array
    {
        return array_merge($this->getLetterGroups(), [$this->indexNonLetters => $this->getNotLetter()]);
    }

    /**
     * Return all terms that doesn't start with a letter
     * @return GlossaryLetterGroup
     */
    public function getNotLetter(): GlossaryLetterGroup
    {
        return $this->noLetterGroup;
    }
}
