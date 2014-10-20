jQuery(document).ready(function(){

	var contactsOpened = false;

	/********** ALAPOK **********/
	function fadeContent(){
		var fadeElement = jQuery("#fadeState");
		if(fadeElement.hasClass("hidden")){
			jQuery("#fadeState").removeClass("hidden");
		}else{
			jQuery("#fadeState").addClass("hidden");
		}
	}
	/* *********************** */
	/***** KAPCSOLAT DOBOZ *****/
	function positionContactsBox(){
		var baseElement = jQuery('#ndwContactsMenu');
		var pos = baseElement.offset();
		var elementToPosition = jQuery('#ndwcontacts');
		var calculatedLeftPos = pos.left - (elementToPosition.outerWidth()/2) + (baseElement.outerWidth()/2);
		elementToPosition.css('left', calculatedLeftPos + 'px');
	}
	
	function positionContactsArrow(){
		var width = jQuery('#ndwcontacts').outerWidth();
		var elementToPosition = jQuery("#ndwArrow_up");
		elementToPosition.css("left", (width/2)-(elementToPosition.width()/2));
	}
	
	positionContactsBox();
	positionContactsArrow();
	
	jQuery("#ndwContactsMenu").click(function(){
		if(!contactsOpened){
			//jQuery(this).addClass("mactive");
			jQuery("#ndwcontacts").removeClass("hidden");
			fadeContent();
			contactsOpened = true;
		}
	});
	
	jQuery(document).mouseup(function (e){
		var container = jQuery("#ndwcontacts");
		if(contactsOpened){
			if (!container.is(e.target)	&& container.has(e.target).length === 0){
				hideContactsBox(jQuery("#ndwContactsMenu"));
			}
		}
	});
	
	function hideContactsBox(elementToHide){
		//elementToHide.removeClass("mactive");
		jQuery("#ndwcontacts").addClass("hidden");
		fadeContent();
		contactsOpened = false;
	}
	/* *********************** */
	/***** KAPCSOLAT DOBOZ *****/
	jQuery(".footerClassInProgress_Container").click(function(){
		jQuery(".footerNextClass").toggleClass("hidden");
		jQuery("#footerClassInProgressArrowUp").toggleClass("hidden");
		jQuery("#footerClassInProgressArrowDown").toggleClass("hidden");
	});
	/* *********************** */
});