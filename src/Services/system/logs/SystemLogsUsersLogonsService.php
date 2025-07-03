<?php

namespace Bhry98\Bhry98LaravelReady\Services\system\logs;

use Bhry98\Bhry98LaravelReady\Models\logs\LogsUsersLogonsModel;
use Illuminate\Support\Facades\Http;

class SystemLogsUsersLogonsService
{
    public function getIpDetails(): array
    {
        try {
            $response = Http::timeout(5)->get('https://ipinfo.io/json');
            if ($response->successful()) {
                $data = $response->json();
                return [
                    'ip_address' => $data['ip'] ?? '0.0.0.0',
                    'city' => $data['city'] ?? 'Unknown',
                    'region' => $data['region'] ?? 'Unknown',
                    'country' => $data['country'] ?? 'Unknown',
                    'loc' => $data['loc'] ?? '0.0,0.0',
                    'org' => $data['org'] ?? 'Unknown',
                    'timezone' => $data['timezone'] ?? 'UTC',
                ];
            }
            bhry98_error_log("get user info from IPInfo request failed: {$response->status()}", ['response_body' => $response->body()]);
        } catch (\Exception $e) {
            bhry98_error_log("IPInfo connection error: {$e->getCode()}", ['error_message' => $e->getMessage()]);
        }
        // Fallback values
        return [
            'ip_address' => '0.0.0.0',
            'city' => 'Unknown',
            'region' => 'Unknown',
            'country' => 'Unknown',
            'loc' => '0.0,0.0',
            'org' => 'Unknown',
            'timezone' => 'UTC',
        ];
    }
    public function createLogonLog(): bool
    {
        $geoData = $this->getIpDetails();
        $record = LogsUsersLogonsModel::query()->create($geoData);
        return (bool)$record;
    }
}