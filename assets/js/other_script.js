window.money_format = "<span class=money>${{amount}}</span>";
window.shop_currency = "USD";
window.show_multiple_currencies = true;
window.use_color_swatch = true;
window.file_url = "//cdn.shopify.com/s/files/1/0051/3130/4995/files/?466";
window.theme_load = "assets/ajax-loader.gif?466";
window.filter_mul_choice = true;
//Product Detail - Add to cart
window.btn_addToCart = '#btnAddtocart';
window.product_detail_form = '#AddToCartForm';
window.product_detail_name = '.product-info h1';
window.product_detail_mainImg = '.product-single-photos img';
window.addcart_susscess = "";
window.cart_count = ".mini-cart .cart-count";
window.cart_total = ".mini-cart .cart-total";
window.addcart_susscess = "";
window.trans_text = {
    in_stock: "in stock",
    many_in_stock: "Many in stock",
    out_of_stock: "Out stock",
    add_to_cart: "Add to cart",
    sold_out: "Sold out",
    unavailable: "Unavailable"
};


window.file_url = "//cdn.shopify.com/s/files/1/0051/3130/4995/files/?466";
window.theme_load = "assets/ajax-loader.gif?466";
window.filter_mul_choice = true;
//Product Detail - Add to cart
window.btn_addToCart = '#btnAddtocart';
window.product_detail_form = '#AddToCartForm';
window.product_detail_name = '.product-info h1';
window.product_detail_mainImg = '.product-single-photos img';
window.addcart_susscess = "popup";
window.cart_count = ".mini-cart .cart-count";
window.cart_total = ".mini-cart .cart-total";
window.trans_text = {
    in_stock: "in stock",
    many_in_stock: "Many in stock",
    out_of_stock: "Out stock",
    add_to_cart: "Add to cart",
    sold_out: "Sold out",
    unavailable: "Unavailable"
};

WebFontConfig = {
    google: {
        families: [

            'Roboto:400,600,700'


        ]
    }
};
(function () {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
        '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
})();

window.performance && window.performance.mark && window.performance.mark('shopify.content_for_header.start');

var Shopify = Shopify || {};
Shopify.shop = "rt-aashop-demo.myshopify.com";
Shopify.currency = {"active": "USD", "rate": "1.0"};
Shopify.theme = {"name": "Ss-aashop-home1", "id": 42559406115, "theme_store_id": null, "role": "main"};
Shopify.theme.handle = "null";
Shopify.theme.style = {"id": null, "handle": null};

type = "module" > !function (o) {
    (o.Shopify = o.Shopify || {}).modules = !0
}(window);

!function (o) {
    function n() {
        var o = [];

        function n() {
            o.push(Array.prototype.slice.apply(arguments))
        }

        return n.q = o, n
    }

    var t = o.Shopify = o.Shopify || {};
    t.loadFeatures = n(), t.autoloadFeatures = n()
}(window);

(function () {
    function asyncLoad() {
        var urls = ["\/\/productreviews.shopifycdn.com\/assets\/v4\/spr.js?shop=rt-aashop-demo.myshopify.com"];
        for (var i = 0; i < urls.length; i++) {
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = urls[i];
            var x = document.getElementsByTagName('script')[0];
            x.parentNode.insertBefore(s, x);
        }
    };
    if (window.attachEvent) {
        window.attachEvent('onload', asyncLoad);
    } else {
        window.addEventListener('load', asyncLoad, false);
    }
})();

var __st = {
    "a": 5131304995,
    "offset": -18000,
    "reqid": "094ca78e-5261-4d69-add5-ef4f5f751a34",
    "pageurl": "rt-aashop-demo.myshopify.com\/",
    "u": "0e6d6828c344",
    "p": "home"
};

window.ShopifyPaypalV4VisibilityTracking = true;

