<?php namespace App\Subsystems\IntegrationHubDB\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Subsystems\IntegrationHubDB\Abstractions\UUIDModel;
use App\Subsystems\IntegrationHubDB\Interfaces\Models\ProcessOptions as IProcessOptions;

/**
 * Process options
 * @package App\Models
 *
 * @property string $id
 * @property string $name
 * @property array  $mapping
 * @property array  $options
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class ProcessOptions extends UUIDModel implements IProcessOptions
{
    use SoftDeletes;

    protected $table = 'process_options';

    public $keyType = 'string';

    protected $casts = [
        'mapping' => 'array',
        'options' => 'array',
    ];

    /**
     * Get data mapping
     *
     * @return array
     */
    public function getMapping(): array
    {
        return $this->mapping;
    }

    /**
     * Get process options
     *
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * Processor is remote
     *
     * @return bool
     */
    public function isRemote(): bool
    {
        return $this->getOptions()['is_remote'];
    }

    /**
     * Get queue name to send event to processor through queue
     *
     * @return string
     */
    public function getQueue(): string
    {
        return $this->getOptions()['queue'];
    }

    /**
     * Get host to send event to processor through REST API
     *
     * @return string
     */
    public function getHost(): string
    {
        return $this->getOptions()['host'];
    }
}