 /*----------------script pour admin---*/
function wajax(content,rel){alert(content+"   "+rel);
//$("#btclose").remove();//$("#reponse1").empty();
$("#enr").hide();   
$("#adm1").empty();
$.post('ajax.php', {appp:'adminp', variable:rel, command:content}).done(function(response){console.log(response);
       $("#reponse1").html(response);
});}
function yajax(id1){
$(id1).hide();}
function remplace(id2,content2){
$(id2).text(content2);
}


/*Minimal Virtual Keypad
---------------------------*/

$(document).ready(function () {
  const input_value = $("#password");
  var pwd,nameid;
  //disable input from typing

  $("#password").keypress(function () {
    return false;
  });

  //add password
  $(".calc").click(function () {
    let value = $(this).val();
    field(value);
  });
  function field(value) {
    input_value.val(input_value.val() + value);
  }
  $("#clear").click(function () {
    input_value.val("");
  });
  $("#enter").click(function () {
    pwd = input_value.val();
	alco = $("input[name=alco]:checked").val(),
	  mdp(pwd,alco,'not');
	$('#info_admin').show();//affiche texte:"Avant d'entrer un mot de passe, faire un RAZ"
  });

  /*$('#enter').on('click', function() {$('pwdalarm').empty();*/
	/*
input_value:mot de passe
command:pages 1=commandes 2=alarmes 
nameid: id pour affichage texte
clique:bouton #btn_c ou #verif_mpa
vide :modal #d_btn_c ou #d_btn_a
*/	  
function maj_mdp(rep){	
if (rep==0){
	$('#pwdalarm').hide();$('#info_admin').hide();
	$('#mp1,#mp2').hide();$('#d_btn_a').hide();
	$('#d_btn_al').hide();$('#reponse1').hide();
	$('#reponse').hide();$('#btn_c').hide();$('#txt_cmd').hide();
	$('#admin1').show();$('#console1').text("pwd:OK");}
	else {$('#d_btn_a').show();
	$('#pwdalarm').hide();
	$('#console1').text("pwd:absent");
	/*document.getElementById("d_btn_al").style.display = "block";
	document.getElementById("d_btn_a").style.display = "block";*/
	$('#mp1,#mp2').show();}
console.log(rep);
}
 /*--------------------------------------------------------------*/	
function mdp(passw,command,nameid){
  $.ajax({
    method: "POST",
    url: "ajax.php",
	dataType: "json",
    data: {appp:"mdp",
	variable:passw,
	command:command
	},
    success: function(response){res=response.statut;document.getElementById(nameid).innerHTML = res;console.log(res);
			if (res!="OK") {rep=1;}
else {rep=0;} maj_mdp(rep);},
	error: function(){alert("erreur");}
	});
}	
  });