window.ShopifyAnalytics = window.ShopifyAnalytics || {};
window.ShopifyAnalytics.meta = window.ShopifyAnalytics.meta || {};
window.ShopifyAnalytics.meta.currency = 'USD';
var meta = {"page": {"pageType": "home"}};
for (var attr in meta) {
    window.ShopifyAnalytics.meta[attr] = meta[attr];
}

window.ShopifyAnalytics.merchantGoogleAnalytics = function () {

};

(function () {
    var customDocumentWrite = function (content) {
        var jquery = null;

        if (window.jQuery) {
            jquery = window.jQuery;
        } else if (window.Checkout && window.Checkout.$) {
            jquery = window.Checkout.$;
        }

        if (jquery) {
            jquery('body').append(content);
        }
    };

    var isDuplicatedThankYouPageView = function () {
        return document.cookie.indexOf('loggedConversion=' + window.location.pathname) !== -1;
    }

    var setCookieIfThankYouPage = function () {
        if (window.location.pathname.indexOf('/checkouts') !== -1 &&
            window.location.pathname.indexOf('/thank_you') !== -1) {

            var twoMonthsFromNow = new Date(Date.now());
            twoMonthsFromNow.setMonth(twoMonthsFromNow.getMonth() + 2);

            document.cookie = 'loggedConversion=' + window.location.pathname + '; expires=' + twoMonthsFromNow;
        }
    }

    var trekkie = window.ShopifyAnalytics.lib = window.trekkie = window.trekkie || [];
    if (trekkie.integrations) {
        return;
    }
    trekkie.methods = [
        'identify',
        'page',
        'ready',
        'track',
        'trackForm',
        'trackLink'
    ];
    trekkie.factory = function (method) {
        return function () {
            var args = Array.prototype.slice.call(arguments);
            args.unshift(method);
            trekkie.push(args);
            return trekkie;
        };
    };
    for (var i = 0; i < trekkie.methods.length; i++) {
        var key = trekkie.methods[i];
        trekkie[key] = trekkie.factory(key);
    }
    trekkie.load = function (config) {
        trekkie.config = config;
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.onerror = function (e) {
            (new Image()).src = '//v.shopify.com/internal_errors/track?error=trekkie_load';
        };
        script.async = true;
        script.src = 'https://cdn.shopify.com/s/javascripts/tricorder/trekkie.storefront.min.js?v=2019.11.04.1';
        var first = document.getElementsByTagName('script')[0];
        first.parentNode.insertBefore(script, first);
    };
    trekkie.load(
        {
            "Trekkie": {
                "appName": "storefront",
                "development": false,
                "defaultAttributes": {
                    "shopId": 5131304995,
                    "isMerchantRequest": null,
                    "themeId": 42559406115,
                    "themeCityHash": "17161875755772790229",
                    "contentLanguage": "en",
                    "currency": "USD"
                }
            },
            "Performance": {
                "navigationTimingApiMeasurementsEnabled": true,
                "navigationTimingApiMeasurementsSampleRate": 1
            },
            "Session Attribution": {}
        }
    );

    var loaded = false;
    trekkie.ready(function () {
        if (loaded) return;
        loaded = true;

        window.ShopifyAnalytics.lib = window.trekkie;


        var originalDocumentWrite = document.write;
        document.write = customDocumentWrite;
        try {
            window.ShopifyAnalytics.merchantGoogleAnalytics.call(this);
        } catch (error) {
        }
        ;
        document.write = originalDocumentWrite;
        (function () {
            if (window.BOOMR && (window.BOOMR.version || window.BOOMR.snippetExecuted)) {
                return;
            }
            window.BOOMR = window.BOOMR || {};
            window.BOOMR.snippetStart = new Date().getTime();
            window.BOOMR.snippetExecuted = true;
            window.BOOMR.snippetVersion = 12;
            window.BOOMR.shopId = 5131304995;
            window.BOOMR.themeId = 42559406115;
            window.BOOMR.url =
                "https://cdn.shopify.com/shopifycloud/boomerang/shopify-boomerang-1.0.0.min.js";
            var where = document.currentScript || document.getElementsByTagName("script")[0];
            if (!where || !where.parentNode) {
                return;
            }
            var promoted = false;
            var LOADER_TIMEOUT = 3000;

            function promote() {
                if (promoted) {
                    return;
                }
                var script = document.createElement("script");
                script.id = "boomr-scr-as";
                script.src = window.BOOMR.url;
                script.async = true;
                where.parentNode.appendChild(script);
                promoted = true;
            }

            function iframeLoader(wasFallback) {
                promoted = true;
                var dom, bootstrap, iframe, iframeStyle;
                var doc = document;
                var win = window;
                window.BOOMR.snippetMethod = wasFallback ? "if" : "i";
                bootstrap = function (parent, scriptId) {
                    var script = doc.createElement("script");
                    script.id = scriptId || "boomr-if-as";
                    script.src = window.BOOMR.url;
                    BOOMR_lstart = new Date().getTime();
                    parent = parent || doc.body;
                    parent.appendChild(script);
                };
                if (!window.addEventListener && window.attachEvent && navigator.userAgent.match(/MSIE [67]./)) {
                    window.BOOMR.snippetMethod = "s";
                    bootstrap(where.parentNode, "boomr-async");
                    return;
                }
                iframe = document.createElement("IFRAME");
                iframe.src = "about:blank";
                iframe.title = "";
                iframe.role = "presentation";
                iframe.loading = "eager";
                iframeStyle = (iframe.frameElement || iframe).style;
                iframeStyle.width = 0;
                iframeStyle.height = 0;
                iframeStyle.border = 0;
                iframeStyle.display = "none";
                where.parentNode.appendChild(iframe);
                try {
                    win = iframe.contentWindow;
                    doc = win.document.open();
                } catch (e) {
                    dom = document.domain;
                    iframe.src = "javascript:var d=document.open();d.domain='" + dom + "';void(0);";
                    win = iframe.contentWindow;
                    doc = win.document.open();
                }
                if (dom) {
                    doc._boomrl = function () {
                        this.domain = dom;
                        bootstrap();
                    };
                    doc.write("<body onload='document._boomrl();'>");
                } else {
                    win._boomrl = function () {
                        bootstrap();
                    };
                    if (win.addEventListener) {
                        win.addEventListener("load", win._boomrl, false);
                    } else if (win.attachEvent) {
                        win.attachEvent("onload", win._boomrl);
                    }
                }
                doc.close();
            }

            var link = document.createElement("link");
            if (link.relList &&
                typeof link.relList.supports === "function" &&
                link.relList.supports("preload") &&
                ("as" in link)) {
                window.BOOMR.snippetMethod = "p";
                link.href = window.BOOMR.url;
                link.rel = "preload";
                link.as = "script";
                link.addEventListener("load", promote);
                link.addEventListener("error", function () {
                    iframeLoader(true);
                });
                setTimeout(function () {
                    if (!promoted) {
                        iframeLoader(true);
                    }
                }, LOADER_TIMEOUT);
                BOOMR_lstart = new Date().getTime();
                where.parentNode.appendChild(link);
            } else {
                iframeLoader(false);
            }

            function boomerangSaveLoadTime(e) {
                window.BOOMR_onload = (e && e.timeStamp) || new Date().getTime();
            }

            if (window.addEventListener) {
                window.addEventListener("load", boomerangSaveLoadTime, false);
            } else if (window.attachEvent) {
                window.attachEvent("onload", boomerangSaveLoadTime);
            }
            if (document.addEventListener) {
                document.addEventListener("onBoomerangLoaded", function (e) {
                    e.detail.BOOMR.init({});
                    e.detail.BOOMR.t_end = new Date().getTime();
                });
            } else if (document.attachEvent) {
                document.attachEvent("onpropertychange", function (e) {
                    if (!e) e = event;
                    if (e.propertyName === "onBoomerangLoaded") {
                        e.detail.BOOMR.init({});
                        e.detail.BOOMR.t_end = new Date().getTime();
                    }
                });
            }
        })();


        if (!isDuplicatedThankYouPageView()) {
            setCookieIfThankYouPage();

            window.ShopifyAnalytics.lib.page(
                null,
                {"pageType": "home"}
            );


        }
    });


    var eventsListenerScript = document.createElement('script');
    eventsListenerScript.async = true;
    eventsListenerScript.src = "//cdn.shopify.com/s/assets/shop_events_listener-09875a9a2b286acf534498184c24b199675a6097a941992d0979e5295d2cf9e9.js";
    document.getElementsByTagName('head')[0].appendChild(eventsListenerScript);

})();

