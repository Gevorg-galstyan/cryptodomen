$(".form-validate").submit(function (x) {
    form_validate(x, true)
});


function form_validate(e, submit) {
    e.preventDefault();
    var t = e.target.action, n = $(e), r = new FormData;
    for (i = 0; i < e.target.length; i++) {
        if ("" != e.target[i].value) {
            if ("file" == e.target[i].type) {
                r.append(e.target[i].name, e.target[i].files[0])
            } else {
                r.append(e.target[i].name, e.target[i].value)
            }
        }
        // "file" == this.elements[i].type && "" == this.elements[i].value || r.append(this.elements[i].name, this.elements[i].value);
    }
    r.set("_validate", "1"),
        $.ajax({
            url: t,
            type: "POST",
            dataType: "json",
            data: r,
            processData: !1,
            contentType: !1,
            beforeSend: function () {
                $("body").css("cursor", "progress"), $(".has-error").removeClass("has-error"), $(".help-block").remove()
            },
            success: function (e) {
                if (e.errors) {
                    $("body").css("cursor", "auto"), $.each(e.errors, function (t, n) {
                        var i = $("[name='" + t + "']"), r = i.first().parent().offset().top,
                            o = $("nav.navbar").height();
                        0 === Object.keys(e.errors).indexOf(t) && $("html, body").animate({scrollTop: r - o + "px"}, "fast"), i.parent().addClass("has-error").append("<span class='help-block' style='color:#f96868'>" + n + "</span>")
                    });
                } else {
                    if (submit) {
                        $(n).unbind("submit").submit();
                    } else {
                        return e;
                    }
                }
            },
            error: function () {
                if (submit) {
                    $(n).unbind("submit").submit();
                } else {
                    return false;
                }
            }
        })
}


$('.add-wallet-form').submit(function (form) {
    var wallet = $(this).data('form');
    var data = form_validate(form, false);
    $('tbody[data-tbody="'+wallet+'"]')
});
