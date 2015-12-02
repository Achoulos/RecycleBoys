<footer class="footer">
  Created by Alex Choulos and Eric Bonilla.
  <b>Contact: </b>
  <a href="mailto:achoulos@scu">achoulos@scu.edu ⋅ </a> 
  <a href="mailto:ebonilla@scu">ebonilla@scu.edu</a>
</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
<script src="quiz.js"></script>
<script>
  var d = new Date();

  var month = d.getMonth()+1;
  var day = d.getDate();

  var output = month + '/' + day + '/' + d.getFullYear();

  $("#date").append(output);
</script>