!function(t){"use strict";function a(){t("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").addClass("buttons_added").append('<input type="button" value="+" class="plus" />').prepend('<input type="button" value="-" class="minus" />'),t(document).on("click",".plus, .minus",function(){var a=t(this).closest(".quantity").find(".qty"),n=parseFloat(a.val()),s=parseFloat(a.attr("max")),u=parseFloat(a.attr("min")),e=a.attr("step");n&&""!==n&&"NaN"!==n||(n=0),(""===s||"NaN"===s)&&(s=""),(""===u||"NaN"===u)&&(u=0),("any"===e||""===e||void 0===e||"NaN"===parseFloat(e))&&(e=1),t(this).is(".plus")?s&&(s==n||n>s)?a.val(s):a.val(n+parseFloat(e)):u&&(u==n||u>n)?a.val(u):n>0&&a.val(n-parseFloat(e)),a.trigger("change")})}a(),t(document.body).on("updated_wc_div",function(t){a()})}(jQuery);