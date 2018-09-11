<?php namespace App\Subsystems\IntegrationHubDB\Models;

use App\Subsystems\IntegrationHub\Models\Application;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Subsystems\IntegrationHubDB\Abstractions\UUIDModel;
use App\Subsystems\IntegrationHubCommon\Interfaces\EventData;
use App\Subsystems\IntegrationHubDB\Interfaces\Model as IModel;

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
class Request extends UUIDModel implements IModel, EventData
{
    public const STATUS_NEW = 'new';

    public const STATUS_QUEUE = 'queue';

    public const STATUS_SUCCESS = 'success';

    public const STATUS_FAILED = 'failed';

    public const STATUS_RETRY = 'need_another_attempt';

    public const DEFAULT_TYPE = 'request';

    protected $table = 'requests';

    protected $fillable = [
        'application_id',
        'body',
        'request_type',
    ];

    protected $casts = [
        'body'            => 'array',
        'processing_info' => 'array',
        'response'        => 'array',
    ];

    protected $visible = [
        'id',
        'body',
        'status',
        'request_type',
        'processing_info',
        'response',
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
     * increment attempts
     *
     * @return Request
     */
    public function incAttempts(): self
    {
        $data = $this->processing_info;
        $data['attempts'] = isset($data['attempts']) ? ++$data['attempts'] : 1;
        $this->processing_info = $data;

        return $this;
    }

    public function toArray(): array
    {
        $result = parent::toArray();

        $result['application'] = $this->application;

        return $result;
    }

    /**
     * Get current step
     *
     * @return string
     */
    public function getCurrentFlow(): string
    {
        return $this->processing_info['current_step'] ?: '';
    }

    /**
     * Get current flow id
     *
     * @return string
     */
    public function getCurrentStep(): string
    {
        return $this->processing_info['current_flow'] ?: '';
    }

    /**
     * Set current step id in flow
     *
     * @param string $flowId
     * @param string $stepId
     *
     * @return Request
     */
    public function setCurrentStep(string $flowId, string $stepId): self
    {
        $processingInfo = $this->processing_info;

        $processingInfo['current_flow'] = $flowId;
        $processingInfo['current_step'] = $stepId;

        $this->processing_info = $processingInfo;
    }


    /**
     * Get data
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->body;
    }

    /**
     * Set data
     *
     * @param $data
     *
     * @return mixed
     */
    public function setData($data)
    {
        $this->body = $data;

        return $this;
    }
}