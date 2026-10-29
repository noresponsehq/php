<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** PolicyEvaluationResult - The evaluation report and its provenance. A no_change report cannot authorise publication. */
class PolicyEvaluationResult
{
    /**
     *
     * @var \NoResponse\Models\Shared\PolicyEvaluation $evaluation
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('evaluation')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\PolicyEvaluation')]
    public PolicyEvaluation $evaluation;

    /**
     *
     * @var \NoResponse\Models\Shared\Report $report
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('report')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Report')]
    public Report $report;

    /**
     * @param  \NoResponse\Models\Shared\PolicyEvaluation  $evaluation
     * @param  \NoResponse\Models\Shared\Report  $report
     * @phpstan-pure
     */
    public function __construct(PolicyEvaluation $evaluation, Report $report)
    {
        $this->evaluation = $evaluation;
        $this->report = $report;
    }
}