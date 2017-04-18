
<script src="dist/js/bootstrap-select.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<script>
getLocation();
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
function showPosition(position) { 


    $("#map").append("<iframe width='100%'' height='200' frameborder='0' style='border:0' src='https://www.google.com/maps/embed/v1/place?q="+position.coords.latitude+","+position.coords.longitude+"&amp;key=AIzaSyBAfcQFjL6DKzigwABaZiFxX8oacLO9Zwc'></iframe>");

}
</script>

<div id="map">

</div>

</body>
</html>