window.performance && window.performance.mark && window.performance.mark('shopify.content_for_header.end');

jQuery(document).ready(function ($) {
    $(window).load(function () {
        var check_cookie = getCookie("newsletter-wrapper");
        if (check_cookie != '') {
            $('#popup-newletter').hide();
            $('#popup-newletter').removeClass('show');
            return;
        } else {
            $('#popup-newletter').show();
            $('body').addClass('hidden-scorll');

            $('input[name=\'hidden-popups\']').on('change', function () {

                if ($(this).is(':checked')) {
                    checkCookie();
                } else {
                    unsetCookie("newsletter-wrapper");
                }
            });

            function unsetCookie(name) {
                document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
            }

            $('.ss_newletter_custom_popup_bg').click(function () {
                var this_close = $('.popup-close');
                $('body').removeClass('hidden-scorll');
                $('#popup-newletter').hide();
            });
            $('.popup-close').click(function () {
                var this_close = $('.popup-close');
                $('body').removeClass('hidden-scorll');
                $('#popup-newletter').hide();
            });
            $('#popup-newletter').addClass('popup_bgs');
        }
    });
});

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    console.log(d.getTime());
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}

function checkCookie() {
    var check_cookie = getCookie("newsletter-wrapper");
    if (check_cookie == "") {
        setCookie("newsletter-wrapper", "Newletter Popup", 1);
    }
}


