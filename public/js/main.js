$(function () {
    $(document).scroll(function () {
        const nav = $(".navbar");
        const nav_link = $('.nav-link'); 
        const navbar_collapse = $('.navbar-collapse');
        nav.toggleClass('scrolled', $(this).scrollTop() > nav.height());
        nav_link.toggleClass('scrolled', $(this).scrollTop() > nav.height());
        navbar_collapse.toggleClass('scrolled', $(this).scrollTop() > nav.height());
    });

    $('.carousel').carousel({
        interval: 6000,
        pause: "false"
    });

    $('#country').select2({
        width:'100%',
        placeholder:'Select Country',
    });
    $('#document_type').select2({
        width:'100%',
        placeholder:'Select Document',
    });
    $('#document_delivery_option').select2({
        width:'100%',
        placeholder:'Select document delivery option',
    });



     
     $('#post_code').on('input', function() {
        var inputValue = $(this).val();
        if (/\D/.test(inputValue)) {
            $('.post-input-err').show();
            $(this).val($(this).val().replace(/\D/g, ''));
        } else {

            $('.post-input-err').hide();
        }
    });


    $('#post_code').on('paste', function(e) {

        e.preventDefault();
        var currentVal = $(this).val();
        var pastedText = (e.originalEvent || e).clipboardData.getData('text/plain');

        if (/^\d+$/.test(pastedText)) {
            $(this).val(currentVal+pastedText);
        }
        else {
            $(this).val(currentVal);
            $('.post-input-err').show();
        }
    });

    var imgPreview = document.getElementById("previewImg");

    var brightness = $('#brightness_range').val();
    var contrast = $('#contrast_range').val();
    var saturation = $('#saturation_range').val();

    function updateFilterAndLog() {

        brightness = $('#brightness_range').val();
        contrast = $('#contrast_range').val();
        saturation = $('#saturation_range').val();
    
        var filterValue = `brightness(${brightness}%) contrast(${contrast}%) saturate(${saturation}%)`;
    
        imgPreview.style.filter = filterValue;
    }

    $("#save_img").on("click", function() {
        const canvas = document.createElement("canvas");
        const ctx = canvas.getContext("2d");
        canvas.width = imgPreview.naturalWidth;
        canvas.height = imgPreview.naturalHeight;
    
        ctx.filter = `brightness(${brightness}%) contrast(${contrast}%) saturate(${saturation}%)`;
        ctx.drawImage(imgPreview, 0, 0, canvas.width, canvas.height);
    
        const link = document.createElement("a");
        link.download = "image.jpg";
        link.href = canvas.toDataURL();
        link.click();
    });

    var slider = document.getElementById("brightness_range");
    var output = document.getElementById("brightness_range_value");

    if (slider) {
        slider.oninput = function() {
            output.innerHTML = (this.value) + '%';
            updateFilterAndLog();

        };
    }
    
    $(document).on('click', '.filter_buttons', function() {
        $('.filter_buttons').removeClass('active');
        $('.range_section').addClass('d-none');
    
        var slider_show = '.' + $(this).attr('id') + '_range_section';
        $(slider_show).removeClass('d-none');
        $(this).addClass('active');
    
        var slider_id = $(this).attr('id')+'_range';
        var slider_output = $(this).attr('id')+'_range_value';
        var slider = document.getElementById(slider_id);
        var output = document.getElementById(slider_output);
    
        slider.oninput = function() {
            output.innerHTML = (this.value)+'%';
    
            updateFilterAndLog();
        };
    });
    
    var nextCountrySpan = $('.country.is-invalid').next('.select2-container');
    if(nextCountrySpan) {
        nextCountrySpan.css({
            'border': '1px solid #dc3545',
            'border-radius': '25px'
        });
    }

    var nextDpcumentSpan = $('.document_type.is-invalid').next('.select2-container');
    if(nextDpcumentSpan) {
        nextDpcumentSpan.css({
            'border': '1px solid #dc3545',
            'border-radius': '25px'
        });
    }

    $(document).ready(function(){

        var countryCode = '';
        $.get("https://ipinfo.io/json", function(response) {
            countryCode = response.country;
            
            $('#country').val(countryCode).trigger('change');
        });

        countryCode =  $('#country').val();
        if(countryCode) {
            var countryText = $(e.currentTarget).find(':selected').text();
            $('#country_text').val(countryText);

            getDocumentTypes(countryCode);
        }




        function getDocumentTypes(countryCode) {
            $.ajax({
                url: 'getDocTypes/'+countryCode, 
                type: 'GET',
                success: function(response) {
                    if(response.success) {
                        var data = response.data;
                        var selected = '';
                        var select_doc = $("#document_type");
                        select_doc.find("option:not(:first)").remove();
                        for (var i = 0; i < data.length; i++) {
                            var optionText = data[i].doc_name;
                            var optionValue = data[i].doc_code;
                            // if(old('document_type') == optionValue) {
                            //     selected = 'selected';
                            // }
                            var option = $('<option>').text(optionText).val(optionValue);
                            
                            select_doc.append(option);
                        }

                        var docTypeVal = $('#input_doc_type_val').val();
                        if(docTypeVal) {
                            $('.img-upload-instructions').show();
                            $("#document_type").val(docTypeVal).trigger("change");;
                        } else {
                            $('#image_upload_btn').css({'opacity':0.6,'cursor':'context-menu'});
                            $('#image_upload').attr('disabled');

                            $('.img-upload-instructions').hide();
                        }
                        
                    } else {
                        console.log(response.message);
                    }
                    
                    
                   
                },
                error: function(xhr, status, error) {
                  console.error('Error:', error);
                }
            });
        }


        $(document).on('change','#country', function (e) {
            e.preventDefault();
            
            countryCode = $(this).val();
            if (countryCode) {
                var countryText = $(e.currentTarget).find(':selected').text();
                $('#country_text').val(countryText);

                getDocumentTypes(countryCode);
            }
             
        });

        // var word = /([-+]?[0-9]*\.?[0-9]+[\/\+\-\x])+([-+]?[0-9]*\.?[0-9]+)/gm;
        // $("#document_type").on("change", function() {
        //     var content = $('option:selected', this).text().replace(",", "");
        //     var match = word.exec(content);
        //     /* text.replace("Microsoft", "W3Schools") */
        //     console.log(content);
        //     console.log(match);
        //     if (match) {
        //         var total = match[0];
        //         var width = match[1].replace("x", "");
        //         var height = match[2].replace("x", "");
        //         console.log(total + '<br>' + width + '<br>' + height);
        //         // $("#result").html(total + '<br>' + width + '<br>' + height);
        //     }
        // });

        $(document).on('change','#document_type', function(e){

            $('#image_upload_btn').css({'opacity':1,'cursor':'pointer'});
            $('#image_upload').removeAttr('disabled');
            $('.img-upload-instructions').show();

            var documentTypeText = $(e.currentTarget).find(':selected').text();
            $('#document_type_text').val(documentTypeText);
          
        });
            
        var hexColorVal = $('#image-bg-color').val();
        var rgbColorVal = hexToRgb(hexColorVal);
        if(hexColorVal) {
            hexColorVal = hexColorVal.toUpperCase();
        }
        $('#hex-val-ref').val(hexColorVal);
        $('#rgb-val-ref').val(rgbColorVal);

        

        function hexToRgb(hex) {
            // Check if the hex color code is valid
            const hexRegex = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i;
            const result = hexRegex.exec(hex);
            if (!result) {
                return "Invalid Hex Color Code";
            }

            const r = parseInt(result[1], 16);
            const g = parseInt(result[2], 16);
            const b = parseInt(result[3], 16);
            return `rgb(${r}, ${g}, ${b})`;
        }



        $('#document_delivery_option').change(function(){
            
        });

        $('#details_form').submit(function(event){
            event.preventDefault();
            var delivery_option_val = $('#document_delivery_option').val();

            var delivery_option_text = $('#document_delivery_option').find("option:selected").text();

            if(!delivery_option_val) {
                
                $('#delivery_option_error').removeClass('d-none');
            } else {
                $('#delivery_option_error').addClass('d-none');

                
                const canvas = document.createElement("canvas");
                const ctx = canvas.getContext("2d");
                canvas.width = imgPreview.naturalWidth;
                canvas.height = imgPreview.naturalHeight;
            
                ctx.filter = `brightness(${brightness}%) contrast(${contrast}%) saturate(${saturation}%)`;
                ctx.drawImage(imgPreview, 0, 0, canvas.width, canvas.height);

                const image = canvas.toDataURL();
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: 'save-img-session',
                    data: { 
                        image: image,
                        delivery_option_val: delivery_option_val,
                        delivery_option_text: delivery_option_text
                     },
                    success: function(response) {
                        
                        console.log(response.message);
                        if(response.redirect_url) {
                            window.location.href = response.redirect_url;
                        }

                    },
                    error: function(xhr, status, error) {
                        
                        console.error('Error:', status, error);
                    }
                });
            }
        });
    });


    
});