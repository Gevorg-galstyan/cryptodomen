!function(modules){function __webpack_require__(moduleId){if(installedModules[moduleId])return installedModules[moduleId].exports;var module=installedModules[moduleId]={exports:{},id:moduleId,loaded:!1};return modules[moduleId].call(module.exports,module,module.exports,__webpack_require__),module.loaded=!0,module.exports}var installedModules={};return __webpack_require__.m=modules,__webpack_require__.c=installedModules,__webpack_require__.p="./static/js/",__webpack_require__(0)}([function(module,exports){
	"use strict";
	
// =================================================================================
// Diagramms
// settings: 1 series : 1 values for 1 mounts, 2 years, 
//  ( 24 * 4 = 96 values)
// =================================================================================

var dataDASH = {
  	labels: ["Jan'16", "Feb'16", "Mar'16", "Apr'16","May'16", "Jun'16", 
	"Jul'16", "Aug'16",  "Sep'16", "Oct'16",  "Nov'16", "Dec'16",
	"Jan'17", "Feb'17", "Mar'17", "Apr'17","May'17", "Jun'17", 
	"Jul'17", "Aug'17",  "Sep'17", "Oct'17",  "Nov'17", "Dec'17"],
	series: [
		[0,	 0,	 0, 	0, 	0,	 0, 	40,	 210,	500,	 710,	 800,	 1110,   
		2200,	3210, 	2500,	3310,  12200, 	12400,	 11500, 	10800, 	3550, 	1510,	2300, 	2200 ],

		[0, 	0, 	0, 	0,	0,	0,	800,	310,	500,	210,	200,	210,    
		2200,	210,	200,	300, 	6600,	 11310, 	12000,	 9000, 	1800, 	1940, 	1600, 	1500 ],

		[0,	0,	0, 	0,  0,	0, 	300, 	510,	500,	210, 	200,	210,    
		200,	210,	200,	210,	4600, 	11810, 	8000, 	4000, 	1900,	2100, 	1700, 	2400],

		[0,	 0,	 0, 	0,  0, 	0, 	300, 	510,	500,	210, 	200,	210,    
		900,	210,	200,	210,	11600,	9310,	12000,	9000,	1400,	2310,	 2100, 	2400 ],
	]
};
var dataXAU = {
  	labels: ["Jan'16", "Feb'16", "Mar'16", "Apr'16","May'16", "Jun'16", 
	"Jul'16", "Aug'16",  "Sep'16", "Oct'16",  "Nov'16", "Dec'16",
	"Jan'17", "Feb'17", "Mar'17", "Apr'17","May'17", "Jun'17", 
	"Jul'17", "Aug'17",  "Sep'17", "Oct'17",  "Nov'17", "Dec'17"],
	series: [
		[200,	 0,	 0, 	0, 	0,	 0, 	40,	 210,	500,	 710,	 800,	 1110,   
		2200,	3210, 	2500,	3310,  12200, 	12400,	 11500, 	10800, 	500, 	710,	800, 	1500 ],

		[6200, 	0, 	0, 	0,	0,	0,	800,	310,	500,	210,	200,	210,    
		2200,	210,	200,	300, 	6600,	 11310, 	12000,	 9000, 	12200, 	12400, 	11500, 	2500 ],

		[2500,	0,	0, 	0,  0,	0, 	300, 	510,	500,	210, 	200,	210,    
		200,	210,	200,	210,	4600, 	11810, 	8000, 	4000, 	12200,	12400, 	11500, 	2400],

		[5000,	 0,	 0, 	0,  0, 	0, 	300, 	510,	500,	210, 	200,	210,    
		900,	210,	200,	210,	11600,	9310,	12000,	9000,	7600,	7010,	 7000, 	0 ],
	]
};
var dataQAU = {
  	labels: ["Jan'16", "Feb'16", "Mar'16", "Apr'16","May'16", "Jun'16", 
	"Jul'16", "Aug'16",  "Sep'16", "Oct'16",  "Nov'16", "Dec'16",
	"Jan'17", "Feb'17", "Mar'17", "Apr'17","May'17", "Jun'17", 
	"Jul'17", "Aug'17",  "Sep'17", "Oct'17",  "Nov'17", "Dec'17"],
	series: [
		[0,	 0,	 0, 	0, 	0,	 0, 	40,	 210,	500,	 710,	 800,	 1110,   
		2200,	3210, 	2500,	3310,  12200, 	12400,	 11500, 	10800, 	3550, 	1510,	2300, 	2200 ],

		[0, 	0, 	0, 	0,	0,	0,	800,	310,	500,	210,	200,	210,    
		2200,	210,	200,	300, 	6600,	 11310, 	12000,	 9000, 	1800, 	1940, 	1600, 	1500 ],

		[0,	0,	0, 	0,  0,	0, 	300, 	510,	500,	210, 	200,	210,    
		200,	210,	200,	210,	4600, 	11810, 	8000, 	4000, 	1900,	2100, 	1700, 	2400],

		[0,	 0,	 0, 	0,  0, 	0, 	300, 	510,	500,	210, 	200,	210,    
		900,	210,	200,	210,	11600,	9310,	12000,	9000,	1400,	2310,	 2100, 	2400 ],
	]
};
var dataETC = {
  	labels: ["Jan'16", "Feb'16", "Mar'16", "Apr'16","May'16", "Jun'16", 
	"Jul'16", "Aug'16",  "Sep'16", "Oct'16",  "Nov'16", "Dec'16",
	"Jan'17", "Feb'17", "Mar'17", "Apr'17","May'17", "Jun'17", 
	"Jul'17", "Aug'17",  "Sep'17", "Oct'17",  "Nov'17", "Dec'17"],
	series: [
		[0,	 0,	 0, 	0, 	0,	 0, 	40,	 210,	500,	 710,	 800,	 1110,   
		2200,	3210, 	2500,	3310,  12200, 	12400,	 11500, 	10800, 	3550, 	1510,	2300, 	2200 ],

		[0, 	0, 	0, 	0,	0,	0,	800,	310,	500,	210,	200,	210,    
		2200,	210,	200,	300, 	6600,	 11310, 	12000,	 9000, 	1800, 	1940, 	1600, 	1500 ],

		[0,	0,	0, 	0,  0,	0, 	300, 	510,	500,	210, 	200,	210,    
		200,	210,	200,	210,	4600, 	11810, 	8000, 	4000, 	1900,	2100, 	1700, 	2400],

		[0,	 0,	 0, 	0,  0, 	0, 	300, 	510,	500,	210, 	200,	210,    
		900,	210,	200,	210,	11600,	9310,	12000,	9000,	1400,	2310,	 2100, 	2400 ],
	]
};
var dataREP = {
  	labels: ["Jan'16", "Feb'16", "Mar'16", "Apr'16","May'16", "Jun'16", 
	"Jul'16", "Aug'16",  "Sep'16", "Oct'16",  "Nov'16", "Dec'16",
	"Jan'17", "Feb'17", "Mar'17", "Apr'17","May'17", "Jun'17", 
	"Jul'17", "Aug'17",  "Sep'17", "Oct'17",  "Nov'17", "Dec'17"],
	series: [
		[0,	 0,	 0, 	0, 	0,	 0, 	40,	 210,	500,	 710,	 800,	 1110,   
		2200,	3210, 	2500,	3310,  12200, 	12400,	 11500, 	10800, 	3550, 	1510,	2300, 	2200 ],

		[0, 	0, 	0, 	0,	0,	0,	800,	310,	500,	210,	200,	210,    
		2200,	210,	200,	300, 	6600,	 11310, 	12000,	 9000, 	1800, 	1940, 	1600, 	1500 ],

		[0,	0,	0, 	0,  0,	0, 	300, 	510,	500,	210, 	200,	210,    
		200,	210,	200,	210,	4600, 	11810, 	8000, 	4000, 	1900,	2100, 	1700, 	2400],

		[0,	 0,	 0, 	0,  0, 	0, 	300, 	510,	500,	210, 	200,	210,    
		900,	210,	200,	210,	11600,	9310,	12000,	9000,	1400,	2310,	 2100, 	2400 ],
	]
};
var dataETH = {
  	labels: ["Jan'16", "Feb'16", "Mar'16", "Apr'16","May'16", "Jun'16", 
	"Jul'16", "Aug'16",  "Sep'16", "Oct'16",  "Nov'16", "Dec'16",
	"Jan'17", "Feb'17", "Mar'17", "Apr'17","May'17", "Jun'17", 
	"Jul'17", "Aug'17",  "Sep'17", "Oct'17",  "Nov'17", "Dec'17"],
	series: [
		[0,	 0,	 0, 	0, 	0,	 0, 	40,	 210,	500,	 710,	 800,	 1110,   
		2200,	3210, 	2500,	3310,  12200, 	12400,	 11500, 	10800, 	3550, 	1510,	2300, 	2200 ],

		[0, 	0, 	0, 	0,	0,	0,	800,	310,	500,	210,	200,	210,    
		2200,	210,	200,	300, 	6600,	 11310, 	12000,	 9000, 	1800, 	1940, 	1600, 	1500 ],

		[0,	0,	0, 	0,  0,	0, 	300, 	510,	500,	210, 	200,	210,    
		200,	210,	200,	210,	4600, 	11810, 	8000, 	4000, 	1900,	2100, 	1700, 	2400],

		[0,	 0,	 0, 	0,  0, 	0, 	300, 	510,	500,	210, 	200,	210,    
		900,	210,	200,	210,	11600,	9310,	12000,	9000,	1400,	2310,	 2100, 	2400 ],
	]
};
var dataBCH = {
  	labels: ["Jan'16", "Feb'16", "Mar'16", "Apr'16","May'16", "Jun'16", 
	"Jul'16", "Aug'16",  "Sep'16", "Oct'16",  "Nov'16", "Dec'16",
	"Jan'17", "Feb'17", "Mar'17", "Apr'17","May'17", "Jun'17", 
	"Jul'17", "Aug'17",  "Sep'17", "Oct'17",  "Nov'17", "Dec'17"],
	series: [
		[0,	 0,	 0, 	0, 	0,	 0, 	40,	 210,	500,	 710,	 800,	 1110,   
		2200,	3210, 	2500,	3310,  12200, 	12400,	 11500, 	10800, 	3550, 	1510,	2300, 	2200 ],

		[0, 	0, 	0, 	0,	0,	0,	800,	310,	500,	210,	200,	210,    
		2200,	210,	200,	300, 	6600,	 11310, 	12000,	 9000, 	1800, 	1940, 	1600, 	1500 ],

		[0,	0,	0, 	0,  0,	0, 	300, 	510,	500,	210, 	200,	210,    
		200,	210,	200,	210,	4600, 	11810, 	8000, 	4000, 	1900,	2100, 	1700, 	2400],

		[0,	 0,	 0, 	0,  0, 	0, 	300, 	510,	500,	210, 	200,	210,    
		900,	210,	200,	210,	11600,	9310,	12000,	9000,	1400,	2310,	 2100, 	2400 ],
	]
};
var dataBTC = {
  	labels: ["Jan'16", "Feb'16", "Mar'16", "Apr'16","May'16", "Jun'16", 
	"Jul'16", "Aug'16",  "Sep'16", "Oct'16",  "Nov'16", "Dec'16",
	"Jan'17", "Feb'17", "Mar'17", "Apr'17","May'17", "Jun'17", 
	"Jul'17", "Aug'17",  "Sep'17", "Oct'17",  "Nov'17", "Dec'17"],
	series: [
		[0,	 0,	 0, 	0, 	0,	 0, 	40,	 210,	500,	 710,	 800,	 1110,   
		2200,	3210, 	2500,	3310,  12200, 	12400,	 11500, 	10800, 	3550, 	1510,	2300, 	2200 ],

		[0, 	0, 	0, 	0,	0,	0,	800,	310,	500,	210,	200,	210,    
		2200,	210,	200,	300, 	6600,	 11310, 	12000,	 9000, 	1800, 	1940, 	1600, 	1500 ],

		[0,	0,	0, 	0,  0,	0, 	300, 	510,	500,	210, 	200,	210,    
		200,	210,	200,	210,	4600, 	11810, 	8000, 	4000, 	1900,	2100, 	1700, 	2400],

		[0,	 0,	 0, 	0,  0, 	0, 	300, 	510,	500,	210, 	200,	210,    
		900,	210,	200,	210,	11600,	9310,	12000,	9000,	1400,	2310,	 2100, 	2400 ],
	]
};
var dataEUR = {
  	labels: ["Jan'16", "Feb'16", "Mar'16", "Apr'16","May'16", "Jun'16", 
	"Jul'16", "Aug'16",  "Sep'16", "Oct'16",  "Nov'16", "Dec'16",
	"Jan'17", "Feb'17", "Mar'17", "Apr'17","May'17", "Jun'17", 
	"Jul'17", "Aug'17",  "Sep'17", "Oct'17",  "Nov'17", "Dec'17"],
	series: [
		[0,	 0,	 0, 	0, 	0,	 0, 	40,	 210,	500,	 710,	 800,	 1110,   
		2200,	3210, 	2500,	3310,  12200, 	12400,	 11500, 	10800, 	3550, 	1510,	2300, 	2200 ],

		[0, 	0, 	0, 	0,	0,	0,	800,	310,	500,	210,	200,	210,    
		2200,	210,	200,	300, 	6600,	 11310, 	12000,	 9000, 	1800, 	1940, 	1600, 	1500 ],

		[0,	0,	0, 	0,  0,	0, 	300, 	510,	500,	210, 	200,	210,    
		200,	210,	200,	210,	4600, 	11810, 	8000, 	4000, 	1900,	2100, 	1700, 	2400],

		[0,	 0,	 0, 	0,  0, 	0, 	300, 	510,	500,	210, 	200,	210,    
		900,	210,	200,	210,	11600,	9310,	12000,	9000,	1400,	2310,	 2100, 	2400 ],
	]
};
var dataUSD = {
  	labels: ["Jan'16", "Feb'16", "Mar'16", "Apr'16","May'16", "Jun'16", 
	"Jul'16", "Aug'16",  "Sep'16", "Oct'16",  "Nov'16", "Dec'16",
	"Jan'17", "Feb'17", "Mar'17", "Apr'17","May'17", "Jun'17", 
	"Jul'17", "Aug'17",  "Sep'17", "Oct'17",  "Nov'17", "Dec'17"],
	series: [
		[0,	 0,	 0, 	0, 	0,	 0, 	40,	 210,	500,	 710,	 800,	 1110,   
		2200,	3210, 	2500,	3310,  12200, 	12400,	 11500, 	10800, 	3550, 	1510,	2300, 	2200 ],

		[0, 	0, 	0, 	0,	0,	0,	800,	310,	500,	210,	200,	210,    
		2200,	210,	200,	300, 	6600,	 11310, 	12000,	 9000, 	1800, 	1940, 	1600, 	1500 ],

		[0,	0,	0, 	0,  0,	0, 	300, 	510,	500,	210, 	200,	210,    
		200,	210,	200,	210,	4600, 	11810, 	8000, 	4000, 	1900,	2100, 	1700, 	2400],

		[0,	 0,	 0, 	0,  0, 	0, 	300, 	510,	500,	210, 	200,	210,    
		900,	210,	200,	210,	11600,	9310,	12000,	9000,	1400,	2310,	 2100, 	2400 ],
	]
};
var chartOptions = {
  	seriesBarDistance: 10,
	axisX: {
		offset: 40,
	},
	axisY: {
		offset: 40,
		labelInterpolationFnc: function(value) {
			return (value / 100) + 'M'
		},
		scaleMinSpace: 22,
	}
};

var responsiveOptions = [
	['screen and (max-width: 640px)', {
	seriesBarDistance: 15,
	axisX: {
	  labelInterpolationFnc: function (value, index) {
	    return index % 2 === 0 ? value : null;
	  }
	 
	}
	}],
	['screen and (max-width: 440px)', {
	seriesBarDistance: 20,
	axisX: {
	  labelInterpolationFnc: function (value, index) {
	    return index % 3 === 0 ? value : null;
	  }
	 
	}
	}]
];

function fchartName (chartName, dataName ){
	new Chartist.Bar('.ct-chart-'+chartName, dataName, chartOptions, responsiveOptions);
}

var activeFchart = $('.currency_chart .tabs input:checked + label');
var chartName = activeFchart.text();
if(chartName.length > 1){
	var dataName =  eval('data' + chartName);
	fchartName(chartName, dataName);
}

$('.currency_chart .tabs label').click(function(){
	var chartName = $(this).text();
	var dataName =  eval('data' + chartName);
	fchartName(chartName, dataName);
})




// =================================================================================
//  parallax effect
// =================================================================================

$(document).ready(function() {
var movementStrength = 25;
var height = movementStrength / $(window).height();
var width = movementStrength / $(window).width();
$("#top-image").mousemove(function(e){
          var pageX = e.pageX - ($(window).width() / 2);
          var pageY = e.pageY - ($(window).height() / 2);
          var newvalueX = width * pageX * -1 - 25;
          var newvalueY = height * pageY * -1 - 50;
          $('#top-image').css("background-position", newvalueX+"px     "+newvalueY+"px");
});
});


// =================================================================================
//  swap-fields
// =================================================================================


function swapCurrs(parent) {
    var fromInput = $('#amount_from_input', parent),
        fromInputVal = fromInput.val(),
        fromBtn = $('#change-currency-from-btn', parent),
        fromBtnImgSrc = fromInput.attr('placeholder'),
        fromBtnText = fromBtn.html(),
        toInput = $('#amount_to_input', parent),
        toInputVal = toInput.val(),
        toBtn = $('#change-currency-to-btn', parent),
        toBtnImgSrc = toInput.attr('placeholder'),
        toBtnText = toBtn.html();

    fromInput.val(toInputVal);
    toInput.val(fromInputVal);
    fromInput.attr("placeholder", toBtnImgSrc);
    toInput.attr("placeholder", fromBtnImgSrc);
    toBtn.html(fromBtnText);
    fromBtn.html(toBtnText);
}
$(document).ready(function() {
	$('.swap-fields').click(function(e){
		e.preventDefault();
		var parent = $(this).closest( ".form-body" );
		swapCurrs(parent);
	})

});




// =================================================================================
//  tabs
// =================================================================================

$(function() {

  $('.tabs_menu').on('click', 'li:not(.active)', function(event) {
    $(this)
      .addClass('active').siblings().removeClass('active')
      .closest('.tabs').find('div.tabs_content .section').removeClass('active').eq($(this).index()).addClass('active');
 
 		event.preventDefault();
	    var $this =  $(this);
	    var id  = $('a', $this).attr('href');
        var top = $(id).offset().top;
         if($(window).width()  < "748"){
	    //анимируем переход на расстояние - top за 1500 мс
        	$('body,html').animate({scrollTop: top}, 1500); 
		} 
      
  });

// wallets tabs

  $('.wallets_menu').on('click', 'td:not(.active) a.wallet', function(e) {
  	e.preventDefault();
  	$('.wallets_menu td.active').removeClass('active');
  	$('.wallets_content .content_inner').removeClass('active');
  	var walletSource = $(this).attr('id');
    $(this).parent().addClass('active');
    var activWallet = $('.wallets_content').find("[data-wallet='" + walletSource + "']");
  	activWallet.addClass('active');
  	var top = activWallet.offset().top;

  	 $('body,html').animate({scrollTop: top}, 1500); 
  });

});





// =================================================================================
//  total balance
// =================================================================================	
	function checkBalanceList(){
		var currentBalance = $(".current_balance").data("balance");
	 	$(".personal_balance_menu li").each(function() {
	        $(this).show();
	        if ($(this).data("balance") == currentBalance) {
	            $(this).hide();
	            // var langStr = $(this).text();
	            // $(".current-lang").text(langStr)
	        }
        });
    };

 $(document).ready(function() {
    checkBalanceList();
    $( ".personal_balance_menu li" ).click(function() {
    	var langStr = $(this).html();
    	var dataBalance = $(this).data("balance");
    	$(".current_balance").html(langStr);
    	$(".current_balance").data("balance", dataBalance);
    	checkBalanceList();
    });

    $(document).on("click", ".personal_balance", function() {
        "none" == $(".personal_balance_menu").css("display") ? ($(".personal_balance_menu").show()) : ($(".personal_balance_menu").hide())
    });
    $(document).on("click", function(e) {
        $(e.target).hasClass("personal_balance") || "block" != $(".personal_balance_menu").css("display") || ($(".personal_balance_menu").hide())
    })
 });


// =================================================================================
// dropdown-menu
// =================================================================================
$(document).ready(function() {
    $( ".dropdown-menu li" ).click(function() {
    	var langStr = $(this).html();
    	$(".dropdown-toggle").html(langStr)
    });

    $(document).on("click", ".dropdown-select", function() {
        "none" == $(".dropdown-menu").css("display") ? ($(".dropdown-menu").show()) : ($(".dropdown-menu").hide())
    });
    $(document).on("click", function(e) {
        $(e.target).hasClass("dropdown-select") || "block" != $(".dropdown-menu").css("display") || ($(".dropdown-menu").hide())
    })
 });



// =================================================================================
// lang-list
// =================================================================================

var myLang = $('.current-lang').data('lang');
$(document).on('click', '.lang-list .lang', function() {
    window.location.href = $(this).data('href');
});

$(document).on('click', '.lang-switcher', function() {
    if ($('.lang-list').css('display') == 'none'){
        $('.lang-list').show();
    }else{
        $('.lang-list').hide();
    }
});
$(document).on("click", function(e) {
        $(e.target).is('.current-lang, .current-lang span, .current-lang img') || "block" != $(".lang-list").css("display") || ($(".lang-list").hide())
    })



// =================================================================================
// fancybox
// =================================================================================
$(document).ready(function() {
	$('.fancybox').fancybox({
		padding: 0, autoCenter : true, helpers: {overlay: {locked: false }}
	});
});




// =================================================================================
// MObile menu
// =================================================================================
$(document).ready(function() {
function toggleClassMenu() {	
myMenu.classList.add("menu--animatable");
if(!myMenu.classList.contains("menu--visible")) myMenu.classList.add("menu--visible");
else myMenu.classList.remove('menu--visible');
}
// -------------- Функция отображения второстепенного меню
function OnTransitionEnd() {myMenu.classList.remove("menu--animatable"); }
// -------------- Создание из главного меню скрытого
var myMenu=document.querySelector(".menu-wrap");
var oppMenu=document.querySelector(".open-menu");
if(myMenu) {myMenu.addEventListener("transitionend", OnTransitionEnd, false); myMenu.addEventListener("click", toggleClassMenu, false);}
if(oppMenu) oppMenu.addEventListener("click", toggleClassMenu, false);

});

// =================================================================================
// switch
// =================================================================================
$(document).ready(function() {

$('.switch').change(function(){
    $(this).toggleClass('checked');
  });
});



// =================================================================================
// popups fancybox
// =================================================================================
$(document).ready(function() {
$('#confirmEmail .btn-main').click(function(e){ 
    if($('#confirmEmail input').val().length <  1) {
    	$('#confirmEmail  .warning').show();
 	} 
 	else if( $('#confirmEmail input').val().length>1){
 		$('#confirmEmail .step1').hide()
		$('#confirmEmail .step2').show()

 	}
	
})
$('#confirmPhone .btn-main').click(function(e){
	if($('#confirmPhone input').val().length <  1) {
    	$('#confirmPhone  .warning').show();
 	} 
 	else if( $('#confirmPhone input').val().length>1){
 		$('#confirmPhone .step1').hide()
		$('#confirmPhone .step2').show()
 	}
})

$('.expanded').click(function(e){
	e.preventDefault();
});






});


}]);