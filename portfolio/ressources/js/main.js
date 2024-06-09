
//STIKY MENU
$(".js--services-section").waypoint(function(direction){
	if (direction == "down") {
		$(".stiky-nav").addClass("stiky");
		document.getElementById("my_stiky").style.display="block";
	}else{
		$(".stiky-nav").removeClass("stiky");
		document.getElementById("my_stiky").style.display="none";
	}
});

/*mix it up*/	
var mixer = mixitup('.container');

//Active link

$(".stiky-nav .main_nav li a").click(function(){
	$(".stiky-nav .main_nav li a").removeClass("active");
	$(this).addClass("active");
});

$(".stiky-nav img.logo").click(function(){
	$(".stiky-nav .main_nav li a").removeClass("active");
	$(".stiky-nav .main_nav li:first-child a").addClass("active");
})

/*functions for main menu toggle*/
function openNav(){
	document.getElementById("myNav").style.display="block";

}
function closeNav(){
	document.getElementById("myNav").style.display="none";

}
/*functions for hamberger menu*/
function mobile_openNav(){
	document.getElementById("mobile_nav").style.width="100%";
}
function mobile_closeNav(){
	document.getElementById("mobile_nav").style.width="0";
}
/*Smooth scroll for IE/EDGE/SAFARI*/
$("a").on('click',function(event){
	if (this.hash!=="") {
		event.preventDefault();
		var hash = this.hash;
		$('html,body').animate({
			scrollTop:$(hash).offset().top
		},800,function(){
			window.location.hash=hash
		});
	}
})