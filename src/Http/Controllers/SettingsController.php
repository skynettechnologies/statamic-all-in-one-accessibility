<?php

namespace Skynettechnologies\AllInOneAccessibility\Http\Controllers;

use Statamic\Http\Controllers\CP\CpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SettingsController extends CpController
{
    public function index(Request $request)
    {
        $message   = '';
        $userName  = 'Dear Customer';
        $userLogin = 'no-reply@statamic.com';
        $domain    = $_SERVER['HTTP_HOST'] ?? url('');
        $base64Domain = base64_encode($domain);
        /**
         * --------------------------------------
         * Detect EU / Non-EU using cURL
         * --------------------------------------
         */
        $noRequiredEu = 1; // Default: Non-EU
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => 'https://ipwho.is/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ]);
        $response = curl_exec($ch);
        if ($response !== false) {
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $data = json_decode($response, true);
            if ($httpCode === 200 && json_last_error() === JSON_ERROR_NONE) {
                $noRequiredEu = ($data['is_eu'] ?? false) ? 0 : 1;
            }
        }
        curl_close($ch);

        /**
         * --------------------------------------
         * API Client (SSL verify disabled)
         * --------------------------------------
         */
        $client = Http::withOptions([
            'verify' => false, // Fixes cURL error 60
        ])->withHeaders([
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
        ]);

        /**
         * --------------------------------------
         * Add User Domain
         * --------------------------------------
         */
        $arr_details = [
            'name' => $userName,
            'email' => $userLogin,
            'company_name' => '',
            'website' => $base64Domain,
            'package_type' => 'free-widget',
            'start_date' => now()->toDateTimeString(),
            'end_date' => '',
            'price' => '',
            'discount_price' => '0',
            'platform' => 'Statamic',
            'api_key' => '',
            'is_trial_period' => '',
            'is_free_widget' => '1',
            'bill_address' => '',
            'country' => '',
            'state' => '',
            'city' => '',
            'post_code' => '',
            'transaction_id' => '',
            'subscr_id' => '',
            'payment_source' => '',
            'no_required_eu' => $noRequiredEu,
        ];
        $addUserDomainResponse = $client->post(
            'https://ada.skynettechnologies.us/api/add-user-domain',
            $arr_details
        );
        $addUserDomainData = $addUserDomainResponse->json();
        if (($addUserDomainData['status'] ?? 1) === 0) {
            $message .= 'User domain added successfully.';
        } else {
            $message .= 'Failed to add user domain.';
        }
        /**
         * --------------------------------------
         * Fetch Widget Settings
         * --------------------------------------
         */
        $widgetSettingsResponse = $client->post(
            'https://ada.skynettechnologies.us/api/widget-settings-platform',
            ['website_url' => $domain]
        );
        $widgetData = $widgetSettingsResponse->json() ?? [];
        if (isset($widgetData['status'])) {
            $message .= ' Widget settings saved successfully.';
        } else {
            $message .= ' Failed to save widget settings.';
        }
        /**
         * --------------------------------------
         * Return View
         * --------------------------------------
         */
        return view('skynettechnologies/statamic-all-in-one-accessibility::settings', [
            'domain'  => $domain,
            'user_name' => $userName,
            'email' => $userLogin,
            'message' => $message,
            'id' => $widgetData['id'] ?? '',
            'color' => $widgetData['color'] ?? '#420083',
            'position' => $widgetData['position'] ?? 'bottom_right',
            'icon_type' => $widgetData['icon_type'] ?? 'aioa-icon-type-1',
            'icon_size' => $widgetData['icon_size'] ?? 'aioa-default-icon',
            'is_widget_custom_position' => $widgetData['is_widget_custom_position'] ?? 0,
            'widget_position_left' => $widgetData['widget_position_left'] ?? 0,
            'widget_position_top' => $widgetData['widget_position_top'] ?? 0,
            'widget_position_right' => $widgetData['widget_position_right'] ?? 0,
            'widget_position_bottom' => $widgetData['widget_position_bottom'] ?? 0,
            'widget_size' => $widgetData['widget_size'] ?? 0,
            'is_widget_custom_size' => $widgetData['is_widget_custom_size'] ?? 0,
            'widget_icon_size_custom' => $widgetData['widget_icon_size_custom'] ?? 20,
        ]);
    }
}
