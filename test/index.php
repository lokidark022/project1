<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>test only</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <button class="btn-block btn-primary" onclick="show_random_toast();">Show Random Toast</button>
      <br>
      <button class="btn-block btn-primary" onclick="show_random_snack();">Show Random Snack</button>



       <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



      <script type="text/javascript">
        

        (function(b){b.toast=function(a,h,g,l,k){b("#toast-container").length||(b("body").prepend('<div id="toast-container" aria-live="polite" aria-atomic="true"></div>'),b("#toast-container").append('<div id="toast-wrapper"></div>'));var c="",d="",e="text-muted",f="",m="object"===typeof a?a.title||"":a||"Notice!";h="object"===typeof a?a.subtitle||"":h||"";g="object"===typeof a?a.content||"":g||"";k="object"===typeof a?a.delay||3E3:k||3E3;switch("object"===typeof a?a.type||"":l||"info"){case "info":c="bg-info";
f=e=d="text-white";break;case "success":c="bg-success";f=e=d="text-white";break;case "warning":case "warn":c="bg-warning";f=e=d="text-white";break;case "error":case "danger":c="bg-danger",f=e=d="text-white"}a='<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="'+k+'">'+('<div class="toast-header '+c+" "+d+'">')+('<strong class="mr-auto">'+m+"</strong>");a+='<small class="'+e+'">'+h+"</small>";a+='<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">';
a+='<span aria-hidden="true" class="'+f+'">&times;</span>';a+="</button>";a+="</div>";""!==g&&(a+='<div class="toast-body">',a+=g,a+="</div>");a+="</div>";b("#toast-wrapper").append(a);b("#toast-wrapper .toast:last").toast("show")}})(jQuery);


const TYPES = ['info', 'warning', 'success', 'error'],
      TITLES = {
        'info': 'Notice!',
        'success': 'Awesome!',
        'warning': 'Watch Out!',
        'error': 'Doh!'
      },
      CONTENT = {
        'info': 'Hello, world! This is a toast message.',
        'success': 'The action has been completed.',
        'warning': 'It\'s all about to go wrong',
        'error': 'It all went wrong.'
      };

function show_random_toast()
{
  let type = TYPES[Math.floor(Math.random() * TYPES.length)],
      title = TITLES[type],
      content = CONTENT[type];

  $.toast({
    title: title,
    subtitle: '11 mins ago',
    content: content,
    type: type,
    delay: 5000
  });
}

function show_random_snack()
{
  let type = TYPES[Math.floor(Math.random() * TYPES.length)],
      content = CONTENT[type].replace('toast', 'snack');
      
  $.toast({
    title: content,
    type: type,
    delay: 5000
  });
}
      </script>




     

  </body>
</html>