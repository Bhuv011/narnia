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
    var url = "livefeed.php?time=" + now.getTime();
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
        document.getElementById('dispatch_request').innerHTML = '<h2>No Request!</h2>';
        setTimeout(updateLiveData(), 1000);
      } else {
        const txt = xhr.responseText;  
        const obj = JSON.parse(txt);
        var hindi = 'लोकेशन देखने के लिए नीचे दिए गए बटन पर क्लिक करें';
        document.getElementById('dispatch_request').innerHTML = '<h2>Dispatch Request!</h2><p>Click on the button given below to view the location. <br><br>'+hindi+'</p><a href="redirect-to-maps.php?latitude='+obj.latitude+'&longitude='+obj.longitude+'&user_id='+obj.user_id+'" id="addressLink" class="btn btn-success">Open In Google Maps</a>';
      } 
    }
  }
});