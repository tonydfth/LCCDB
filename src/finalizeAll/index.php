<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>confirmation page</title>
    <meta name="description" content="confirmation for finalize all">
    <meta name="author" content="Tony Jiao">
    <script language = "javascript">
            function finalizeCheck(id){
              if(confirm("Are you sure you want to permanently finalize all schools for all students?")){
                window.location.href='process.php?finalizeAll=' +id+'';
              }
            }
    </script>
    <script language = "javascript">
            function unfinalizeCheck(id){
              if(confirm("Are you sure you want to permanently unfinalize all schools for all students?")){
                window.location.href='process.php?unfinalizeAll=' +id+'';
              }
            }
    </script>
    <link rel="stylesheet" href="css/styles.css?v=1.0">
</head>
<body>

<h1>By clicking the button, you will finalize all schools for all students. This action is irreversible. This action should only be done on August 1st.</h1>
<p><a href="../roster" class="btn btn-secondary">Go Back</a></p>
<p><a href="#" onClick="finalizeCheck(1)"
    class="btn btn-warning">Finalize All</a></p>
<p><a href="#" onClick="unfinalizeCheck(1)"
    class="btn btn-warning">Unfinalize All</a></p>


</body>
</html>