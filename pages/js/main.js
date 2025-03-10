$(window).on('load', function() {
    //for use in production please remove this setTimeOut
    setTimeout(function(){ 
         $('.preloader').addClass('preloader-deactivate');
       // $('.preloader').addClass('preloader');
    }, 1400);
    //uncomment this line for use this snippet in production
    //	$('.preloader').addClass('preloader-deactivate');
});




(function(b){b.toast=function(a,h,g,l,k){b("#toast-container").length||(b("body").prepend('<div id="toast-container" aria-live="polite" aria-atomic="true"></div>'),b("#toast-container").append('<div id="toast-wrapper"></div>'));var c="",d="",e="text-muted",f="",m="object"===typeof a?a.title||"":a||"Notice!";h="object"===typeof a?a.subtitle||"":h||"";g="object"===typeof a?a.content||"":g||"";k="object"===typeof a?a.delay||3E3:k||3E3;switch("object"===typeof a?a.type||"":l||"info"){case "info":c="bg-info";
f=e=d="text-white";break;case "success":c="bg-success";f=e=d="text-white";break;case "warning":case "warn":c="bg-warning";f=e=d="text-white";break;case "error":case "danger":c="bg-danger",f=e=d="text-white"}a='<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="'+k+'">'+('<div class="toast-header '+c+" "+d+'">')+('<strong class="mr-auto">'+m+"</strong>");a+='<small class="'+e+'">'+h+"</small>";a+='<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">';
a+='<span aria-hidden="true" class="'+f+'">&times;</span>';a+="</button>";a+="</div>";""!==g&&(a+='<div class="toast-body">',a+=g,a+="</div>");a+="</div>";b("#toast-wrapper").append(a);b("#toast-wrapper .toast:last").toast("show")}})(jQuery);


const TYPES = ['info', 'warning', 'success', 'error'],
      TITLES = {
        'info': 'Notice!',
        'success': 'Awesome!',
        'warning': 'Watch Out!',
        'error': 'Doh!'
      };
      // CONTENT = {
      //   'info': 'Hello, world! This is a toast message.',
      //   'success': 'The action has been completed.',
      //   'warning': 'It\'s all about to go wrong',
      //   'error': 'It all went wrong.'
      // };

function show_toast(types,content)
{
  let type = TYPES[types],
      title = TITLES[type];

  $.toast({
    title: title,
    subtitle: '1 second ago',
    content: content,
    type: type,
    delay: 5000
  });
}

function show_snack(types,contents)
{
  let type = TYPES[types];
      content = contents.replace('toast', 'snack');
  $.toast({
    title: content,
    type: type,
    delay: 5000
  });
}

// function show_snack(type)
// {
//   let type = TYPES[type],
//       content = CONTENT[type].replace('toast', 'snack');
      
//   $.toast({
//     title: content,
//     type: type,
//     delay: 5000
//   });
// }
