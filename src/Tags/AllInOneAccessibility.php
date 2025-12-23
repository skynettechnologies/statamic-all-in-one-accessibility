<?php
namespace Skynettechnologies\AllInOneAccessibility\Tags;
//use Skynettechnologies\AllInOneAccessibility\Utils\Box;
use Statamic\Tags\Tags;

class AllInOneAccessibility extends Tags
{
    protected $config;

    /**
     * The {{ all_in_one_accessibility }} tag.
     *
     * @return string|array
     */
    public function index()
    {
        return $this->getJavaScriptVariable();
    }

    protected function getJavaScriptVariable()
    {
        $domain = $_SERVER['HTTP_HOST'] ?? '';
        $domainBase64 = base64_encode($domain);
        // Widget settings
        $color = '#420083';
        $token = '';
        $position = 'bottom_right';
        $icon_type = 'aioa-icon-type-1';
        $icon_size = 'aioa-medium-icon';
        // Call API
        $apiUrl = 'https://ada.skynettechnologies.us/api/add-user-domain';
        $ch = curl_init($apiUrl);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode([
                'website' => $domainBase64
            ]),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json'
            ],
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        $apiResponse = json_decode($response, true);
        // 0 = EU | 1 = NON-EU
        $noRequiredEu = $apiResponse['website_data']['no_required_eu'] ?? 1;
        $debugJs = "
            <script>
                console.log('ADA Full API Response:', " . json_encode($apiResponse) . ");
                console.log('ADA no_required_eu:', '" . $noRequiredEu . "');
            </script>
            ";
        if ($noRequiredEu == 0) {
            return $debugJs . "
                <script>
                    setTimeout(function () {
                        var s = document.createElement('script');
                        s.src = 'https://eu.skynettechnologies.com/accessibility/js/all-in-one-accessibility-js-widget-minify.js?colorcode={$color}&token={$token}&position={$position}';
                        s.id = 'aioa-adawidget';
                        s.defer = true;
                        document.body.appendChild(s);
                    }, 3000);
                </script>";
        } else {
            return $debugJs . '<script>
            const scriptTag = document.createElement("script");
            scriptTag.id = "aioa-adawidget";
            scriptTag.src = "https://www.skynettechnologies.com/accessibility/js/all-in-one-accessibility-js-widget-minify.js?colorcode=#&token=&position=";
            document.head.appendChild(scriptTag);
        </script>';
        }
    }
}
