document.addEventListener('DOMContentLoaded', function () {

    const loader = document.getElementById('loader');
    // Function to show loader
    function showLoader() {
        loader.style.display = 'flex';
    }
    // Function to hide loader
    function hideLoader() {
        loader.style.display = 'none';
    }
    // Function to populate form fields dynamically from fetched settings
    function setWidgetData(widgetPosition, widgetColor, iconType, iconSize, widgetSize, widgetIconSizeCustom, is_widget_custom_size, is_widget_custom_position, widgetPositionTop, widgetPositionBottom, widgetPositionLeft, widgetPositionRight) {
        if (widgetColor) {
            const colorInput = document.getElementById("color");
            const colorPicker = document.getElementById("colorpicker");
            colorInput.value = widgetColor;
            colorPicker.value = widgetColor;
        }
        if (widgetPosition) {
            const positionRadio = document.querySelector(`.aioa-position[value="${widgetPosition}"]`);
            if (positionRadio) {
                positionRadio.checked = true;
            }
        }
        if (iconType) {
            const iconRadio = document.querySelector(`.icon_type[value="${iconType}"]`);
            if (iconRadio) {
                iconRadio.checked = true;
                const iconImg = "https://www.skynettechnologies.com/sites/default/files/" + iconType + ".svg";
                $(".iconimg").attr("src", iconImg);
            }
        }
        if (iconSize) {
            const iconSizeRadio = document.querySelector(`.aioa-iconsize[value="${iconSize}"]`);
            if (iconSizeRadio) {
                iconSizeRadio.checked = true;
            }
        }
        if (widgetSize) {
            const widgetSizeRadio = document.querySelector(`input[name="widget_size"][value="${widgetSize}"]`);
            if (widgetSizeRadio) {
                widgetSizeRadio.checked = true;
            }
        }

        if (widgetIconSizeCustom !== undefined && widgetIconSizeCustom !== "") {
            const iconSizeCustomInput = document.getElementById("widget_icon_size_custom");
            if (iconSizeCustomInput) {
                iconSizeCustomInput.value = widgetIconSizeCustom; // Set the custom size
            }
        }

        if (is_widget_custom_position !== undefined) {

            // Set the correct radio checked
            document.querySelectorAll('input[name="is_widget_custom_position"]').forEach(input => {
                input.checked = input.value === String(is_widget_custom_position);
            });
            // Show/Hide sections based on value
            if (String(is_widget_custom_position) === "1") {
                // Custom Position Mode
                document.querySelector('.edit-is-widget-custom-position-1')?.style.setProperty("display", "block");
                document.querySelector('.edit-is-widget-custom-position-0')?.style.setProperty("display", "none");
            } else {
                // Fixed Position Mode
                document.querySelector('.edit-is-widget-custom-position-0')?.style.setProperty("display", "block");
                document.querySelector('.edit-is-widget-custom-position-1')?.style.setProperty("display", "none");
            }
        }

        if (is_widget_custom_size !== undefined) {
            document.querySelectorAll('input[name="is_widget_custom_size"]').forEach(input => {
                input.checked = input.value === String(is_widget_custom_size);
            });

            // Show/Hide sections based on the saved value
            if (String(is_widget_custom_size) === "1") {
                // Custom Size Mode
                document.querySelector('.edit-is-widget-custom-size-1')?.style.setProperty("display", "block");
                document.querySelector('.edit-is-widget-custom-size-0')?.style.setProperty("display", "none");
            } else {
                // Standard Size Mode
                document.querySelector('.edit-is-widget-custom-size-0')?.style.setProperty("display", "block");
                document.querySelector('.edit-is-widget-custom-size-1')?.style.setProperty("display", "none");
            }
        }

        if (widgetPositionLeft !== undefined && widgetPositionLeft !== null) {
            const positionHorizontal = document.querySelector('[name="aioa_custom_position_horizontal"]');
            if (positionHorizontal) {
                positionHorizontal.value = widgetPositionLeft;
            }

            const positionHorizontalType = document.querySelector('[name="aioa_custom_position_horizontal_type"]');
            if (positionHorizontalType) {
                positionHorizontalType.value = "left";
            }
        }

        if (widgetPositionRight !== undefined && widgetPositionRight !== null) {
            const positionHorizontal = document.querySelector('[name="aioa_custom_position_horizontal"]');
            if (positionHorizontal) {
                positionHorizontal.value = widgetPositionRight;
            }

            const positionHorizontalType = document.querySelector('[name="aioa_custom_position_horizontal_type"]');
            if (positionHorizontalType) {
                positionHorizontalType.value = "right";
            }
        }

        // Set Vertical Position: Top / Bottom
        if (widgetPositionTop !== undefined && widgetPositionTop !== null) {
            const positionVerticalType = document.querySelector('[name="aioa_custom_position_vertical_type"]');
            if (positionVerticalType) {
                positionVerticalType.value = "top";
            }
            const widgetPositionBottom = document.getElementById('widget_position_bottom');
            if (widgetPositionBottom) widgetPositionBottom.value = "";
        }

        if (widgetPositionBottom !== undefined && widgetPositionBottom !== null) {
            const positionVerticalType = document.querySelector('[name="aioa_custom_position_vertical_type"]');
            if (positionVerticalType) {
                positionVerticalType.value = "bottom";
            }
            const widgetPositionTop = document.getElementById('widget_position_top');
            if (widgetPositionTop) widgetPositionTop.value = "";
        }

        const horizontalInput = document.querySelector('[name="aioa_custom_position_horizontal"]');
        const horizontalType = document.querySelector('[name="aioa_custom_position_horizontal_type"]');

        if (widgetPositionLeft !== undefined && widgetPositionLeft !== null && widgetPositionLeft !== "") {
            horizontalInput.value = widgetPositionLeft;
            horizontalType.value = "left";
        }
        else if (widgetPositionRight !== undefined && widgetPositionRight !== null && widgetPositionRight !== "") {
            horizontalInput.value = widgetPositionRight;
            horizontalType.value = "right";
        }

        const verticalInput = document.querySelector('[name="aioa_custom_position_vertical"]');
        const verticalType = document.querySelector('[name="aioa_custom_position_vertical_type"]');

        if (widgetPositionTop !== undefined && widgetPositionTop !== null && widgetPositionTop !== "") {
            verticalInput.value = widgetPositionTop;
            verticalType.value = "top";
        }
        else if (widgetPositionBottom !== undefined && widgetPositionBottom !== null && widgetPositionBottom !== "") {
            verticalInput.value = widgetPositionBottom;
            verticalType.value = "bottom";
        }


        const positionHorizontalTextBox = document.querySelector('[name="aioa_custom_position_horizontal"]');
        if (positionHorizontalTextBox) {
            const positionHorizontalTextBox = document.querySelector('[name="aioa_custom_position_horizontal"]');
            var custom_position_horizontal_type = document.querySelector('select[name="aioa_custom_position_horizontal_type"]').value;
            if(custom_position_horizontal_type=='left'){
                positionHorizontalTextBox.value = widgetPositionLeft;
            }
            else if(custom_position_horizontal_type=='right') {
                positionHorizontalTextBox.value = widgetPositionRight;
            }
        }

        const positionVerticalTextBox = document.querySelector('[name="aioa_custom_position_vertical"]');
        if (positionVerticalTextBox) {
            const positionVerticalTextBox = document.querySelector('[name="aioa_custom_position_vertical"]');
            var custom_position_vertical_type = document.querySelector('select[name="aioa_custom_position_vertical_type"]').value;
            if(custom_position_vertical_type=='bottom'){
                positionVerticalTextBox.value = widgetPositionBottom;
            }
            else if(custom_position_vertical_type=='top') {
                positionVerticalTextBox.value = widgetPositionTop;
            }
        }

    }
    const defaultValues = {
        widgetPosition: "bottom_right",
        widgetColor: "#420083",
        iconType: "aioa-icon-type-1",
        iconSize: "aioa-small-icon",
        widgetSize: "",
        widgetIconSizeCustom: "",
        is_widget_custom_size: "0",
        is_widget_custom_position: "0",
        widgetPositionTop: "",
        widgetPositionBottom: "",
        widgetPositionLeft: "",
        widgetPositionRight: ""
    };
    const domain_name = window.location.hostname; //window.location.host;
    if (domain_name && domain_name !== '') {
        // Show loader before fetching data
        showLoader();
        // If domain_name is present, fetch from the external API
        const apiUrl = "https://ada.skynettechnologies.us/api/widget-settings";   // Fetch Widget Data from the Dashboard
        fetch(apiUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                website_url: domain_name
            })
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json(); // Parse JSON response
            })
            .then((data) => {
                // Extract widget position and other settings from the API response
                const widgetPosition = data.Data?.widget_position || defaultValues.widgetPosition;
                const widgetColor = data.Data?.widget_color_code || defaultValues.widgetColor;
                const iconType = data.Data?.widget_icon_type || defaultValues.iconType;
                const iconSize = data.Data?.widget_icon_size || defaultValues.iconSize;
                const widgetSize = data.Data?.widget_size || defaultValues.widgetSize;
                const widgetIconSizeCustom = data.Data?.widget_icon_size_custom || defaultValues.widgetIconSizeCustom;
                const is_widget_custom_size = data.Data?.is_widget_custom_size || defaultValues.is_widget_custom_size;
                const is_widget_custom_position = data.Data?.is_widget_custom_position || defaultValues.is_widget_custom_position;
                const widgetPositionTop = data.Data?.widget_position_top;
                const widgetPositionBottom = data.Data?.widget_position_bottom;
                const widgetPositionLeft = data.Data?.widget_position_left;
                const widgetPositionRight = data.Data?.widget_position_right;
                setWidgetData(
                    widgetPosition,
                    widgetColor,
                    iconType,
                    iconSize,
                    widgetSize,
                    widgetIconSizeCustom,
                    is_widget_custom_size,
                    is_widget_custom_position,
                    widgetPositionTop,
                    widgetPositionBottom,
                    widgetPositionLeft,
                    widgetPositionRight
                );
            })
            .catch((error) => {
                console.error("Error fetching widget position:", error);
            })
            .finally(() => {
                // Hide loader after fetching data is complete (success or error)
                hideLoader();
            });
    }
    else {
        // If domain_name is not valid, set default values
        setWidgetData(
            defaultValues.widgetPosition,
            defaultValues.widgetColor,
            defaultValues.iconType,
            defaultValues.iconSize,
            defaultValues.widgetSize,
            defaultValues.widgetIconSizeCustom,
            defaultValues.widgetPositionTop,
            defaultValues.widgetPositionBottom,
            defaultValues.widgetPositionLeft,
            defaultValues.widgetPositionRight
        );
    }
    $('.colorpicker').on('input', function () {
        $('.colorint').val(this.value);
    });
    $('.colorint').on('input', function () {
        $('.colorpicker').val(this.value);
    });

    $(".icon_type").change(function () {
        var icon_type = $(this).val(); // Get the selected icon type value
        var iconImg = "https://www.skynettechnologies.com/sites/default/files/" + icon_type + ".svg";
        $(".iconimg").attr("src", iconImg); // Update the icon image source
    });

    document.getElementById('form-module').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission behavior
        // Collect form data
        document.getElementById('loader').style.display = 'flex';
        var color = document.getElementById("color").value;
        var positionVal = document.querySelector('.aioa-position:checked').value;
        var icon_typeVal = document.querySelector('.icon_type:checked').value;
        var icon_sizeVal = document.querySelector('.aioa-iconsize:checked').value;
        // var is_widget_custom_position = document.querySelector('input[name="is_widget_custom_position"]:checked').value;
        var custom_position_horizontal = document.querySelector('input[name="aioa_custom_position_horizontal"]').value;
        var custom_position_vertical = document.querySelector('input[name="aioa_custom_position_vertical"]').value;
        var custom_position_horizontal_type = document.querySelector('select[name="aioa_custom_position_horizontal_type"]').value;
        var custom_position_vertical_type = document.querySelector('select[name="aioa_custom_position_vertical_type"]').value;
        var widget_size = document.querySelector('.select-widget-size:checked').value;
        var widget_position_left=(custom_position_horizontal_type==="left")?custom_position_horizontal:"";
        var widget_position_right=(custom_position_horizontal_type==="right")?custom_position_horizontal:"";
        var widget_position_top=(custom_position_vertical_type==="top")?custom_position_vertical:"";
        var widget_position_bottom=(custom_position_vertical_type==="bottom")?custom_position_vertical:"";
        var is_widget_custom_position = document.querySelector('input[name="is_widget_custom_position"]:checked')?.value || '0';
        var is_widget_custom_size = document.querySelector('input[name="is_widget_custom_size"]:checked')?.value || '0';

        if (is_widget_custom_size == 1) {
            const customSizeInput = document.getElementById("widget_icon_size_custom");
            const customSize = parseInt(customSizeInput.value, 10);
            if (isNaN(customSize) || customSize < 20 || customSize > 150) {
                alert("Icon size must be between 20 and 150 px.");
                document.getElementById('loader').style.display = 'none';
                customSizeInput.focus();
                return;
            }
        }

        console.log("Custom Size:", is_widget_custom_size, "Custom Position:", is_widget_custom_position);
        if (is_widget_custom_size == 1) {
            var widget_icon_size_custom = document.getElementById("widget_icon_size_custom").value;
        }
        var user_name = document.getElementById("user_name").value;  // You could also dynamically set this from JS
        var email = document.getElementById("email").value;

        var  domain_name = window.location.hostname;//window.location.host;
        var payload = {
            u: domain_name,
            widget_position: positionVal,
            is_widget_custom_position: is_widget_custom_position,
            is_widget_custom_size: is_widget_custom_size,
            widget_color_code: color,
            widget_icon_type: icon_typeVal,
            widget_icon_size: icon_sizeVal,
            widget_size: widget_size,
            widget_icon_size_custom: widget_icon_size_custom,
            widget_position_right: widget_position_right,
            widget_position_left: widget_position_left,
            widget_position_top: widget_position_top,
            widget_position_bottom: widget_position_bottom
        };

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'https://ada.skynettechnologies.us/api/widget-setting-update-platform', true);
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onload = function () {
            document.getElementById('loader').style.display = 'none';
            if (xhr.status === 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    alert(response.msg || "Settings updated successfully!");
                    location.reload();
                } catch (e) {
                    console.error('Invalid JSON response:', xhr.responseText);
                    alert("Settings saved, but response format is invalid.");
                }
            } else {
                console.error('HTTP Error:', xhr.status, xhr.statusText);
                alert("Error: Unable to update settings.");
            }
        };
        xhr.onerror = function () {
            document.getElementById('loader').style.display = 'none';
            alert("Network error. Please check your internet connection.");
        };
        xhr.send(JSON.stringify(payload));
    });

    const sizeOptions = document.querySelectorAll('input[name="icon_size"]');
    const sizeOptionsImg = document.querySelectorAll('input[name="icon_size"] + label img');
    const typeOptions = document.querySelectorAll('input[name="icon_type"]');

    sizeOptionsImg.forEach(option2 => {
        var ico_type = document.querySelector('input[name="icon_type"]:checked').value;
        option2.setAttribute("src", "https://www.skynettechnologies.com/sites/default/files/" + ico_type + ".svg");
    });

    typeOptions.forEach(option => {
        option.addEventListener("click", (event) => {
            sizeOptionsImg.forEach(option2 => {
                var ico_type = document.querySelector('input[name="icon_type"]:checked').value;
                option2.setAttribute("src", "https://www.skynettechnologies.com/sites/default/files/" + ico_type + ".svg");
            });
        });
    });

    function position_options(a) {
        if (a == 0) {
            document.querySelector('.edit-is-widget-custom-position-1').style.display = "none";
            document.querySelector('.edit-is-widget-custom-position-0').style.display = "block";
        } else {
            document.querySelector('.edit-is-widget-custom-position-0').style.display = "none";
            document.querySelector('.edit-is-widget-custom-position-1').style.display = "block";
        }
    }
    position_options(document.querySelector('input[name="is_widget_custom_position"]:checked').value);
    const positionOptions = document.querySelectorAll('input[name="is_widget_custom_position"]');
    positionOptions.forEach(option => {
        option.addEventListener("click", (event) => {
            position_options(event.target.value);
            // Add your custom logic here
        });
    });


    function size_options(a) {
        if (a == 0) {
            document.querySelector('.edit-is-widget-custom-size-1').style.display = "none";
            document.querySelector('.edit-is-widget-custom-size-0').style.display = "block";
        } else {
            document.querySelector('.edit-is-widget-custom-size-0').style.display = "none";
            document.querySelector('.edit-is-widget-custom-size-1').style.display = "block";
        }
    }
    size_options(document.querySelector('input[name="is_widget_custom_size"]:checked').value);
    const widgetIconSizeOptions = document.querySelectorAll('input[name="is_widget_custom_size"]');
    widgetIconSizeOptions.forEach(option => {
        option.addEventListener("click", (event) => {
            size_options(event.target.value);
            // Add your custom logic here
        });
    });
});
