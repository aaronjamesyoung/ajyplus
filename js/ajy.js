jQuery(document).ready(function(){

//** NAVIGATION **//

//add class to WP parent menu items.
jQuery('ul.sub-menu').parent().addClass('has-sub-menu');

//use with table-cell style navigation only. Delete otherwise.
//$.fn.iWouldLikeToAbsolutelyPositionThingsInsideOfFrickingTableCellsPlease = function() {
  //var $el;
  //return this.each(function() {
    //$el = $(this);
    //var newDiv = $("<div />", {
      //"class": "innerWrapper",
      //"css"  : {
        //"height"  : $el.height(),
        //"width"   : "100%",
        //"position": "relative"
      //}
    //});
    //$el.wrapInner(newDiv);
  //});
//};
//$(".has-sub-menu").iWouldLikeToAbsolutelyPositionThingsInsideOfFrickingTableCellsPlease();

//Responsive nav - on small screens we change stuff.
//check this media query against any needed in scss/layouts/_navigation.scss
if(Modernizr.mq('only all and (max-width: 600px)')) {
  jQuery('body').addClass('body-push');
  jQuery('.menu-toggle').click(function() {
    jQuery('body').toggleClass('body-push-right');
    jQuery('.navigation-main .menu').toggleClass('menu-open');
  });
}

//use with dropdown navigation of any style. On mobile, tap once to see submenu, tap again to follow link
//the selector below will work for table-cell nav with the above snippet. But
//it will need to be changed for float-style nav
//test and check this out. I've had mixed results.
jQuery(".touch .navigation-main li:has(ul)>a").click(function() {
  if( !jQuery(this).hasClass('omega13') ) {
    //activate the omega 13
    jQuery(this).addClass('omega13');
    return false;
  }
});

//** FOUNDATION COMPONENTS **//
//for foundation stuff, see: http://foundation.zurb.com/docs/javascript.html
jQuery(document).foundation('clearing');

}); //end document ready
