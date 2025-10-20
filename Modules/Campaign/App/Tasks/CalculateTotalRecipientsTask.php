<?php

namespace Modules\Campaign\App\Tasks;


use Modules\Segment\App\Repositories\Contracts\SegmentRepositoryInterface;

class CalculateTotalRecipientsTask
{
    public function __construct(private readonly SegmentRepositoryInterface $segmentRepository)
    {
    }

    /**
     * @param int|null $segmentId
     * @param array|null $filterJson
     */
    public function run(?int $segmentId, ?array $filterJson): int
    {
        if ($segmentId) {
            $usersQuery = $this->segmentRepository->getUsersBySegment($segmentId);
        } elseif ($filterJson) {
            $usersQuery = $this->segmentRepository->getUsersByFilter($filterJson);
        } else {
            return 0;
        }

        return $usersQuery->count();
    }
}
