<?php
declare(strict_types=1);

namespace App\Repository;
use App\Model\GroupMessage;

interface GroupMessageRepository
{
    /**
     * @return GroupMessage[]
     */
    public function findAll(): array;

    /**
     * @param  int $id
     * @return GroupMessage
     * @throws GroupMessageNotFoundException
     */
    public function findUserOfId(int $id): GroupMessage;
}