(function ($) {

    $.modalLinkDefaults = {
            height: 600,
            width: 900,
            showTitle: true,
            showClose: true,
            overlayOpacity: 0.6,
            method: "GET", // GET, POST, REF, CLONE
            disableScroll: true,
            onHideScroll: function () { },
            onShowScroll: function () { }
    };

    function hideBodyScroll(cb) {
        var w = $("body").outerWidth();
        $("body").css({ overflow: "hidden" });
        var w2 = $("body").outerWidth();
        $("body").css({ width: w });

        if (typeof cb == "function") {
            var scrollbarWidth = w2 - w;
            cb(scrollbarWidth);
        }
    }

    function showBodyScroll(cb) {
        var $body = $("body");
        var w = $body.outerWidth();
        $body.css({ width: '', overflow: '' });
        var w2 = $body.outerWidth();

        if (typeof cb == "function") {
            var scrollbarWidth = w - w2; 
            cb(scrollbarWidth);
        }
    }

    /**
     * Helper method for appending parameter to url
     */
    function addUrlParam(url, name, value) {
        return appendUrl(url, name + "=" + value);
    }

    /**
     * Hepler method for appending querystring to url
     */
    function appendUrl(url, data) {
        return url + (url.indexOf("?") < 0 ? "?" : "&") + data;
    }

    function buildOptions(option) {
        
    }
    
    function resolveBooleanValue($link) {
        
        for (var i = 1; i < arguments.length; i++) {
            var val = arguments[i];
            
            if (typeof val == "boolean") {
                return val;
            }
            
            if (typeof val == "string") {
                var attrValue = $link.attr(val);
                if (attrValue) {
                    if (attrValue.toLowerCase() === "true") {
                        return true;
                    }
                    if (attrValue.toLowerCase() === "false") {
                        return false;
                    }
                }
            }
        }
    }

    var methods = {
        init: function (options) {
            
            var settings = $.extend({}, $.modalLinkDefaults);
            $.extend(settings, options);

            return this.each(function () {
                var $link = $(this);
                
                // already bound
                if ($link.hasClass("sparkling-modal-link"))
                    return;
                
                // mark as bound
                $link.addClass("sparkling-modal-link");

                $link.click(function (e) {
                    e.preventDefault();
                    methods.open($link, settings);
                    return false;
                });
            });
        },
        
        close: function (cb) {

            var $container = $(".sparkling-modal-container");

            var $link = $container.data("modallink");

            if (!$link) {
                return;
            }

            $link.trigger("modallink.close");

            var $overlay = $container.find(".sparkling-modal-overlay");
            var $content = $container.find(".sparkling-modal-frame");

            $overlay.fadeTo("fast", 0);
            $content.fadeTo("fast", 0, function () {
                $container.remove();
                showBodyScroll(cb);

                if (typeof cb == "function") {
                    cb();
                }
            });
        },
        
        open: function ($link, options) {

            options = options || {};
            var url, title, showTitle, showClose, disableScroll;

            url = options.url || $link.attr("href");
            title = options.title 
                || $link.attr("data-ml-title")
                || $link.attr("title")
                || $link.text();
                        
            showTitle = resolveBooleanValue($link, 
                options.showTitle, 
                "data-ml-show-title", 
                $.modalLinkDefaults.showTitle);
                           
            showClose = resolveBooleanValue($link,
                options.showClose,
                "data-ml-show-close",
                $.modalLinkDefaults.showClose);
                           
            disableScroll = resolveBooleanValue($link,
                options.disableScroll,
                "data-ml-disable-scroll",
                $.modalLinkDefaults.disableScroll);
            
            var settings = $.extend({}, $.modalLinkDefaults);
            $.extend(settings, options);

            var dataWidth = $link.attr("data-ml-width");
            if (dataWidth) {
                settings.width = parseInt(dataWidth);
            }
            var dataHeight = $link.attr("data-ml-height");
            if (dataHeight) {
                settings.height = parseInt(dataHeight);
            }

            if (settings.method !== "CLONE" && url.length > 0 && url[0] === "#") {
                settings.method = "REF";
            }

            if (settings.method == "GET" || settings.method == "POST") {
                url = addUrlParam(url, "__inmodal", "true");
            }

            var data = {};

            if (typeof settings.data != 'undefined') {
                if (typeof settings.data == "function") {
                    data = settings.data();
                }
                else {
                    data = settings.data;
                }
            }

            var $container = $("<div class=\"sparkling-modal-container\"></div>");
            $container.data("modallink", $link);

            var $overlay = $("<div class=\"sparkling-modal-overlay\"></div>");
            $overlay.css({ position: 'fixed', top: 0, left: 0, opacity: 0, width: '100%', height: '100%', zIndex: 999 });
            $overlay.appendTo($container);

            var $content = $("<div class=\"sparkling-modal-frame\"></div>")
                .css("opacity", 0)
                .css({ zIndex: 1000, position: 'fixed', display: 'inline-block' })
                .css({ left: '50%', marginLeft: -settings.width / 2 })
                .css({ top: '50%', marginTop: -settings.height / 2 })
                .appendTo($container);

            $("body").append($container);

            if (showTitle) {
                
                var $title = $("<div class=\"sparkling-modal-title\"></div>");
                $title.appendTo($content);
                $title.append($("<span></span>").html(title));

                if (showClose) {
                    var $closeButton = $("<div class=\"sparkling-modal-close\"><div class='i-close'><div class='i-close-h' /><div class='i-close-v' /></div></div>");
                    $closeButton.appendTo($title);
                    $closeButton.click(methods.close);
                }
                
                $title.append("<div style=\"clear: both;\"></div>");
            }
            var $iframeContainer = $("<div class=\"sparkling-modal-content\"></div>");
            $iframeContainer.appendTo($content);

            var $iframe;
            if (settings.method == "REF") {
                $iframe = $("<div />");
                $iframe.css("overflow", "auto");

                var $ref = $(url);
                var id = "ref_" + new Date().getTime();
                var $ph = $("<div id='" + id + "' />");
                $ph.insertAfter($ref);

                $ref.appendTo($iframe);

                $link.on("modallink.close", function() {
                    $ph.replaceWith($ref);
                });

            } else {
                $iframe = $("<iframe frameborder=0 id='modal-frame' name='modal-frame'></iframe>");
            }

            $iframe.appendTo($iframeContainer);
            $iframe.css({ width: settings.width, height: settings.height });

            if (settings.method == "CLONE") {
                console.log(url);
                var $inlineContent = $(url);
                console.log($inlineContent);

                var iFrameDoc = $iframe[0].contentDocument || $iframe[0].contentWindow.document;
                iFrameDoc.write($inlineContent.html());
                iFrameDoc.close();
            }
            else if (settings.method == "GET") {
                if (typeof data == "object") {
                    for (var i in data) {
                        if (data.hasOwnProperty(i)) {
                            url = addUrlParam(url, i, data[i]);
                        }
                    }
                } else if (typeof data != "undefined") {
                    url = appendUrl(url, data);
                }
                
                $iframe.attr("src", url);
            }

            $content.css({ marginTop: -($content.outerHeight(false) / 2) });

            $overlay.fadeTo("fast", settings.overlayOpacity);
            $content.fadeTo("fast", 1);

            if (settings.method == "POST") {
                
                var $form = settings.$form;
                if ($form && $form instanceof jQuery)
                {
                    var originalTarget = $form.attr("target"); 
                    $form
                        .attr("target", "modal-frame")
                        .data("submitted-from-modallink", true)
                        .submit()
                }
                else
                {
                    $form = $("<form />")
                        .attr("action", url)
                        .attr("method", "POST")
                        .attr("target", "modal-frame")
                        .css({ display: 'none'});

                    $("<input />").attr({ type: "hidden", name: "__sparklingModalInit", value: 1 }).appendTo($form);

                    if ($.isArray(data)) {
                        for (var i in data) {
                            $("<input />").attr({ type: "hidden", name: data[i].name, value: data[i].value }).appendTo($form);
                        }
                    }
                    else
                    {
                        for (var i in data) {
                            $("<input />").attr({ type: "hidden", name: i, value: data[i] }).appendTo($form);
                        }
                    }

                    $form
                        .appendTo("body")
                        .submit();

                    $form.remove();
                }
            }

            if (disableScroll) {
                hideBodyScroll(settings.onHideScroll);
            }
        }
    };

    $.fn.modalLink = function(method) {
        // Method calling logic
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.modalLink');
            return this;
        }
    };
    
    $.modalLink = function(method) {
        // Method calling logic
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.modalLink');
            return this;
        }
    };

    $.modalLink.open = function(url, options) {
        options = $.extend({}, options);
        options.url = url;
        methods["open"].call(this, $("<a />"), options);
    };

})(jQuery);


$(document).keyup(function(e) {

    if (e.keyCode == 27) {
        $.modalLink("close");
    }   
});