<?php

namespace Bhry98\Users\Interfaces;

interface OtpSenderInterface
{
    public function sendOtp(string $phone, string $otp): void;
}