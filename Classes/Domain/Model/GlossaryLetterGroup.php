<?php

namespace Libeo\LboGlossaire\Domain\Model;

class GlossaryLetterGroup
{
    /**
     * Name of index, key of this group like A or B or 0-9
     * @var string
     */
    protected string $index;

    /**
     * All terms that starts if same letter @see $index
     * @var array
     */
    protected array $terms;

    /**
     * Index all terms that start with this group @param string $index
     * @param array $terms
     * @see $index
     *
     */
    public function __construct(string $index, array $terms = [])
    {
        $this->index = $index;
        $this->terms = $terms;
    }

    /**
     * Return index letter @return string
     *@see $index
     */
    public function getIndex(): string
    {
        return $this->index;
    }

    /**
     * Return an array with all terms that starts with $letter
     * @return array
     */
    public function getTerms(): array
    {
        return $this->terms;
    }
}
