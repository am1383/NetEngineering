<?php

function normalizePhoneNumber(string $phoneNumber): string
{
    return match (strlen($phoneNumber)) {
        10 => '+98'.$phoneNumber,
        11 => $phoneNumber[0] === '0' ? '+98'.substr($phoneNumber, 1) : $phoneNumber,
        12 => str_starts_with($phoneNumber, '98') ? '+'.$phoneNumber : $phoneNumber,
        default => ''
    };
}
