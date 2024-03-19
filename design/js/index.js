var myModal = document.getElementById('myModal')
var myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', function () {
  myInput.focus()
})




        
        

        
$(document).ready(function() {

  $('.counter').each(function () {
$(this).prop('Counter',0).animate({
  Counter: $(this).text()
}, {
  duration: 4000,
  easing: 'swing',
  step: function (now) {
      $(this).text(Math.ceil(now));
  }
});
}); 

});  



