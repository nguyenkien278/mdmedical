var API = {};
API.SERVICE_CONTRACT = {
    'CustomerService': '/s06',
    'LoginService': '/s01'
};

var LOGIN_JMANGO360 = 1;
var LOGIN_FACEBOOK = 2;
var LOGIN_GOOGLEPLUS = 3;
var loginType = 0;
var isLoginSNS = false;
var socialAccessToken = '';
var localEmail = '';

var LOCALE_STRINGS = {
    NL: {
        'Please use your email address for your Facebook login': 'Please use your email address for your Facebook login',
        'The email address already exists': 'The email address already exists',
        'Registration failed. Please try again later.': 'Registration failed. Please try again later.'
    }
};

var THANKYOU_URLS = {
    EN: 'https://jmango360.com/thank-you-sign-up/',
    NL: 'https://jmango360.com/nl/thank-you-sign-up/',
    FR: 'https://jmango360.com/fr/thank-you-sign-up/',
    DE: 'https://jmango360.com/de/thank-you-sign-up/',
    IT: 'https://jmango360.com/it/thank-you-sign-up/',
};

StringUtils = {};

StringUtils.encrypt = function (password) {
    var hash = CryptoJS.SHA1(password);
    return CryptoJS.enc.Base64.stringify(hash);
};

var getCurrentLang = function () {
    // return 'EN';
	return jQuery('.signup-user-orchard').data("lang");
};
// console.log(jQuery('.signup-user-orchard').data("lang"));
var __ = function (str) {
    var lang = getCurrentLang();
    if (!lang) return str;
    if (!LOCALE_STRINGS[lang]) return str;
    return LOCALE_STRINGS[lang][str] || str;
};

var callAjax = function (url, jsonData, onAjaxSuccess, onAjaxError) {
    jQuery.ajax({
        type: 'POST',
        url: url,
        data: jsonData,
        dataType: Const.API_DATA_TYPE,
        contentType: Const.API_CONTENT_TYPE,
        crossDomain: true,
        cache: false,
        timeout: Const.API_REQUEST_TIMEOUT,
        beforeSend: function () {
        },
        success: onAjaxSuccess,
        error: onAjaxError
    });
};

var registerUser = function (url, jsonData, onAjaxSuccess, onAjaxError) {
    callAjax(url, jsonData, onAjaxSuccess, onAjaxError);
};

var loginSocial = function (loginType, accessToken, onAjaxSuccess, onAjaxError) {
    var url = Const.API_HOST_URL + API.SERVICE_CONTRACT['LoginService'] + '/Login',
        jsonData = {};
    jsonData.KR0 = {};
    jsonData.KR0.A0 = "project.name";
    jsonData.KR0.K0 = {};
    jsonData.KR0.K0.B0 = "anonymous";
    jsonData.P2 = loginType;
    jsonData.P3 = accessToken;
    callAjax(url, JSON.stringify(jsonData), onAjaxSuccess, onAjaxError);
};

var onLoginSuccess = function (result) {
    if (result.KR1) {
        var redirectUrl = getRedirectUrl(result);
        if (redirectUrl) window.location.href = redirectUrl;
    }
};

var getRedirectUrl = function (result) {
    if (!result) return;

    if (loginType == LOGIN_JMANGO360) {
        var email = localEmail;
    } else {
        var email = result.P4 && result.P4.P6 ? result.P4.P6 : '';
    }
    var lang = getCurrentLang();
    var url = THANKYOU_URLS[lang] || '';

    if (!url) return;
    if (url.indexOf('?') > 0) {
        return url += '&email=' + email;
    } else {
        return url += '?email=' + email;
    }
};

var onLoginError = function (result) {

};

var onRegisterSuccess = function (result) {
    enebleElement('#jmango360-signup-form input[type="submit"]');

    if (result.KR1) {
        var redirectUrl = getRedirectUrl(result);
        if (redirectUrl) window.location.href = redirectUrl;
    } else if (result.KR0 == 2003) {
        jQuery('.ajax-error').html(__('Please use your email address for your Facebook login')).show();
    } else if (result.KR0 == 2009) {
        if (!isLoginSNS) {
            jQuery('#jmango360_account_email').validationEngine('showPrompt', __('The email address already exists'), 'error', 'topRight', true);
        } else {
            loginSocial(loginType, socialAccessToken, onLoginSuccess, onLoginError);
        }
    } else if (result.KR2) {
        jQuery('.ajax-error').html(result.KR2).show();
    }
};