Shopify.doNotTriggerClickOnThumb = false;

var selectCallbackQuickview = function (variant, selector) {
    var productItem = jQuery('.quick-view .product-item');
    addToCart = productItem.find('.add-to-cart-btn'),
        productPrice = productItem.find('.price'),
        comparePrice = productItem.find('.compare-price'),
        totalPrice = productItem.find('.total-price span');

    if (variant) {
        if (variant.available) {
            // We have a valid product variant, so enable the submit button
            addToCart.removeClass('disabled').removeAttr('disabled').text('Add to cart');

        } else {
            // Variant is sold out, disable the submit button
            addToCart.val(window.inventory_text.sold_out).addClass('disabled').attr('disabled', 'disabled');
        }


        productPrice.html(Shopify.formatMoney(variant.price, window.money_format));


        var form = jQuery('#' + selector.domIdPrefix).closest('form');
        for (var i = 0, length = variant.options.length; i < length; i++) {
            var radioButton = form.find('.swatch[data-option-index="' + i + '"] :radio[value="' + variant.options[i] + '"]');
            if (radioButton.size()) {
                radioButton.get(0).checked = true;
            }
        }


        /*recaculate total price*/
        //try pattern one before pattern 2
        var regex = /([0-9]+[.|,][0-9]+[.|,][0-9]+)/g;
        var unitPriceTextMatch = jQuery('.quick-view .price').text().match(regex);

        if (!unitPriceTextMatch) {
            regex = /([0-9]+[.|,][0-9]+)/g;
            unitPriceTextMatch = jQuery('.quick-view .price').text().match(regex);
        }

        if (unitPriceTextMatch) {
            var unitPriceText = unitPriceTextMatch[0];
            var unitPrice = unitPriceText.replace(/[.|,]/g, '');
            var quantity = parseInt(jQuery('.quick-view input[name=quantity]').val());
            var totalPrice = unitPrice * quantity;

            var totalPriceText = Shopify.formatMoney(totalPrice, window.money_format);
            regex = /([0-9]+[.|,][0-9]+[.|,][0-9]+)/g;
            if (!totalPriceText.match(regex)) {
                regex = /([0-9]+[.|,][0-9]+)/g;
            }
            totalPriceText = totalPriceText.match(regex)[0];

            var regInput = new RegExp(unitPriceText, "g");
            var totalPriceHtml = jQuery('.quick-view .price').html().replace(regInput, totalPriceText);
            jQuery('.quick-view .total-price span.money').html(totalPriceHtml);
        }
        /*end of price calculation*/


        Currency.convertAll(window.shop_currency, jQuery('select[name=currencies] option:selected').val(), 'span.money', 'money_format');


        /*begin variant image*/
        if (variant && variant.featured_image) {
            var originalImage = jQuery(".quick-view .quickview-image img");
            var newImage = variant.featured_image;
            var element = originalImage[0];
            Shopify.Image.switchImage(newImage, element, function (newImageSizedSrc, newImage, element) {
                newImageSizedSrc = newImageSizedSrc.replace(/\?(.*)/, "");
                jQuery('.quick-view .more-view-wrapper img').each(function () {
                    var grandSize = jQuery(this).attr('src');
                    grandSize = grandSize.replace('compact', 'grande');

                    if (grandSize == newImageSizedSrc) {
                        jQuery(this).parent().trigger('click');
                        return false;
                    }
                });
            });
        }
        /*end of variant image*/

    } else {
        // The variant doesn't exist. Just a safegaurd for errors, but disable the submit button anyway
        addToCart.text(window.inventory_text.unavailable).addClass('disabled').attr('disabled', 'disabled');
    }
};

function createCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}

//jQuery(document).ready(function() {
Currency.format = 'money_format';
var shopCurrency = 'USD';
Currency.moneyFormats[shopCurrency].money_with_currency_format = "${{amount}}";
Currency.moneyFormats[shopCurrency].money_format = "${{amount}}";

//var cookieCurrency = Currency.cookie.read();
var cookieCurrency = readCookie('currency');

jQuery('span.money span.money').each(function () {
    jQuery(this).parent('span.money').removeClass('money');
});

jQuery('span.money').each(function () {
    jQuery(this).attr('data-currency-USD', jQuery(this).html());
});

var currencySwitcher = jQuery('select[name=currencies]');
// When the page loads.
if (cookieCurrency == null || cookieCurrency == shopCurrency) {
    Currency.currentCurrency = shopCurrency;
} else {
    Currency.currentCurrency = cookieCurrency;
    currencySwitcher.val(cookieCurrency);
    Currency.convertAll(shopCurrency, cookieCurrency);
}

currencySwitcher.change(function () {
    eraseCookie('currency');
    var newCurrency = jQuery(this).val();
    createCookie('currency', newCurrency, 30);
    Currency.convertAll(Currency.currentCurrency, newCurrency);
});

$('body').on('ajaxCart.afterCartLoad', function (cart) {
    Currency.convertAll(shopCurrency, jQuery('select[name=currencies]').val());
});

var original_selectCallback = window.selectCallback;
var selectCallback = function (variant, selector) {
    original_selectCallback(variant, selector);
    Currency.convertAll(shopCurrency, jQuery('select[name=currencies]').val());
};
//})


//   Currency.format = 'money_format';

//   var shopCurrency = 'USD';

//   /* Sometimes merchants change their shop currency, let's tell our JavaScript file */
//   Currency.moneyFormats[shopCurrency].money_with_currency_format = "${{amount}}";
//   Currency.moneyFormats[shopCurrency].money_format = "${{amount}}";

//   /* Default currency */
//   var defaultCurrency = 'USD';

//   /* Cookie currency */
//   var cookieCurrency = Currency.cookie.read();

