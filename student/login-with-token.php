<?php
$token = isset($_GET['token']) ? $_GET['token'] : '';
if ($token != '') {
?>
    <script>
        var token = `<?php echo $token; ?>`
        localStorage.setItem('studentToken', token);
        window.location.href = "https://dev.gemsnext.com/student/dashboard.php";
    </script>
<?php
}
