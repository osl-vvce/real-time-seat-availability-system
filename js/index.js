var elem = document.querySelector('.range1');

var rangeValue = function(){
  var newValue = elem.value;
  var target = document.querySelector('.value');
  target.innerHTML = newValue;
}

elem.addEventListener("input", rangeValue);

var elem2 = document.querySelector('.range2');

var rangeValue2 = function(){
  var newValue2 = elem2.value;
  var target2 = document.querySelector('.value1');
  target2.innerHTML = newValue2;
}

elem2.addEventListener("input", rangeValue2);

var elem3 = document.querySelector('.range3');

var rangeValue3 = function(){
  var newValue3 = elem3.value;
  var target3 = document.querySelector('.value2');
  target3.innerHTML = newValue3;
}

elem3.addEventListener("input", rangeValue3);