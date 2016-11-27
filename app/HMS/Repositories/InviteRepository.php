<?php

namespace HMS\Repositories;

use Carbon\Carbon;
use Hms\Entities\Invite;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\Criteria;

class InviteRepository extends EntityRepository
{
    /**
     * Create a new invite if not found.
     *
     * @param  string $email
     * @return Invite
     */
    public function findOrCreateByEmail($email)
    {
        $invite = $this->findOneByEmail($email);
        if ( ! $invite) {
            // Don't have a previous invite so create one
            $invite = new Invite();
            $invite->create($email);
            $this->_em->persist($invite);
            $this->_em->flush();
        }

        return $invite;
    }

    /**
     * remove all invites older than a given date.
     * @param  Carbon $date
     * @return array
     */
    public function removeAllOlderThan(Carbon $date)
    {
        $criteria = new Criteria();
        $criteria->where($criteria->expr()->lt('createdAt', $date));

        $invites = $this->matching($criteria)->toArray();

        foreach ($invites as $invite) {
            $this->_em->remove($invite);
        }
        $this->_em->flush();
    }
}
