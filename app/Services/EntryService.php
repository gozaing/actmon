<?php

namespace App\Services;

use App\Repositories\EntryRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Auth\Access\Gate;

class EntryService
{
    /** @var EntryRepositoryInterface */
    protected $entry;

    protected $gate;

    /**
     * EntryService constructor.
     * @param EntryRepositoryInterface $entry
     * @param Gate $gate
     */
    public function __construct(EntryRepositoryInterface $entry, Gate $gate)
    {
        $this->entry = $entry;
        $this->gate = $gate;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function addEntry(array $attributes)
    {
        if (isset($attributes['id'])) {
            if (!$this->getEntryAbility($attributes['id'])) {
                return false;
            }
        }
        $result = $this->entry->save($attributes);
        return $result;
    }

    public function getEntryAbility($id)
    {
        return $this->gate->check('update', $this->getEntry($id));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getEntry($id)
    {
        return $this->entry->find($id);
    }

    public function getPage($page = 1, $limit = 20)
    {
        $result = $this->entry->byPage($page, $limit);
        return new LengthAwarePaginator(
            $result->items, $result->total, $result->perPage, $result->currentPage
        );
    }
}
