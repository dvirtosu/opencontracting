<?php

namespace App\Moldova\Repositories\Feedback;


interface FeedbackRepositoryInterface
{
    /**
     * @return array
     */
    public function getUniqueContractsWithFeedback();

    /**
     * @return array
     */
    public function getContractWithFeedback();
}
