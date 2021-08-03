window.addEventListener("load", function () {
  var xhr = null;

  getXmlHttpRequestObject = function () {
    if (!xhr) {
      // Create a new XMLHttpRequest object
      xhr = new XMLHttpRequest();
    }
    return xhr;
  };

  updateLiveData = function () {
    var now = new Date();
    // Date string is appended as a query with live data
    // for not to use the cached version
    var url = "live-notifications/livefeed.php?time=" + now.getTime();
    xhr = getXmlHttpRequestObject();
    xhr.onreadystatechange = evenHandler;
    // asynchronous requests
    xhr.open("GET", url, true);
    // Send the request over the network
    xhr.send(null);
  };

  updateLiveData();

  function evenHandler() {
    // Check response is ready or not
    if (xhr.readyState == 4 && xhr.status == 200) {

      if (xhr.responseText == 0 || xhr.responseText == null) {
        setTimeout(updateLiveData(), 1000);
      } else {
        const txt = xhr.responseText;  
        const obj = JSON.parse(txt);
        Swal.fire({
          title: "<strong>EMERGENCY REQUEST!</strong>",
          html: '<p class="text-center">A patient has requested you to dispatch an ambulance on an urgent basis.</p>' +
            "<p class='p-0 m-0 text-left'><b>Name:</b> " + obj.user_name + "<br>" +
            "<b>Phone:</b> " + obj.user_phone + "</p><br>" +
            "<p>Please take an action within 30 seconds!</p>",
          showCloseButton: true,
          showCancelButton: true,
          focusConfirm: true,
          confirmButtonColor: "#28a75c",
          confirmButtonText: "<a href='accept-patient.php?id=" + obj.user_id + "' style='text-decoration: none;color: #fff'>Accept</a>",
          confirmButtonAriaLabel: "Accept",
          cancelButtonColor: "#d33",
          cancelButtonText: "<a href='reject-patient.php?id=" + obj.user_id + "' style='text-decoration: none;color: #fff'>Reject</a>",
          cancelButtonAriaLabel: "Reject",
        });
      }
    }
  }
});