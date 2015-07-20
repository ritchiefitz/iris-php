$(document).ready(function () {
	settings();
	journalSettings();
	searchSettings();

	function getUrlParameter(sParam)
	{
	    var sPageURL = window.location.search.substring(1);
	    var sURLVariables = sPageURL.split('&');
	    for (var i = 0; i < sURLVariables.length; i++) 
	    {
	        var sParameterName = sURLVariables[i].split('=');
	        if (sParameterName[0] == sParam) 
	        {
	            return sParameterName[1];
	        }
	    }
	}

	function settings() {
		if ($("#verify_pwd").length) {
			$("#register").submit(function () {
				var password = $("#password").val();
				var verify_pwd = $("#verify_pwd").val();

				if (password != verify_pwd) {
					$(".password").addClass("has-error");
					
					$(".error-message").text("Passwords Must Match");
					
					return false;
				}
				else {
					return true;
				}
			});
		}
	}

	function searchSettings() {
		$('#search').bind('click', function () {
			var search = $("#q").val();
			var journal = $("#jid").val();

			if (search) {
				if ($(".has-error").length > 0) {
					$(".form-group").removeClass("has-error");
					$("#q").attr("placeholder", "");
				}

				$.ajax({
					method: "POST",
					url: "/search.php",
					data: { q: search, jid: journal }
					}).done(function( msg ) {
						if ($(".matched-results").length > 0) {
							$(".matched-results").remove();
						}

						$(".sidebar").append(msg);
				});
			}
			else {
				$(".form-group").addClass("has-error");
				$("#q").attr("placeholder", "Value is required!");
			}
		});

		$(document).on('click', ".matched-result", function () {
			var pageNumber = ($(this).find(".number").text() * 1) + 2;
			$("#flipbook").turn("page", pageNumber);
		});

		$("#search-form").submit(function() {
			$("#search").click();
			return false;
		});
		
	}

	function journalSettings() {
		$("#flipbook").turn({
			width: 1096,
			height: 750,
			autoCenter: true
		});

		$('body').keyup(function (event) {
			if (event.keyCode == 37) {
				$("#flipbook").turn('previous');
			}
			else if (event.keyCode == 39) {
				$("#flipbook").turn('next');
			}
		});

		$(document).on({
			mouseenter: function () {
				var $form = $(this).find(".edit-form");
				$form.show("fast");
			},
			mouseleave: function () {
				var $form = $(this).find(".edit-form");
				$form.hide();
			}
		}, '.journal-page-wrapper');

		if ($("#flipbook").length > 0 && getUrlParameter('pn')) {
			var pageNumber = (getUrlParameter('pn') * 1) + 2;
			console.log("PN: " + pageNumber);
			$("#flipbook").turn("page", pageNumber);
		}
	}
});