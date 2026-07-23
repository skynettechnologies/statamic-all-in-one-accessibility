<?php

namespace Skynettechnologies\AllInOneAccessibility\Http\Controllers;

use Statamic\Http\Controllers\CP\CpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class SettingsController extends CpController
{
    public function index()
    {
        $domain = request()->getHost();

        $adminUser = Auth::user();
        $userName  = $adminUser->name ?? 'Dear Customer';
        $userLogin = $adminUser->email ?? ('no-reply@' . $domain);

        return view('skynettechnologies/statamic-all-in-one-accessibility::settings', [
            'domain' => $domain,
            'user_name' => $userName,
            'email' => $userLogin,
            'id' => '',
            'color' => '#420083',
            'position' => 'bottom_right',
            'icon_type' => 'aioa-icon-type-1',
            'icon_size' => 'aioa-default-icon',
            'is_widget_custom_position' => 0,
            'widget_position_left' => 0,
            'widget_position_top' => 0,
            'widget_position_right' => 0,
            'widget_position_bottom' => 0,
            'widget_size' => 0,
            'is_widget_custom_size' => 0,
            'widget_icon_size_custom' => 20,
        ]);
    }

    /**
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $domain = request()->getHost();
        $message = '';

        $adminUser = Auth::user();
        $userName  = $adminUser->name ?? 'Dear Customer';
        $userLogin = $adminUser->email ?? ('no-reply@' . $domain);
        $base64Domain = base64_encode($domain);

        // ✅ Unique cache key per domain
        $cacheKey = 'aioa_initialized_' . $domain;

        /**
         * --------------------------------------
         * API Client
         * --------------------------------------
         */
        $client = Http::withOptions([
            'verify' => false,
        ])->withHeaders([
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
        ]);

        /**
         * --------------------------------------
         * RUN ONLY FIRST TIME
         * --------------------------------------
         */
        if (!Cache::get($cacheKey)) {

            // 👉 Detect EU / Non-EU
            $noRequiredEu = 1;
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

            // 👉 Add User Domain
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

            $client->post(
                'https://ada.skynettechnologies.us/api/add-user-domain',
                $arr_details
            );

            // ✅ Mark as done (only once)
            Cache::forever($cacheKey, true);
        }

        /**
         * --------------------------------------
         * ALWAYS RUN
         * --------------------------------------
         */
        $widgetSettingsResponse = $client->post(
            'https://ada.skynettechnologies.us/api/widget-settings-platform',
            ['website_url' => $domain]
        );

        $widgetData = $widgetSettingsResponse->json() ?? [];

        return redirect()
            ->back()
            ->with('success', 'Settings saved successfully')
            ->with('widget', $widgetData);
    }

    public function fetch()
    {
        return response()->json(['status' => 'ok']);
    }
}
