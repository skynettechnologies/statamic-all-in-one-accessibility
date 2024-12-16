@extends('statamic::layout')
@section('title', __('All in One Accessibility®'))
@section('wrapper_class', 'max-w-3xl')

<style>
    /* Loader styles */
        #loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
        }
        .spinner {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .get-strated-btn,
        .get-strated-btn:hover {
            background-color: #2855d3;
            color: white;
            padding: 5px 5px;
            text-decoration: none;
        }

        .aioa-cancel-button {
            text-decoration: none;
            display: inline-block;
            vertical-align: middle;
            border: 2px solid #dd2755;
            border-radius: 4px 4px 4px 4px;
            background-color: #ea2362;
            box-shadow: 0px 0px 2px 0px #333333;
            color: #ffffff;
            text-align: center;
            box-sizing: border-box;
            padding: 10px;
        }

        .aioa-cancel-button:hover {
            border-color: #e21f4a;
            background-color: white;
            box-shadow: 0px 0px 2px 0px #333333;
        }

        .aioa-cancel-button:hover .mb-text {
            color: #e82757;
        }

        .icon-type-wrapper .row label,
        .icon-size-wrapper .row label {
            background: #211f1f;
        }

        .icon-type-wrapper .row {
            flex-wrap: wrap;
        }

        .horizontal-container,
        .vertical-container {
            display: flex;
            flex-wrap: wrap;
            column-gap: 20px;
            color: black;

        }

        .horizontal-container div,
        .vertical-container div {
            min-width: 150px;
            margin-top: 0;
        }

        .horizontal-container label,
        .vertical-container label {
            display: block !important;
        }

        .horizontal-container select,
        .horizontal-container input,
        .vertical-container select,
        .vertical-container input {
            width: 100%;
        }

        .horizontal-container label,
        .horizontal-container input,
        .horizontal-container select .vertical-container label,
        .vertical-container input,
        .vertical-container select {
            display: block;
        }
         .header-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .header-content img {
            max-width: 510px; /* Adjust image size */
            height: auto;
        }
</style>
@section('content')

<?php use Statamic\Statamic;

?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Statamic App - Subscription Plan" />
    <link href="{{ asset('css/allinoneaccessibility.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <!--<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />-->
</head>
<body>

<div class="panel panel-default aioa-settings-panel">
  <div class="panel-body">
    <form method="POST" enctype="multipart/form-data" id="form-module">
      <input type="hidden" id="settings-isvalid_key" name="isvalid_key" value="">
      <input type="hidden" id="id" name="id" value="{{ $id }}">
      <input type="hidden" id="user_name" name="user_name" value="{{ $user_name }}">
      <input type="hidden" id="email" name="email" value="{{ $email }}">

    <div class="header-content">
        <h1 class="mb-0 text-black">
            <img src="https://ada.skynettechnologies.us/public/trial-assets/images/all-in-one-accessibility-logo.svg" alt="All in One Accessibility - Skynet Technologies">
        </h1>
    </div>
      <!-- License Key Message -->
      <div class="form-group row mt-0" style="margin-bottom: auto;">
        <div class="col-sm-12">
          <div style="margin-top: 5px;">
            <p id="license_key_msg" class="">
              <strong>Please <a href="https://ada.skynettechnologies.us/trial-subscription?website={{ $domain }}"
                target="_blank">Upgrade</a> to paid version of All in One Accessibility® Pro.</strong>
            </p>
          </div>
        </div>
      </div>

      <!-- Hex Color Input -->
      <div class="form-group common-class" style="margin-bottom: 3px;">
        <label class="h3" for="color">Hex color code:</label>
        <div class="d-flex" style="max-width: 300px;">
          <input type="text" name="color" value="{{ $color }}" id="color" class="form-control colorint me-3">
          <input type="color" id="colorpicker" name="colorpicker" class="colorpicker"
            pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="{{ $color }}"
            style="height: 40.98px">
        </div>
      </div>

    <div class="form-group">
        <div class="form-radios">
            <h3>Select Position Type:</h3>
            <!-- Fixed Position Radio -->
            <div class="form-radio-item">
                <input type="radio" id="edit-is-widget-custom-position-0" name="is_widget_custom_position" value="0"
                       class="form-radio form-boolean form-boolean--type-radio select-widget-position"
                       {{ $is_widget_custom_position == '0' ? 'checked' : '' }}>
                <label for="edit-is-widget-custom-position-0" class="form-item__label option">Fix Position</label>
            </div>
    
            <!-- Custom Position Radio -->
            <div class="form-radio-item" style="d-none">
                <input type="radio" id="edit-is-widget-custom-position-1" name="is_widget_custom_position" value="1"
                       class="form-radio form-boolean form-boolean--type-radio select-widget-position"
                       {{ $is_widget_custom_position == '1' ? 'checked' : '' }}>
                <label for="edit-is-widget-custom-position-1" class="form-item__label option">Custom Position</label>
            </div>
        </div>
    </div>
      <!-- Position Settings -->
      <div class="form-group edit-is-widget-custom-position-0">
            <fieldset>
            <legend>Where would you like to place the accessibility icon on your site?</legend>
            <div class="icon-position-radios three-col">
            <!-- Top Left -->
                <div class="js-form-item form-item js-form-type-radio form-type-radio js-form-item-position form-item-position">
                    <input type="radio" name="position" id="aioaPositionTL" class="aioa-position" value="top_left" 
                        {{ $position == 'top_left' ? 'checked' : '' }}>
                    <label for="aioaPositionTL" style="font-weight:normal !important">Top Left</label>
                </div>
                <!-- Top Center -->
                <div class="js-form-item form-item js-form-type-radio form-type-radio js-form-item-position form-item-position">
                    <input type="radio" name="position" id="aioaPositionTC" class="aioa-position" value="top_center" 
                        {{ $position == 'top_center' ? 'checked' : '' }}>
                    <label for="aioaPositionTC" style="font-weight:normal !important">Top Center</label>
                </div>
                <!-- Top Right -->
                <div class="js-form-item form-item js-form-type-radio form-type-radio js-form-item-position form-item-position">
                    <input type="radio" name="position" id="aioaPositionTR" class="aioa-position" value="top_right" 
                        {{ $position == 'top_right' ? 'checked' : '' }}>
                    <label for="aioaPositionTR" style="font-weight:normal !important">Top Right</label>
                </div>
                <!-- Bottom Left -->
                <div class="js-form-item form-item js-form-type-radio form-type-radio js-form-item-position form-item-position">
                    <input type="radio" name="position" id="aioaPositionBL" class="aioa-position" value="bottom_left" 
                        {{ $position == 'bottom_left' ? 'checked' : '' }}>
                    <label for="aioaPositionBL" style="font-weight:normal !important">Bottom Left</label>
                </div>
                <!-- Bottom Right -->
                <div class="js-form-item form-item js-form-type-radio form-type-radio js-form-item-position form-item-position">
                    <input type="radio" name="position" id="aioaPositionBR" class="aioa-position" value="bottom_right" 
                        {{ $position == 'bottom_right' ? 'checked' : '' }}>
                    <label for="aioaPositionBR" style="font-weight:normal !important">Bottom Right</label>
                </div>
                <!-- Bottom Center -->
                <div class="js-form-item form-item js-form-type-radio form-type-radio js-form-item-position form-item-position">
                    <input type="radio" name="position" id="aioaPositionBC" class="aioa-position" value="bottom_center" 
                        {{ $position == 'bottom_center' ? 'checked' : '' }}>
                    <label for="aioaPositionBC" style="font-weight:normal !important">Bottom Center</label>
                </div>
                <!-- Middle Left -->
                <div class="js-form-item form-item js-form-type-radio form-type-radio js-form-item-position form-item-position">
                    <input type="radio" name="position" id="aioaPositionML" class="aioa-position" value="middle_left" 
                        {{ $position == 'middle_left' ? 'checked' : '' }}>
                    <label for="aioaPositionML" style="font-weight:normal !important">Middle Left</label>
                </div>
                <!-- Middle Right -->
                <div class="js-form-item form-item js-form-type-radio form-type-radio js-form-item-position form-item-position">
                    <input type="radio" name="position" id="aioaPositionMR" class="aioa-position" value="middle_right" 
                        {{ $position == 'middle_right' ? 'checked' : '' }}>
                    <label for="aioaPositionMR" style="font-weight:normal !important">Middle Right</label>
                </div>
            </div>
        </fieldset>
    </div>
      
      <!-- Custom Position Options -->
      
      <div class="form-group edit-is-widget-custom-position-1">
            <fieldset>
                <legend>Custom Position Options:</legend>
                    <div class="fieldset-wrapper">
                        <div class="horizontal-container js-form-wrapper form-wrapper" data-drupal-selector="edit-horizontal" id="edit-horizontal" style="display: flex">
                            <div class="js-form-item form-item js-form-type-textfield form-type--textfield js-form-item-widget-position-left form-item--widget-position-left">
                                <label for="edit-widget-position-left" class="form-label form-item__label" >Horizontal (px)</label>
                                    <input placeholder="Enter pixels" data-drupal-selector="edit-widget-position-left" type="number" id="widget_position_left" name="aioa_custom_position_horizontal" value="{{ $widget_position_left }}" size="10" maxlength="128" class="form-control form-element form-element--type-text form-element--api-textfield" oninput="this.value = Math.min(Math.max(this.value, 0), 250)">
                        </div>
                            <div class="js-form-item form-item js-form-type-select form-type--select js-form-item-widget-position-top form-item--widget-position-top">
                                <label for="edit-widget-position-top" class="form-label form-item__label">Position</label>
                                    <select data-drupal-selector="edit-widget-position-top" id="widget_position_top" name="aioa_custom_position_horizontal_type" class="form-select form-element form-element--type-select select-widget_position_top">
                                        <option value="left" {{ $widget_position_bottom == "left" ? 'selected' : '' }}>To the Left</option>
                                        <option value="right" {{ $widget_position_bottom == "right" ? 'selected' : '' }}>To the Right</option>
                                    </select>
                            </div>
                        </div>
                        <div class="vertical-container js-form-wrapper form-wrapper" data-drupal-selector="edit-vertical" id="edit-vertical" style="display: flex">
                            <div class="js-form-item form-item js-form-type-textfield form-type--textfield js-form-item-widget-position-right form-item--widget-position-right">
                                <label for="edit-widget-position-right" class="form-label form-item__label">Vertical (px)</label>
                                    <!-- Changed class from form-text to form-control to match the style of the Horizontal input -->
                                    <input placeholder="Enter pixels" data-drupal-selector="edit-widget-position-right" type="number" id="widget_position_right" name="aioa_custom_position_vertical" value="{{ $widget_position_right }}" size="10" maxlength="128" class="form-control form-element form-element--type-text form-element--api-textfield" oninput="this.value = Math.min(Math.max(this.value, 0), 250)">
                            </div>
                            <div class="js-form-item form-item js-form-type-select form-type--select js-form-item-widget-position-bottom form-item--widget-position-bottom">
                            <label for="edit-widget-position-bottom" class="form-label form-item__label">Position</label>
                                <select data-drupal-selector="edit-widget-position-bottom" id="widget_position_bottom" name="aioa_custom_position_vertical_type" class="form-select form-element form-element--type-select setting-widget_position_bottom">
                                    <option value="top"  {{ $widget_position_bottom == "top" ? 'selected' : '' }}>To the Top</option>
                                    <option value="bottom"  {{ $widget_position_bottom == "bottom" ? 'selected' : '' }}>To the Bottom</option>
                                </select>
                            </div>
                        </div>
                            <div id="edit-widget-size--wrapper--description" data-drupal-field-elements="description" class="fieldset__description mt-1">
                                0 - 250px are permitted values.
                        </div>
                    </div>
            </fieldset>
        </div>

      <!-- Widget Size Options -->
      <div class="form-group">
        <div class="form-radios">
          <h3>Select Widget Size:</h3>
          <div class="form-radio-item">
            <input type="radio" id="widget-size-regular" name="widget_size" value="0"
              class="form-radio form-boolean form-boolean--type-radio select-widget-size"
              {{ ($widget_size == '0') ? 'checked' : '' }}>
            <label for="widget-size-regular" class="form-item__label">Regular Size</label>
          </div>
          <div class="form-radio-item">
            <input type="radio" id="widget-size-large" name="widget_size" value="1"
              class="form-radio form-boolean form-boolean--type-radio select-widget-size"
              {{ ($widget_size == '1') ? 'checked' : '' }}>
            <label for="widget-size-large" class="form-item__label">Oversize</label>
          </div>
        </div>
      </div>
      
        <div class="form-group row icon common-class aioa-icon-type mb-0">
            <h3>Select icon type:</h3>
            <div class="col-sm-12">
              <div class="row">
                <!-- Include your radio buttons here -->
                <div class="col-auto mb-30">
                  <input type="radio" id="edit-type-1" name="icon_type" value="aioa-icon-type-1" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-1') ? 'checked' : '' }}>
                  <label for="edit-type-1" class="icon-label">
                    <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-1.svg" width="65" height="65" />
                    <span class="visually-hidden">Type 1</span>
                  </label>
                </div>
                <div class="col-auto mb-30">
                  <input type="radio" id="edit-type-2" name="icon_type" value="aioa-icon-type-2" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-2') ? 'checked' : '' }}>
                  <label for="edit-type-2" class="icon-label">
                    <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-2.svg"
                         width="65" height="65" />
                    <span class="visually-hidden">Type 2</span>
                  </label>
                </div>
                <div class="col-auto mb-30"> 
                  <input type="radio" id="edit-type-3" name="icon_type" value="aioa-icon-type-3" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-3') ? 'checked' : '' }}>
                  <label for="edit-type-3" class="icon-label">
                    <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-3.svg"
                         width="65" height="65" />
                    <span class="visually-hidden">Type 3</span>
                  </label>
                </div>
                <div class="col-auto mb-30">
                    <input type="radio" id="edit-type-4" name="icon_type" value="aioa-icon-type-4" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-4') ? 'checked' : '' }}>
                    <label for="edit-type-4" class="icon-label">
                      <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-4.svg"
                           width="65" height="65" />
                      <span class="visually-hidden">Type 4</span>
                    </label>
                  </div>
                <div class="col-auto mb-30">
                    <input type="radio" id="edit-type-5" name="icon_type" value="aioa-icon-type-5" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-5') ? 'checked' : '' }}>
                    <label for="edit-type-5" class="icon-label">
                      <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-5.svg"
                           width="65" height="65" />
                      <span class="visually-hidden">Type 5</span>
                    </label>
                </div>
                <div class="col-auto mb-30">
                    <input type="radio" id="edit-type-6" name="icon_type" value="aioa-icon-type-6" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-6') ? 'checked' : '' }}>
                    <label for="edit-type-6" class="icon-label">
                      <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-6.svg"
                           width="65" height="65" />
                      <span class="visually-hidden">Type 6</span>
                    </label>
                </div>
                <div class="col-auto mb-30">
                    <input type="radio" id="edit-type-7" name="icon_type" value="aioa-icon-type-7" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-7') ? 'checked' : '' }}>
                    <label for="edit-type-7" class="icon-label">
                      <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-7.svg"
                           width="65" height="65" />
                      <span class="visually-hidden">Type 7</span>
                    </label>
                </div>
                <div class="col-auto mb-30">
                    <input type="radio" id="edit-type-8" name="icon_type" value="aioa-icon-type-8" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-8') ? 'checked' : '' }}>
                    <label for="edit-type-8" class="icon-label">
                      <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-8.svg"
                           width="65" height="65" />
                      <span class="visually-hidden">Type 8</span>
                    </label>
                </div>
                <div class="col-auto mb-30">
                    <input type="radio" id="edit-type-9" name="icon_type" value="aioa-icon-type-9" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-9') ? 'checked' : '' }}>
                    <label for="edit-type-9" class="icon-label">
                      <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-9.svg"
                           width="65" height="65" />
                      <span class="visually-hidden">Type 9</span>
                    </label>
                </div>
                <div class="col-auto mb-30">
                    <input type="radio" id="edit-type-10" name="icon_type" value="aioa-icon-type-10" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-10') ? 'checked' : '' }}>
                    <label for="edit-type-10" class="icon-label">
                      <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-10.svg"
                           width="65" height="65" />
                      <span class="visually-hidden">Type 10</span>
                    </label>
                </div>
                <div class="col-auto mb-30">
                  <input type="radio" id="edit-type-11" name="icon_type" value="aioa-icon-type-11" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-11') ? 'checked' : '' }}>
                  <label for="edit-type-11" class="icon-label">
                    <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-11.svg"
                         width="65" height="65" />
                    <span class="visually-hidden">Type 11</span>
                  </label>
                </div>
                <div class="col-auto mb-30">
                  <input type="radio" id="edit-type-12" name="icon_type" value="aioa-icon-type-12" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-12') ? 'checked' : '' }}>
                  <label for="edit-type-12" class="icon-label">
                    <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-12.svg"
                         width="65" height="65" />
                    <span class="visually-hidden">Type 12</span>
                  </label>
                </div>
                <div class="col-auto mb-30">
                  <input type="radio" id="edit-type-13" name="icon_type" value="aioa-icon-type-13" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-13') ? 'checked' : '' }}>
                  <label for="edit-type-13" class="icon-label">
                    <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-13.svg"
                         width="65" height="65" />
                    <span class="visually-hidden">Type 13</span>
                  </label>
                </div>
                <div class="col-auto mb-30">
                  <input type="radio" id="edit-type-14" name="icon_type" value="aioa-icon-type-14" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-14') ? 'checked' : '' }}>
                  <label for="edit-type-14" class="icon-label">
                    <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-14.svg"
                         width="65" height="65" />
                    <span class="visually-hidden">Type 14</span>
                  </label>
                </div>
                <div class="col-auto mb-30">
                  <input type="radio" id="edit-type-15" name="icon_type" value="aioa-icon-type-15" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-15') ? 'checked' : '' }}>
                  <label for="edit-type-15" class="icon-label">
                    <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-15.svg"
                         width="65" height="65" />
                    <span class="visually-hidden">Type 15</span>
                  </label>
                </div>
                <div class="col-auto mb-30">
                  <input type="radio" id="edit-type-16" name="icon_type" value="aioa-icon-type-16" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-16') ? 'checked' : '' }}>
                  <label for="edit-type-16" class="icon-label">
                    <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-16.svg"
                         width="65" height="65" />
                    <span class="visually-hidden">Type 16</span>
                  </label>
                </div>
                <div class="col-auto mb-30">
                  <input type="radio" id="edit-type-17" name="icon_type" value="aioa-icon-type-17" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-17') ? 'checked' : '' }}>
                  <label for="edit-type-17" class="icon-label">
                    <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-17.svg"
                         width="65" height="65" />
                    <span class="visually-hidden">Type 17</span>
                  </label>
                </div>
                <div class="col-auto mb-30">
                  <input type="radio" id="edit-type-18" name="icon_type" value="aioa-icon-type-18" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-18') ? 'checked' : '' }}>
                  <label for="edit-type-18" class="icon-label">
                    <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-18.svg"
                         width="65" height="65" />
                    <span class="visually-hidden">Type 18</span>
                  </label>
                </div>
                <div class="col-auto mb-30">
                  <input type="radio" id="edit-type-19" name="icon_type" value="aioa-icon-type-19" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-19') ? 'checked' : '' }}>
                  <label for="edit-type-19" class="icon-label">
                    <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-19.svg"
                         width="65" height="65" />
                    <span class="visually-hidden">Type 19</span>
                  </label>
                </div>
                <div class="col-auto mb-30">
                  <input type="radio" id="edit-type-20" name="icon_type" value="aioa-icon-type-20" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-20') ? 'checked' : '' }}>
                  <label for="edit-type-20" class="icon-label">
                    <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-20.svg"
                         width="65" height="65" />
                    <span class="visually-hidden">Type 20</span>
                  </label>
                </div>
                <div class="col-auto mb-30">
                  <input type="radio" id="edit-type-21" name="icon_type" value="aioa-icon-type-21" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-21') ? 'checked' : '' }}>
                  <label for="edit-type-21" class="icon-label">
                    <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-21.svg"
                         width="65" height="65" />
                    <span class="visually-hidden">Type 21</span>
                  </label>
                </div>
                <div class="col-auto mb-30">
                    <input type="radio" id="edit-type-22" name="icon_type" value="aioa-icon-type-22" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-22') ? 'checked' : '' }}>
                    <label for="edit-type-22" class="icon-label">
                        <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-22.svg" width="65" height="65" />
                        <span class="visually-hidden">Type 22</span>
                    </label>
                </div>
                <div class="col-auto mb-30">
                    <input type="radio" id="edit-type-23" name="icon_type" value="aioa-icon-type-23" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-23') ? 'checked' : '' }}>
                    <label for="edit-type-23" class="icon-label">
                        <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-23.svg" width="65" height="65" />
                        <span class="visually-hidden">Type 23</span>
                    </label>
                </div>
                
                <div class="col-auto mb-30">
                    <input type="radio" id="edit-type-24" name="icon_type" value="aioa-icon-type-24" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-24') ? 'checked' : '' }}>
                    <label for="edit-type-24" class="icon-label">
                        <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-24.svg" width="65" height="65" />
                        <span class="visually-hidden">Type 24</span>
                    </label>
                </div>
                
                <div class="col-auto mb-30">
                    <input type="radio" id="edit-type-25" name="icon_type" value="aioa-icon-type-25" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-25') ? 'checked' : '' }}>
                    <label for="edit-type-25" class="icon-label">
                        <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-25.svg" width="65" height="65" />
                        <span class="visually-hidden">Type 25</span>
                    </label>
                </div>
                
                <div class="col-auto mb-30">
                    <input type="radio" id="edit-type-26" name="icon_type" value="aioa-icon-type-26" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-26') ? 'checked' : '' }}>
                    <label for="edit-type-26" class="icon-label">
                        <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-26.svg" width="65" height="65" />
                        <span class="visually-hidden">Type 26</span>
                    </label>
                </div>
                
                <div class="col-auto mb-30">
                    <input type="radio" id="edit-type-27" name="icon_type" value="aioa-icon-type-27" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-27') ? 'checked' : '' }}>
                    <label for="edit-type-27" class="icon-label">
                        <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-27.svg" width="65" height="65" />
                        <span class="visually-hidden">Type 27</span>
                    </label>
                </div>
                
                <div class="col-auto mb-30">
                    <input type="radio" id="edit-type-28" name="icon_type" value="aioa-icon-type-28" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-28') ? 'checked' : '' }}>
                    <label for="edit-type-28" class="icon-label">
                        <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-28.svg" width="65" height="65" />
                        <span class="visually-hidden">Type 28</span>
                    </label>
                </div>
                
                <div class="col-auto mb-30">
                    <input type="radio" id="edit-type-29" name="icon_type" value="aioa-icon-type-29" class="input-hidden icon_type" {{ ($icon_type == 'aioa-icon-type-29') ? 'checked' : '' }}>
                    <label for="edit-type-29" class="icon-label">
                        <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-29.svg" width="65" height="65" />
                        <span class="visually-hidden">Type 29</span>
                    </label>
                </div>
            </div>
        </div>
    </div>
    
        <!-- Added Fields After Select Icon Type Section -->
        <div class="form-group">
          <div class="form-radio-item">
            <h3>Widget Icon Size for Desktop:</h3>
            <div class="form-radios">
              <div id="edit-is-widget-custom-size" class="form-radio-item">
                <!-- Fixed Icon Size Option -->
                <div class="form-radio-item">
                  <input data-drupal-selector="edit-is-widget-custom-size-0" type="radio" id="edit-is-widget-custom-size-0" name="is_widget_custom_size"
                         value="0" class="form-radio form-boolean form-boolean--type-radio select-widget_custom_size" {{ $is_widget_custom_size == '0' ? 'checked' : '' }}>
                  <label for="edit-is-widget-custom-size-0" class="form-item__label option">Fixed Icon Size</label>
                </div>
                <!-- Custom Icon Size Option -->
                <div class="form-radio-item">
                  <input data-drupal-selector="edit-is-widget-custom-size-1" type="radio" id="edit-is-widget-custom-size-1" name="is_widget_custom_size"
                         value="1" class="form-radio form-boolean form-boolean--type-radio select-widget_custom_size" {{ $is_widget_custom_size == '1' ? 'checked' : '' }}>
                  <label for="edit-is-widget-custom-size-1" class="form-item__label option">Custom Icon Size</label>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group edit-is-widget-custom-size-1" style="display: none;">
            <h3>Custom Widget Icon Size for Desktop (px):</h3>
            <div>
              <input data-drupal-selector="edit-widget-icon-size-custom" aria-describedby="edit-widget-icon-size-custom--description" type="number" id="widget_icon_size_custom" name="widget_icon_size_custom"
                     value="20" step="1" min="20" max="150" placeholder="20" size="10"
                     class="form-control form-number form-element form-element--type-number form-element--api-number"
                     style="max-width: 85px;" oninput="this.value = Math.max(0, Math.min(this.value, 150))">
              <span id="edit-widget-icon-size-custom--description" class="form-item__description d-block">
                20-150 px are recommended values.
              </span>
            </div>
        </div>

        <div class="form-group row icon common-class edit-is-widget-custom-size-0 mb-0" style="display: none;">
          <h3>Fixed icon size:</h3>
          <div class="col-sm-12">
            <div class="row">
              <div class="col-auto mb-30">
                <input type="radio" id="edit-size-big" name="icon_size" value="aioa-big-icon" class="input-hidden aioa-iconsize">
                <label for="edit-size-big" class="icon-label">
                  <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-1.svg"
                       width="75" height="75" style="margin: auto" class="iconimg" />
                  <span class="visually-hidden">Big</span>
                </label>
              </div>
              <div class="col-auto mb-30">
                <input type="radio" id="edit-size-medium" name="icon_size" value="aioa-medium-icon" class="input-hidden aioa-iconsize">
                <label for="edit-size-medium" class="icon-label">
                  <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-1.svg"
                       width="65" height="65" style="margin: auto" class="iconimg" />
                  <span class="visually-hidden">Medium</span>
                </label>
              </div>
              <div class="col-auto mb-30">
                <input type="radio" id="edit-size-default" name="icon_size" value="aioa-default-icon" class="input-hidden aioa-iconsize">
                <label for="edit-size-default" class="icon-label">
                  <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-1.svg"
                       width="55" height="55" style="margin: auto" class="iconimg" />
                  <span class="visually-hidden">Default</span>
                </label>
              </div>
              <div class="col-auto mb-30">
                <input type="radio" id="edit-size-small" name="icon_size" value="aioa-small-icon" class="input-hidden aioa-iconsize">
                <label for="edit-size-small" class="icon-label">
                  <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-1.svg"
                       width="45" height="45" style="margin: auto" class="iconimg" />
                  <span class="visually-hidden">Small</span>
                </label>
              </div>
              <div class="col-auto mb-30">
                <input type="radio" id="edit-size-extra-small" name="icon_size" value="aioa-extra-small-icon" class="input-hidden aioa-iconsize">
                <label for="edit-size-extra-small" class="icon-label">
                  <img src="https://www.skynettechnologies.com/sites/default/files/aioa-icon-type-1.svg"
                       width="35" height="35" style="margin: auto" class="iconimg" />
                  <span class="visually-hidden">Extra Small</span>
                </label>
              </div>
            </div>
          </div>
        </div>

      <!-- Submit Button -->
      <div class="form-group">
        <button type="submit" class="btn btn-primary aioa-btn">Save Changes</button>
      </div>
    </form>
  </div>
</div>
<div id="loader">
    <div class="spinner"></div>
</div>
<script src="{{ asset('js/allinoneaccessibility.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>

@endsection