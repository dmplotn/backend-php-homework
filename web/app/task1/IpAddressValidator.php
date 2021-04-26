<?php

class IpAddressValidator
{
    public static function validate(string $ip): bool
    {
        return (new self())->doValidate($ip);
    }

    public function doValidate(string $ip): bool
    {
        return (bool) filter_var($ip, FILTER_VALIDATE_IP);
    }
}
