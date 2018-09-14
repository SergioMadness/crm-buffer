<?php

namespace professionalweb\IntegrationHub\Events;

use Illuminate\Queue\SerializesModels;

abstract class Event
{
    use SerializesModels;
}
