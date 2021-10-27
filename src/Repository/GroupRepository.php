<?php
declare(strict_types=1);

namespace App\Repository;
use App\Model\Group;

interface GroupRepository
{
    /**
     * @return Group[]
     */
    public function findAll(): array;

    /**
     * @param  int $id
     * @return Group
     * @throws GroupNotFoundException
     */
    public function findGroupOfId(int $id): Group;
}
