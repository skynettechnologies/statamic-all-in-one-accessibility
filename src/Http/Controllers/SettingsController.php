<?php
namespace Skynettechnologies\AllInOneAccessibility\Http\Controllers;

use Skynettechnologies\AllInOneAccessibility\MetaValues;
use Statamic\Http\Controllers\CP\CpController;
use Illuminate\Http\Request;
use Statamic\Facades\User;
use Skynettechnologies\AllInOneAccessibility\Blueprint\Formulus;
use Skynettechnologies\AllInOneAccessibility\Http\Requests\StoreRequest;

class SettingsController extends CpController
{
    public function index( Request $request )
    {
        // $user = User::fromUser( $request->user() );
        // $blueprint = Formulus::getBlueprint();

        // $fields = $blueprint->fields();
        // $fields = $fields->preProcess();

        // $values = new MetaValues( $fields );

        // $field_values = $values->values();
        // // if ( count( $field_values) != 0 ) {

        // // }else{
        // //     $data = [
        // //         'title' => 'All in One Accessibility',
        // //         'content' => '',
        // //         'iframe_url' => 'https://ada.skynettechnologies.us/check-website',
        // //     ];
        // // }
        $data = [
            'title' => 'All in One Accessibility',
            'content' => '',
            'iframe_url' => 'https://ada.skynettechnologies.us/check-website',
        ];

        return view('skynettechnologies/statamic-all-in-one-accessibility::settings', $data);
    }
}
