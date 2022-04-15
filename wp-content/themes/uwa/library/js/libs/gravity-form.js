// Wait for the DOM to be ready
document.addEventListener("DOMContentLoaded", function(event) {

    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/;" + "SameSite=None; Secure";
    }
  
    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    } 
  
    function setcookie_from_utm() {
        console.log('here')
        var theURL = window.location.href;
        console.log(theURL) 
        var splitURL = theURL.split('?'); 
        if (splitURL.length>1 ){ 
            console.log('here')
            var splitVars = splitURL[1].split('&'); 
            for(var i = 0; i < splitVars.length; i++){ 
                splitPair = splitVars[i].split('='); 
                setCookie(splitPair[0],splitPair[1])
                console.table(splitPair)
                //params[splitPair[0]] = splitPair[1]; }
            }
            //return params;
        }
        return false;
    }
  
    setcookie_from_utm();

    // Random orderID value
    function myorderid () {
        now = new Date();
        year = "" + now.getFullYear();
        month = "" + (now.getMonth() + 1); if (month.length == 1) { month = "0" + month; }
        day = "" + now.getDate(); if (day.length == 1) { day = "0" + day; }
        hour = "" + now.getHours(); if (hour.length == 1) { hour = "0" + hour; }
        minute = "" + now.getMinutes(); if (minute.length == 1) { minute = "0" + minute; }
        second = "" + now.getSeconds(); if (second.length == 1) { second = "0" + second; }
        return year+month+day+hour+minute+second+Math.floor(Math.random() * 1,999);
    }

    // OrderID field
    var orderID = myorderid(),
        orderID_el = $("#input_1_32");
    // console.log(orderID);
    if (orderID_el.length) {
        document.getElementById("input_1_32").value = orderID;
    }
    

    // FormSource field
    var formSource = window.location.href.split('?')[0],
        formSource_el = $("#input_1_119");
    // console.log(formSource);
    if (formSource_el.length) {
        document.getElementById("input_1_119").value = formSource;
    }

    // IP address from PHP
    var IP_el = $("#input_1_41");
    // console.log(user_ip);
    if (IP_el.length) {
        document.getElementById("input_1_41").value = user_ip;
    }
    
    // Form schmea
    // Left key is Gravity forms name of label
    // Right value is SRP key
    var schema = {
        "input_85": "prospectType",
        "input_1": "parentGuardianFirstName",
        "input_72": "parentGuardianLastName",
        "input_5": "parentGuardianEmail",
        "input_4": "parentGuardianPhone",

        "input_81": "firstName",
        "input_82": "lastName",
        "input_83": "email",
        "input_84": "phone",
        
        "input_90": "streetAddress",
        "input_33": "country",

        // "input_123": "city",
        "input_126": "state",
        // "input_124": "postalCode",	

        "input_92": "program",
        "input_89": "anticipatedHighSchoolGraduationYear",
        "input_87": "termOfEntry",
        "input_69": "yearOfEntry",
        "input_55": "okToText",
        
        "input_103": "accountId",
        "input_32": "orderId",
        
        "input_21": "utm_medium",
        "input_38": "utm_term",
        "input_24": "utm_campaign",
        "input_39": "utm_content",
        "input_23": "utm_source",

        "input_36": "uadgroup",
        "input_37": "uAdCampgn",
        "input_29": "referrer",

        "input_40": "gclid",
        "input_104": "gbraid",
        "input_105": "gaUaId",
        "input_106": "gaClientId",
        "input_107": "gaUserId",

        "input_41": "ip",
        "input_42": "mkt1",
        "input_108": "tId",
        "input_110": "event",
        "input_109": "partnership",
        "input_111": "promotion",
        "input_112": "imService",
        "input_113": "imName",
        "input_114": "webSchedulerStatus",
        "input_115": "isLandingPage",
        "input_116": "company",
        "input_117": "ae",
        "input_118": "wbraid",
        
        "input_119": "formSource",
        "input_22": "cmgfrm",
        "input_64": "leadbuyerid",
        "input_120": "militaryAffiliated",
    }
  
    function checkutm_values() {
        utm_map = {
            "input_55": "okToText",
        
            "input_103": "accountId",
            "input_32": "orderId",
            
            "input_21": "utm_medium",
            "input_38": "utm_term",
            "input_24": "utm_campaign",
            "input_39": "utm_content",
            "input_23": "utm_source",

            "input_36": "uadgroup",
            "input_37": "uAdCampgn",
            "input_29": "referrer",

            "input_40": "gclid",
            "input_104": "gbraid",
            "input_105": "gaUaId",
            "input_106": "gaClientId",
            "input_107": "gaUserId",

            "input_41": "ip",
            "input_42": "mkt1",
            "input_108": "tId",
            "input_110": "event",
            "input_109": "partnership",
            "input_111": "promotion",
            "input_112": "imService",
            "input_113": "imName",
            "input_114": "webSchedulerStatus",
            "input_115": "isLandingPage",
            "input_116": "company",
            "input_117": "ae",
            "input_118": "wbraid",
            
            "input_119": "formSource",
            "input_22": "cmgfrm",
            "input_64": "leadbuyerid",
            "input_120": "militaryAffiliated",
        }
  
        for (var key in utm_map) {
            tmp_cookie = getCookie(utm_map[key])
            if (tmp_cookie) {
                console.log('we have something: ' + tmp_cookie)
                $("input[name='" + key + "']" ).val(tmp_cookie);
            }
        }
  
    }
    
    // Function to map schema keys to values
    function mapFormValues(jsonData) {
        ret = {}
        console.log(schema)
        console.log("length of jsondata is " + jsonData.length)
        
        // Setup okToText == false as a deault
        ret['okToText'] = false;
      
        for (var i = 0; i < jsonData.length; i++) {
            var obj = jsonData[i];
            console.log(obj.name + ": " + obj.value);
            
            if(schema.hasOwnProperty(obj.name)) {
                console.log("schems has property " + obj.name)
            
                // Hack for okToText
                if ( obj.name == "input_55" ) {
                    if (obj.value == "true") { obj.value = true; }
                    if (obj.value == "false") { obj.value = false; }
                }

                ret[schema[obj.name]] = obj.value;
            }
        }

        // Add some custom fields
        // ret['recordType'] = "University of West Alabama Campus"
        return ret;
    }
  
    // Initialize form validation on the registration form.
    if ( $("#gform_1").length ) {

        checkutm_values();
      
        $("#gform_1").validate({
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function(form) { 
                submitRFI(form);
            },

            // errorClass: "invalid",
            errorElement: "span",

            // Change error messages for student fields if parent prospect
            invalidHandler: function(event, validator) {
                var errors = validator.numberOfInvalids();
                // console.log(errors);

                var prospectTypeEl = document.getElementById("input_1_85");
                var prospectType = prospectTypeEl.options[prospectTypeEl.selectedIndex].text;
                // console.log('prospectType: ' + prospectType);

                if (errors && prospectType === 'Parent/Guardian') {

                    if ( validator.errorList.length > 0 ) {
                        for ( x = 0; x < validator.errorList.length; x++ ) {
                            
                            // Print all error messages
                            // console.log(validator.errorList[x].message);
                            // Print all error id's
                            // console.log(validator.errorList[x].element.id);
                            
                            // Student's first name
                            if (validator.errorList[x].element.id === 'input_1_81') {
                                validator.errorList[x].message = "Please enter student's first name";
                            }

                            // Student's last name
                            if (validator.errorList[x].element.id === 'input_1_82') {
                                validator.errorList[x].message = "Please enter student's last name";
                            }

                            // Student's email
                            if (validator.errorList[x].element.id === 'input_1_83') {
                                validator.errorList[x].message = "Please enter student's valid email address";
                            }

                            // Student's phone
                            if (validator.errorList[x].element.id === 'input_1_84') {
                                validator.errorList[x].message = "Please enter student's phone number";
                            }

                            // Student's anticipated major
                            if (validator.errorList[x].element.id === 'input_1_92') {
                                validator.errorList[x].message = "Please select student's anticipated major";
                            }

                            // Student's High School Graduation Year
                            if (validator.errorList[x].element.id === 'input_1_89') {
                                validator.errorList[x].message = "Please enter student's high school graduation year";
                            }
                        }
                    }

                }
            },

            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side

                //prospect type
                input_85: "required",

                //fname
                input_81: "required",
                //lname
                input_82: "required",
                //email
                input_83: {
                    required: true,
                    // Specify that email should be validated
                    // by the built-in "email" rule
                    email: true
                },
                //phone
                input_84: "required",

                //parent fname
                input_1: "required",
                //parent lname
                input_72: "required",
                //parent email
                input_5: {
                    required: true,
                    // Specify that email should be validated
                    // by the built-in "email" rule
                    email: true
                },
                //parent phone
                input_4: "required",
                
                //address
                input_90: "required",
                //country
                input_33: "required",
                //state
                input_126: "required",
            
                //program
                input_92: "required", 
                //highschool year
                // input_89: "required",
                input_89: {
                    required: true,
                    date: true,
                    minlength: 4,
                    maxlength: 4,
                    // max: 2022
                }, 
                //start term
                input_87: "required",
                //start year
                input_69: "required",
            },

            // Specify validation error messages
            messages: {
                input_85: "Please select your current status",

                input_1: "Please enter parent's first name",
                input_72: "Please enter parent's last name",
                input_5: "Please enter a valid parent's email address",
                input_4: "Please enter parent's phone number",

                input_81: "Please enter your first name",
                input_82: "Please enter your last name",
                input_83: "Please enter a valid email address",
                input_84: "Please enter a phone number",
                
                input_90: "Please enter an address",
                input_33: "Please select a country",
                input_126: "Please select a state",
                
                input_92: "Please select a program",
                input_89: "Please enter high school graduation year (e.g. 1999)",
                input_87: "Please select start term",
                input_69: "Please select start year",
            },            
        });
    }

    // Hack is in place to get around gravity forms
    $("#gform_submit_button_1").click( function(e) {
        window["gf_submitting_1"] = false;
    });
  
    function submitRFI(form) {
        tmp_form = $(form)
        jsonData = JSON.stringify( mapFormValues($(tmp_form).serializeArray()) );

        console.log(jsonData);
      
        // QA: Use the https://rfi.qa.edu.help/v1/leads/sites endpoint if you are submitting JSON
        // PROD: Use the https://rfi.edu.help/v1/leads/sites endpoint if you are submitting JSON
        $.ajax({
            type: "POST",
            url: "https://rfi.edu.help/v1/leads/sites",
            contentType: "application/json",        
            data: jsonData,
            success: function(response) {
                console.log(response)
                console.log("success")
                window.location.href = "/thank-you/";			
            },
            error: function(response) {
                console.log(response)
                console.log("error")
                window.location.href = "/thank-you/";
            }
        });
    }

    // Ref: https://docs.gravityforms.com/gform_input_change/
    // Change label for fields when status changes for question: WHAT IS YOUR CURRENT STATUS?
    if ( $("#gform_1").length ) {
        gform.addAction( 'gform_input_change', function( elem, formId, fieldId ) {
            // console.log(elem, formId, fieldId);
    
            // Change label for fields when status changes for question: WHAT IS YOUR CURRENT STATUS?
            if (elem.id == 'input_1_85') {
                // console.log('found elem: ', elem.value);
    
                switch(elem.value) {
                    case 'Parent/Guardian':
                        $('label[for="input_1_81"]').text("Student's First Name");
                        $('#input_1_81').attr('placeholder',"Student's First Name");
        
                        $('label[for="input_1_82"]').text("Student's Last Name");
                        $('#input_1_82').attr('placeholder',"Student's Last Name");
        
                        $('label[for="input_1_83"]').text("Student's Email");
                        $('#input_1_83').attr('placeholder',"Student's Email");
        
                        $('label[for="input_1_84"]').text("Student's Phone");
                        $('#input_1_84').attr('placeholder',"Student's Phone");
    
                        $('label[for="input_1_92"]').text("Student's Anticipated Major");
    
                        $('label[for="input_1_89"]').text("Student's High School Graduation Year");
                        $('#input_1_89').attr('placeholder',"Student's High School Graduation Year");
                    break;
                    default:
                        $('label[for="input_1_81"]').text("First Name");
                        $('#input_1_81').attr('placeholder',"First Name");
        
                        $('label[for="input_1_82"]').text("Last Name");
                        $('#input_1_82').attr('placeholder',"Last Name");
        
                        $('label[for="input_1_83"]').text("Email");
                        $('#input_1_83').attr('placeholder',"Email");
        
                        $('label[for="input_1_84"]').text("Phone");
                        $('#input_1_84').attr('placeholder',"Phone");
    
                        $('label[for="input_1_92"]').text("Anticipated Major");
    
                        $('label[for="input_1_89"]').text("High School Graduation Year");
                        $('#input_1_89').attr('placeholder',"High School Graduation Year");
                }
            }
    
        }, 10 );
    }
    
    // Update fields labels for validation errors (Student)
    if ($("#input_1_85").length) {

        $("#input_1_85").on("change", function(e) {
            // var prospectType = prospectTypeEl.options[prospectTypeEl.selectedIndex].text;
            var prospectType =  $(this).val();
            // console.log(prospectType);
    
            switch(prospectType) {
                case 'Parent/Guardian':
                    $('label[for="input_1_81"]').text("Student's First Name");
                    $('#input_1_81').attr('placeholder',"Student's First Name");
                    $('span#input_1_81-error').text("Please enter student's first name");
    
                    $('label[for="input_1_82"]').text("Student's Last Name");
                    $('#input_1_82').attr('placeholder',"Student's Last Name");
                    $('span#input_1_82-error').text("Please enter student's last name");
    
                    $('label[for="input_1_83"]').text("Student's Email");
                    $('#input_1_83').attr('placeholder',"Student's Email");
                    $('span#input_1_83-error').text("Please enter student's valid email address");
    
                    $('label[for="input_1_84"]').text("Student's Phone");
                    $('#input_1_84').attr('placeholder',"Student's Phone");
                    $('span#input_1_84-error').text("Please enter student's phone number");
    
                    $('label[for="input_1_92"]').text("Student's Anticipated Major");
                    $('span#input_1_92-error').text("Please select student's anticipated program");
    
                    $('label[for="input_1_89"]').text("Student's High School Graduation Year");
                    $('#input_1_89').attr('placeholder',"Student's High School Graduation Year");
                    $('span#input_1_89-error').text("Please enter student's high school year");
                break;
                default:
                    $('label[for="input_1_81"]').text("First Name");
                    $('#input_1_81').attr('placeholder',"First Name");
                    $('span#input_1_81-error').text("Please enter your first name");
    
                    $('label[for="input_1_82"]').text("Last Name");
                    $('#input_1_82').attr('placeholder',"Last Name");
                    $('span#input_1_82-error').text("Please enter your last name");
    
                    $('label[for="input_1_83"]').text("Email");
                    $('#input_1_83').attr('placeholder',"Email");
                    $('span#input_1_83-error').text("Please enter a valid email address");
    
                    $('label[for="input_1_84"]').text("Phone");
                    $('#input_1_84').attr('placeholder',"Phone");
                    $('span#input_1_84-error').text("Please enter a phone number");
    
                    $('label[for="input_1_92"]').text("Anticipated Major");
                    $('span#input_1_92-error').text("Please select a program");
    
                    $('label[for="input_1_89"]').text("High School Graduation Year");
                    $('#input_1_89').attr('placeholder',"High School Graduation Year");
                    $('span#input_1_89-error').text("Please enter high school graduation year");
            }
        });

    }

});