//   /* Fix for customer account pages */
//   jQuery('span.money span.money').each(function() {
//     jQuery(this).parents('span.money').removeClass('money');
//   });

//   /* Saving the current price */
//   jQuery('span.money').each(function() {
//     jQuery(this).attr('data-currency-USD', jQuery(this).html());
//                       });

//     // If there's no cookie.
//     if (cookieCurrency == null) {
//       if (shopCurrency !== defaultCurrency) {
//         Currency.convertAll(shopCurrency, defaultCurrency);
//       }
//       else {
//         Currency.currentCurrency = defaultCurrency;
//       }
//     }
//     // If the cookie value does not correspond to any value in the currency dropdown.
//     else if (jQuery('[name=currencies]').size() && jQuery('[name=currencies] option[value=' + cookieCurrency + ']').size() === 0) {
//       Currency.currentCurrency = shopCurrency;
//       Currency.cookie.write(shopCurrency);
//     }
//     else if (cookieCurrency === shopCurrency) {
//       Currency.currentCurrency = shopCurrency;
//     }
//     else {
//       Currency.convertAll(shopCurrency, cookieCurrency);
//     }

//     jQuery('[name=currencies]').val(Currency.currentCurrency).change(function() {
//       var newCurrency = jQuery(this).val();
//       Currency.convertAll(Currency.currentCurrency, newCurrency);
//       jQuery('.selected-currency').text(Currency.currentCurrency);
//     });

//     var original_selectCallback = window.selectCallback;
//     var selectCallback = function(variant, selector) {
//       original_selectCallback(variant, selector);
//       Currency.convertAll(shopCurrency, jQuery('[name=currencies]').val());
//       jQuery('.selected-currency').text(Currency.currentCurrency);
//     };

//     $('body').on('ajaxCart.afterCartLoad', function(cart) {
//       Currency.convertAll(shopCurrency, jQuery('[name=currencies]').val());
//       jQuery('.selected-currency').text(Currency.currentCurrency);
//     });

//     jQuery('.selected-currency').text(Currency.currentCurrency);

window.out_of_stock = "Out stock";
window.in_stock = "in stock";

jQuery(document).ready(function ($) {
    var currentAjaxRequest = null;
    var searchForms = $('form[action="/search"]').css('position', 'relative').each(function () {
        var input = $(this).find('input[name="q"]');
        var offSet = input.position().top + input.innerHeight();
        $('<ul class="box-results"></ul>').css({
            'position': 'absolute',
            'left': '0px',
            'top': offSet
        }).appendTo($(this)).hide();
        input.attr('autocomplete', 'off').bind('keyup change', function () {
            var term = $(this).val();
            var form = $(this).closest('form');
            var searchURL = '/search?type=product&q=' + term;
            var resultsList = form.find('.box-results');
            if (term.length >= 3 && term != $(this).attr('data-old-term')) {
                $(this).attr('data-old-term', term);
                if (currentAjaxRequest != null) currentAjaxRequest.abort();
                currentAjaxRequest = $.getJSON(searchURL + '&view=json', function (data) {
                    resultsList.empty();
                    if (data.results_count == 0) {
                        resultsList.hide();
                    } else {
                        $.each(data.results, function (index, item) {
                            var link = $('<a></a>').attr('href', item.url);
                            link.append('<span class="thumbnail"><img src="' + item.thumbnail + '" /></span>');
                            link.append('<span class="title_name">' + item.title + '</span>');
                            link.wrap('<li></li>');
                            resultsList.append(link.parent());
                        });
                        if (data.results_count > 5) {
                            resultsList.append('<li class="a-center"><span class="btn btn-results"><a href="' + searchURL + '"> All Results (' + data.results_count + ')</a></span></li>');
                        }
                        resultsList.fadeIn(200);
                    }
                });
            }
        });
    });
    $('body').bind('click', function () {
        $('.box-results').hide();
    });
})