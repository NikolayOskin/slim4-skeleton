<?php

namespace App\Models;

interface Flusher
{
    public function flush(): void;
}