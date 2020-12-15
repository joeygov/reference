<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <!-- Button to Open the Modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
   Time IN
  </button>

  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
       
        <div class="modal-header">
          <h4 class="modal-title">TIME IN</h4>
        </div>
        
        <!-- Modal body -->
        <center>
        <div class="modal-body">
            <h5>TIME</h5>
            <h5>Employee Name:</h5>
        </div>
        </center>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" id="ok"  class="btn btn-secondary" data-dismiss="modal">OK</button>
          <button type="button" id ="cancel" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
        
      </div>
    </div>
  </div>
  
</div>
<style>
    button{
        width:80px;
    }
    #ok{
        background-color:#2a7ddb
    }
    #cancel{
        background-color:#e3403d
    }
</style>

</body>
</html>
