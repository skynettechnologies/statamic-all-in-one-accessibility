<?php
namespace Skynettechnologies\AllInOneAccessibility\Http\Controllers;

use Skynettechnologies\AllInOneAccessibility\MetaValues;
use Statamic\Http\Controllers\CP\CpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SettingsController extends CpController
{
    public function index(Request $request)
    {
        $message = '';
        $userName = "Dear Customer";
        $userLogin = "no-reply@statamic.com";
        $domain = url(''); // Get the base domain dynamically
        $base64Domain = base64_encode($domain);

        try {
            $client = Http::withHeaders(['Content-Type' => 'application/json']);
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
            ];

            // Send user domain data to endpoint
            $addUserDomainUrl = 'https://ada.skynettechnologies.us/api/add-user-domain';
            $addUserDomainResponse = $client->post($addUserDomainUrl, $arr_details);
            $addUserDomainData = $addUserDomainResponse->json();
            if (isset($addUserDomainData['status']) && $addUserDomainData['status'] === 0) {
                $message .= "User domain added successfully.";
            } else {
                $message .= "Failed to add user domain.";
            }

            // Fetch widget settings
            $widgetSettingsUrl = 'https://ada.skynettechnologies.us/api/widget-settings-platform';
            $widgetSettingsResponse = $client->post($widgetSettingsUrl, [
                'website_url' => $domain,
            ]);
            $widgetSettingsData = $widgetSettingsResponse->json();
            $widgetData = $widgetSettingsData ?? [];
            if (isset($widgetSettingsData['status'])) {
                $message .= " Widget settings saved successfully.";
            } else {
                $message .= " Failed to save widget settings.";
            }

            return view('skynettechnologies/statamic-all-in-one-accessibility::settings', [
                'domain' => $domain,
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
        } catch (\Exception $e) {
            $message = "Error encountered: " . $e->getMessage();
        }

        return view('skynettechnologies/statamic-all-in-one-accessibility::settings', [
            'message' => $message,
            'domain' => $domain,
            'user_name' => $userName,
            'email' => $userLogin,
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
