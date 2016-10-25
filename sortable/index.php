<!DOCTYPE html>

<html>
<head>
    <title>Page Title</title>
</head>

<body>


<script src="http://code.jquery.com/jquery-1.9.1.js"></script>    
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>   
<script src="https://raw.github.com/furf/jquery-ui-touch-punch/master/jquery.ui.touch-punch.min.js"></script> 



<script>
  $(function() {
    $( ".documents" ).sortable();
    $( ".documents" ).disableSelection();
  });
</script>

<div id="bodyContainer">
      <ul class="documents">
        <li>1</li>
        <li>2</li>
        <li>3</li>
      </ul>
</div>
</body>
</html>
