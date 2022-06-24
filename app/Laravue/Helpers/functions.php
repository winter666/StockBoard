<?php

function is_production(): bool {
    return config('app.env') === 'production';
}
