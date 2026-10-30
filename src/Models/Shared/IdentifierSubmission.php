<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class IdentifierSubmission
{
    /**
     * The original value submitted in assessment_id. Under canonical or mailbox matching the two accounts' values can differ.
     *
     * @var string $value
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('value')]
    public string $value;

    /**
     * Opaque, server-assigned assessment id: 'asm_' and a 26-character Crockford base32 ULID. Unique within the workspace; another workspace's assessment id answers 404.
     *
     * @var string $assessmentId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assessment_id')]
    public string $assessmentId;

    /**
     * When assessment_id was created.
     *
     * @var string $submittedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('submitted_at')]
    public string $submittedAt;

    /**
     * @param  string  $value
     * @param  string  $assessmentId
     * @param  string  $submittedAt
     * @phpstan-pure
     */
    public function __construct(string $value, string $assessmentId, string $submittedAt)
    {
        $this->value = $value;
        $this->assessmentId = $assessmentId;
        $this->submittedAt = $submittedAt;
    }
}