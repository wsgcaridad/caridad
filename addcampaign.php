<?php
include 'parse/parse.php';

if(isset($_POST['submit'])){
  $cname= $_POST[''];
  $desc= $_POST['desc'];
  $amt= $_POST['amt'];
  $email= $_POST['email'];
  $duration = $_POST['duration'];
  $disease=$_POST['disease'];
  $mpacc = $_POST['mpacc'];

    if($_FILES['filebutton']) {
    $uploaddir = 'images/';
    $uploadfile = $uploaddir . basename($_FILES['filebutton']['name']);
    chmod($uploadfile, 0755);

    if (move_uploaded_file($_FILES['filebutton']['tmp_name'], $uploadfile)) {
        $file = new parseFile('image/jpeg', file_get_contents($uploadfile));
      $fileReturn = $file->save('pic.jpg');
      if($fileReturn){
        $parse = new parseObject('campaign');
        $parse->image = $parse->dataType('file', array( $fileReturn->name ));
        $parse->name = $cname;
        $parse->desc = $desc;
        $parse->amount = intval($amt);
        $parse->email = $email;
        $parse->duration = $duration;
        $parse->disease = $disease;
        $parse->mpower = $mpacc;
        if($parse->save()){
          echo "Show created Successfully";
        };

      }
    } else {
        echo "Possible file upload attack!\n";
    }
  }

}

include 'head.php';
?>

    
<div class="span7 white-bg sm-pad">
<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Create a campaign</legend>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="uname">Campaign Name</label>
  <div class="controls">
    <input id="uname" name="uname" type="text" placeholder="Campaign name" class="input-xlarge" required="">
    
  </div>
</div>

<!-- File Button --> 
<div class="control-group">
  <label class="control-label" for="filebutton">Image</label>
  <div class="controls">
    <input id="filebutton" name="filebutton" class="input-file" type="file">
  </div>
</div>

<!-- Textarea -->
<div class="control-group">
  <label class="control-label" for="desc">Campaign Description</label>
  <div class="controls">                     
    <textarea id="desc" name="desc"></textarea>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="amt">Amount Required</label>
  <div class="controls">
    <input id="amt" name="amt" type="text" placeholder="" class="input-xlarge" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="duration">Duration</label>
  <div class="controls">
    <input id="duration" name="duration" type="text" placeholder="Duration" class="input-xlarge" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="mpacc">Mpower Account Number</label>
  <div class="controls">
    <input id="mpacc" name="mpacc" type="text" placeholder="Mpower Account Number" class="input-xlarge">
    
  </div>
</div>
</html>
<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="email">Email</label>
  <div class="controls">
    <input id="email" name="email" type="text" placeholder="Email" class="input-xlarge" required="">
    
  </div>
</div>


<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="disease">Disease</label>
  <div class="controls">
    <input id="disease" name="disease" type="text" placeholder="Disease" class="input-xlarge" required="">
    
  </div>
</div>

<!-- Button -->
<div class="control-group">
  <label class="control-label" for="submit"></label>
  <div class="controls">
    <button id="submit" name="submit" class="btn btn-primary">Submit</button>
  </div>
</div>

</fieldset>
</form>
</div>
<?php include 'foot.php'; ?>