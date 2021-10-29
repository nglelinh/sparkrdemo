<?php

namespace Sparkr\Domain\NotificationManagement\Notification\Models;

use Sparkr\Domain\Base\BaseDomainModel;
use Sparkr\Utility\Enums\Status;

/**
 *
 */
class Notification extends BaseDomainModel
{
    private string $type;

    private string $title;

    private string $content;

    private ?string $variables;

    private int $status;

    /**
     * Notification constructor.
     * @param  string  $type
     * @param  string  $title
     * @param  string  $content
     * @param  string|null  $variables
     * @param  int  $status
     */
    public function __construct(
        string $type,
        string $title,
        string $content,
        ?string $variables = null,
        int $status = Status::Active)
    {
        $this->type = $type;
        $this->title = $title;
        $this->content = $content;
        $this->variables = $variables;
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param  string  $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param  string  $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param  string  $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return string|null
     */
    public function getVariables(): ?string
    {
        return $this->variables;
    }

    /**
     * @param  string|null  $variables
     */
    public function setVariables(?string $variables): void
    {
        $this->variables = $variables;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param  int  $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

}
