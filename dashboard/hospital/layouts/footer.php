<footer class="bg-white rounded shadow p-5 mb-4 mt-4">
    <div class="row">
        <div class="col-12 col-md-4 col-xl-6 mb-4 mb-md-0">
            <p class="mb-0 text-center text-lg-start"><span class="current-year"></span> <a class="text-primary fw-normal" href="https://innovate-trix-2021-static.vercel.app/" target="_blank"><img src="../../logo.png" width="30" /> Ambulify </a></p>
        </div>
        <div class="col-12 col-md-8 col-xl-6 text-center text-lg-start">
            <!-- List -->
            <ul class="list-inline list-group-flush list-group-borderless text-md-end mb-0">
                <li class="list-inline-item px-0 px-sm-2">
                    <a href="https://innovate-trix-2021-static.vercel.app/">About</a>
                </li>
                <li class="list-inline-item px-0 px-sm-2">
                    <a href="https://innovate-trix-2021-static.vercel.app/contact">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</footer>
        </main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Core -->
<script src="../../dashboard/vendor/@popperjs/popper.min.js"></script>
<script src="../../dashboard/vendor/bootstrap/bootstrap.min.js"></script>

<!-- Charts -->
<script src="../../dashboard/vendor/chartist/chartist.min.js"></script>
<script src="../../dashboard/vendor/chartist/chartist-plugin-tooltip.min.js"></script>

<!-- Sweet Alerts 2 -->
<script src="../../dashboard/vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>


<!-- Live Notifications -->
<?php 
    include '../assets/js/volt.php';
?>
<script src="live-notifications/autoUpdate.js"></script>


<script>
document.getElementById("beds").addEventListener("input", inputEvt => {
   setTimeout(updateBed, 3000);
   function updateBed() {
       var beds = document.getElementById("beds").innerHTML;
        document.getElementById("inputBeds").value = beds;

        jQuery.ajax({
            url: 'update-beds.php?beds='+beds,
            success: function(result) {
                alert(result);
            }
        });
   }
}, false);
</script>
<!-- Handle Requests -->
</body>

</html>
