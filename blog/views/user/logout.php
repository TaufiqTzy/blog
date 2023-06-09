<?php
    unset($_SESSION['sesi']);
    session_destroy();
    echo "<script>location='index.php'</script>"
?>