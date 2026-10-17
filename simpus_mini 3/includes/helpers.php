<?php
// Escape output agar aman dari XSS (Jobsheet 11)
function e($value)
{
    return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES, 'UTF-8');
}
