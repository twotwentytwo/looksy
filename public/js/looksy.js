$('.js-youtube-vid').on('change', function(){
     var newval = '',
         $this = $(this);
     if (newval = $this.val().match(/(\?|&)v=([^&#]+)/)) {
         $this.val(newval.pop());
     } else if (newval = $this.val().match(/(\.be\/)+([^\/]+)/)) {
         $this.val(newval.pop());
     } else if (newval = $this.val().match(/(\embed\/)+([^\/]+)/)) {
         $this.val(newval.pop().replace('?rel=0',''));
     }
});