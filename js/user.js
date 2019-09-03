count=0
$('.card').on('click', function () {
  while(count==0){
  $('.card').toggleClass('flipped');
  count++;
  }
});
$('.card2').on('click', function () {
  $('.card2').toggleClass('flipped');
});
