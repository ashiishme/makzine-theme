
jQuery(document).ready(function(){
			jQuery(".search-icon").click(function(){
				jQuery(".search-box").find("input").focus();
				jQuery(".search-box").toggleClass("show-box");
			});
		});

// popover demo
jQuery("[data-toggle=popover]")
.popover({html:true});

