    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../src/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../src/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../src/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="../src/dist/js/app-style-switcher.js"></script>
    <script src="../src/dist/js/feather.min.js"></script>
    <script src="../src/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../src/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../src/dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="../src/dist/js/pages/dashboards/dashboard1.min.js"></script>
    <script>
        const preview = () => {

            const formFile = document.querySelector("#formFile")
            const preview = document.querySelector("#preview")

            const fileSampul = new FileReader()
            fileSampul.readAsDataURL(formFile.files[0])

            fileSampul.onload = function(e) {
                preview.src = e.target.result
            }
        }
    </script>