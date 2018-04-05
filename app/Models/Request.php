<?php namespace App\Models;

use App\Abstractions\UUIDModel;
use App\Interfaces\Model as IModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Request
 * @package App\Models
 *
 * @property string      $id
 * @property string      $application_id
 * @property array       $body
 * @property array       $processing_info
 * @property string      $status
 * @property string      $response
 * @property string      $request_type
 * @property string      $created_at
 * @property string      $updated_at
 *
 * @property Application $application
 */
class Request extends UUIDModel implements IModel
{
    public const STATUS_NEW = 'new';

    public const STATUS_QUEUE = 'queue';

    public const STATUS_SUCCESS = 'success';

    public const STATUS_FAILED = 'failed';

    public const STATUS_RETRY = 'need_another_attempt';

    public const TYPE_LEAD = 'lead';

    public const TYPE_USER = 'user';

    protected $table = 'requests';

    protected $fillable = [
        'application_id',
        'body',
        'request_type',
    ];

    protected $casts = [
        'body'            => 'array',
        'processing_info' => 'array',
    ];

    protected $visible = [
        'id',
        'body',
        'status',
        'created_at',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->status)) {
                $model->status = self::STATUS_NEW;
            }
        });
    }

    /**
     * Application relation
     *
     * @return BelongsTo
     */
    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    /**
     * Set processing status for system
     *
     * @param string $system
     * @param string $status
     *
     * @return Request
     */
    public function setSystemStatus(string $system, string $status): self
    {
        $data = $this->processing_info;
        $data['systems_statuses'][$system] = $status;
        $this->processing_info = $data;

        return $this;
    }

    /**
     * Get status for system
     *
     * @param string $system
     *
     * @return string
     */
    public function getSystemStatus(string $system): string
    {
        return isset($this->processing_info['systems_statuses'])
        && isset($this->processing_info['systems_statuses'][$system]) ? $this->processing_info['systems_statuses'][$system] : self::STATUS_NEW;
    }

    /**
     * Get systems already processed
     *
     * @return array
     */
    public function getProcessedSystems(): array
    {
        return isset($this->processing_info['systems_statuses']) ? array_keys($this->processing_info['systems_statuses']) : [];
    }

    /**
     * Get systems need to be processed
     *
     * @param array $availableSystems
     *
     * @return array
     */
    public function getSystemsNeedToBeProcessed(array $availableSystems): array
    {
        $systemStatuses = $this->processing_info['systems_statuses'] ?? [];

        $processedSystems = [];
        foreach ($systemStatuses as $system => $status) {
            if (\in_array($status, [self::STATUS_FAILED, self::STATUS_SUCCESS, self::STATUS_QUEUE])) {
                $processedSystems[] = $system;
            }
        }

        return array_diff($availableSystems, $processedSystems);
    }

    /**
     * Check you need to process event
     *
     * @param string $system
     *
     * @return bool
     */
    public function needIToProcess(string $system): bool
    {
        return \in_array($this->getSystemStatus($system), [self::STATUS_NEW, self::STATUS_RETRY]);
    }

    /**
     * increment attempts
     *
     * @return Request
     */
    public function incAttempts(): self
    {
        $data = $this->processing_info;
        $data['attempts'] = isset($data['attempts']) ? $data['attempts']++ : 1;
        $this->processing_info = $data;

        return $this;
    }
}