var showPlatformModal = function (ticketId) {
    if (!ticketId) return;
    jQuery('#magento-button').attr('href', Const.ORCHARD_URL + "/#ob-welcome?ticket=" + ticketId + '&onsignup=magento');
    jQuery('#jm-button').attr('href', Const.ORCHARD_URL + "/#my-application?ticket=" + ticketId + '&onsignup=jmango');
    jQuery('#platform-selection-modal').modal('show');
};

var onRegisterError = function (result) {
    setTimeout(function () {
        jQuery('.ajax-loader').hide();
        jQuery('.ajax-error').html(__('Registration failed. Please try again later.')).show();
    }, 1000);
};

var loginOnBoard = function (firstName, lastName, email, password, loginType) {
    var url = Const.API_HOST_URL + API.SERVICE_CONTRACT['CustomerService'] + '/Customer_SignupOnBoard';
    var jsonData = {};
    jsonData.P0 = {};//filter
    jsonData.P0.P7 = password;//password
    jsonData.P0.P10 = email;//userName
    jsonData.P0.P43 = firstName;
    jsonData.P0.P44 = lastName;
    jsonData.P0.P5 = loginType;
    registerUser(url, JSON.stringify(jsonData), onRegisterSuccess, onRegisterError);
};

var disableElement = function (elm) {
    var $elm = jQuery(elm);
    if (!$elm.length) return;
    $elm.addClass('disabled').prop('disabled', true);
};

var enebleElement = function (elm) {
    var $elm = jQuery(elm);
    if (!$elm.length) return;
    $elm.removeClass('disabled').prop('disabled', false);
};


jQuery(function () {

    jQuery("#jmango360-signup-form").submit(function () {
        isLoginSNS = false;
        jQuery(this).validationEngine({
            scroll: false,
            binded: true,
            maxErrorsPerField: 1,
            containerOverflow: true
        });
        if (jQuery(this).validationEngine('validate')) {
            var email = jQuery('#jmango360_account_email').val().toLowerCase();
			var firstName = jQuery('#jmango360_account_firstname').val();
			var lastName = jQuery('#jmango360_account_lastname').val();
            var password = StringUtils.encrypt(jQuery('#jmango360_account_password').val());
            loginType = LOGIN_JMANGO360;
            localEmail = email;
            loginOnBoard(firstName, lastName, email, password, loginType);
            disableElement('#jmango360-signup-form input[type="submit"]');
        }
        return false;
    });

    ////////////// LOGIN VIA FACEBOOK /////////////////
    window.fbAsyncInit = function () {
        FB.init({
            appId: Const.Facebook_AppID,
            cookie: true,  // enable cookies to allow the server to access the session
            xfbml: true,  // parse social plugins on this page
            version: 'v2.3' // use version 2.2
        });
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    jQuery('#linkedin_btn').on('click', function (e) {
        e.preventDefault();
        isLoginSNS = true;
        loginType = LOGIN_FACEBOOK;
        FB.login(function (response) {
            if (response.authResponse) {
                var accessToken = response.authResponse.accessToken;
                socialAccessToken = accessToken;
                getCurrentUserInfo(accessToken);
            }
        }, {scope: 'email'});

        function getCurrentUserInfo(accessToken) {
            FB.api('/me', function (userInfo) {
                console.log(userInfo);
                var firstName = userInfo.first_name;
                var lastName = userInfo.last_name;
                var email = userInfo.email;
                var password = StringUtils.encrypt(accessToken);
                loginOnBoard(firstName, lastName, email, password, loginType);
            });
        }

        return false;
    });

    ////////////// LOGIN VIA G+ /////////////////
    var userChanged = function (user) {
        var response = user.getAuthResponse();
        if (response && response.access_token) {
            socialAccessToken = response.access_token;
            loginType = LOGIN_GOOGLEPLUS;
            var password = StringUtils.encrypt(response.access_token);
            isLoginSNS = true;
            jQuery.get('https://www.googleapis.com/oauth2/v1/userinfo', {
                access_token: response.access_token
            }, function (resp) {
                loginOnBoard(resp.given_name, resp.family_name, resp.email, password, loginType);
            });
        }
    };

    gapi.load('auth2', function () {
        var auth2 = gapi.auth2.init({
            client_id: Const.GooglePlus_ClientID,
            cookiepolicy: 'single_host_origin',
            scope: 'profile'
        });
        auth2.attachClickHandler(document.getElementById('google_btn'), {}, userChanged);
    });
});
