// Modal
var modal = document.getElementById("myModal");

var closeBtn = document.getElementsByClassName("close")[0];

function openModal() {
  modal.style.display = "block";
}

function closeModal() {
  modal.style.display = "none";
}

closeBtn.onclick = closeModal;

window.onclick = function (event) {
  if (event.target == modal) {
    closeModal();
  }
};


//navigation sticky on scroll

window.addEventListener('scroll', function() {
var nav = document.querySelector('.nav');
var header = document.querySelector('.header');

if (window.scrollY > header.clientHeight) {
nav.classList.add('sticky');
} else {
nav.classList.remove('sticky');
}
});

//contact-us

  function initMap() {
    const location = { lat: 40.7128, lng: -74.0060 }; 
    const map = new google.maps.Map(document.getElementById("map"), {
      center: location,
      zoom: 15 
    });
    const marker = new google.maps.Marker({
      position: location,
      map: map,
      title: "Our Location" 
    });
  }

//reservation

function showSelectedTime(selectedHour) {
var party = document.getElementById('partySize').value;
var date = document.getElementById('reservationDate').value;
var selectedInfo = 'Selected Party: ' + party + ' | Selected Date: ' + date + ' | Selected Hour: ' + selectedHour;
document.getElementById('selectedInfo').textContent = selectedInfo;
}


 // JavaScript to toggle the mobile menu
 document.querySelector('.nav__menu-icon').addEventListener('click', function () {
  document.querySelector('.nav__links').classList.toggle('active');
});

