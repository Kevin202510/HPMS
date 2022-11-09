<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
</body>
</html>

<script>
    $(document).ready(function(){
        let url = window.location.href;
        let newurl = url.substr(28);
        if(newurl==="usermanagement.php"){
            $("#usersidebtn").addClass("active");
        }else if(newurl==="parkingslot.php"){
            $("#pssidebtn").addClass("active");
        }else if(newurl==="parkinglogs.php"){
            $("#plsidebtn").addClass("active");
        }else if(newurl==="pointofsale.php"){
            $("#possidebtn").addClass("active");
        }else if(newurl==="index.php"){
            $("#dashsidebtn").addClass("active");
        }
    });
</script>
