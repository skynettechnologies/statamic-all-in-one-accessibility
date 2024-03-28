@extends('statamic::layout')
@section('title', __('All in One Accessibility™'))
@section('wrapper_class', 'max-w-3xl')

<style>
    .get-strated-btn, .get-strated-btn:hover {
        background-color: #2855d3;
        color: white !important;
        padding: 5px 5px;
        text-decoration: none;
        }

    .aioa-cancel-button {
        text-decoration: none;
        display: inline-block;
        vertical-align: middle;
        border: 2px solid #420083;
        border-radius: 4px 4px 4px 4px;
        background-color: #420083;
        box-shadow: 0px 0px 2px 0px #333333;
        color: #ffffff !important;
        text-align: center;
        box-sizing: border-box;
        padding: 10px;
        color: white;
    }
    .aioa-cancel-button:hover {
        color: white !important;
        border-color: #420083;
        background-color: #420083;
        box-shadow: 0px 0px 2px 0px #333333;
    }

    .aioa-cancel-button:hover .mb-text {
        color: white;
    }

    .container {
  height: 200px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.center{
    height: 300px;
            width: 645px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid black;
}

.item {
  width: 10em;
}
    
    
</style>
@section('content')

@php
// Use cURL to fetch the dynamic iframe URL
$iframe_url = ""; // Default URL
$status = 0;
$curl = curl_init();

if ($curl) {
    $curl = curl_init();
    curl_setopt_array(
        $curl,
        array(
            CURLOPT_URL => 'https://ada.skynettechnologies.us/check-website',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
//            CURLOPT_POSTFIELDS => array('domain' => $_SERVER['SERVER_NAME']),
           CURLOPT_POSTFIELDS => array('domain' => "https://statamic.skynettechnologies.us/"),
        )
    );
    $response = curl_exec($curl);
    curl_close($curl);
    $settingURLObject = json_decode($response); @endphp
    @php
        //print_r($settingURLObject);
    if (isset($settingURLObject->status) && $settingURLObject->status == 3) {
        $iframe_url = $settingURLObject->settinglink;
        $status = $settingURLObject->status;
      //  echo $settingURLObject->settinglink;
    } else if (isset($settingURLObject->status) && $settingURLObject->status > 0 && $settingURLObject->status < 3) {
        $iframe_url = $settingURLObject->settinglink;
        $status = $settingURLObject->status;
  //      echo $status;
//        echo $settingURLObject->settinglink;
    } else {
        $iframe_url = "https://ada.skynettechnologies.us/trial-subscription?isframe=true&website=" . $_SERVER['SERVER_NAME']."&developer_mode=true";
  //      echo "$iframe_url";
    }
    // echo "$settingURLObject\n";
}
@endphp
    <div class="all-in-one-accessibility">
    <!-- <h1>{{ $title }}</h1> -->
    <!-- <img src="https://ada.skynettechnologies.us/public/trial-assets/images/all-in-one-accessibility-logo.svg" alt="All in One Accessibility - Skynet Technologies"> -->
    <!-- <p>{{ $content }}</p> -->
    @if ($status == 3)
        <img src="https://ada.skynettechnologies.us/public/trial-assets/images/all-in-one-accessibility-logo.svg" alt="All in One Accessibility - Skynet Technologies">
        <div class="container">
            <div style="text-align: left; width:100%; padding-bottom: 10px;">
                <h3 style="color: #aa1111">It appears that you have already registered! Please click on the "Manage Subscription" button to renew your subscription.
                <br> Once your plan is renewed, please refresh the page.</h3>
                <br>
                <a target="_blank" class="aioa-cancel-button"  href="<?php echo $iframe_url;?>">Manage Subscription</a>
            </div>
        </div>
    @elseif ($status == 2)
        <img src="https://ada.skynettechnologies.us/public/trial-assets/images/all-in-one-accessibility-logo.svg" alt="All in One Accessibility - Skynet Technologies">
        <br>
        <div>
            <a target="_blank" class="aioa-cancel-button"  href="<?php echo $iframe_url;?>">Manage Subscription</a>
        </div>
        <br>
        <iframe id="iframe-settings" src="{{ $iframe_url }}" style="width: 100%;"></iframe>
    @else
        <iframe id="iframe-settings" src="{{ $iframe_url }}" style="width: 100%;"></iframe>
        </div>
    @endif

<script>
    document.getElementById('iframe-settings').src = '{{ $iframe_url }}';
    // Adjust iframe size to match the page
    function resizeIframe() {
        var buffer = 20; //scroll bar buffer
        var iframe = document.getElementById('iframe-settings');
        function pageY(elem) {
            return elem.offsetParent ? (elem.offsetTop + pageY(elem.offsetParent)) : elem.offsetTop;
        }
        function resizeIframe() {
            var height = document.documentElement.clientHeight;
            height -= pageY(document.getElementById('iframe-settings')) + buffer;
            height = (height < 0) ? 0 : height;
            document.getElementById('iframe-settings').style.height = height + 'px';
        }
        // .onload doesn't work with IE8 and older.
        if (iframe.attachEvent) {
            iframe.attachEvent("onload", resizeIframe);
        } else {
            iframe.onload = resizeIframe;
        }
        window.onresize = resizeIframe;
    }
    setTimeout(function() {
        resizeIframe();
    }, 5000);
    window.onresize = resizeIframe;
</script>

@endsection