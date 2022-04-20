<?php 
print_r($_POST);
?>


<div class="upload-form" id="uploader">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
*{box-sizing: border-box;}
body{
	font-family:Arial;
}

header{
	background-color: #1F73D8;
	padding: 5px;
	text-align: center;
	font-size: 16px;
	color: white;
}
section{
padding: 30px;
text-align: center;
}
footer{
background-color: #777;
  padding: 10px;
  text-align: center;

}
b1 { 
font-size: 12px;
padding: 10px;
margin: 20px;
}
b2 { 
font-size: 12px;
padding: 10px;
margin: 20px;
}
c { 

padding: 5px;
margin: 20px;
}
h1{
        background-color: white;
	padding: 20px;
	text-align: center;
	font-size: 50px;
	color: #1F73D8;
}

.button { 
background-color: #e7e7e7;
border:1px solid Black;
color: black;
padding: 10px 20px;
text-align: center;
display: inline-block;
font-size: 16px;
margin: 10px 10px;
cursor: pointer;
transition-duration: 0.7s;
border-radius: 10px;
}
.button:active {
transform: translateY(2px);
}
.button2:hover {
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
}
.button1:hover {
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
}
.button3:hover {
  background-color: red;
  color: black;
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
}
label {
    background-color: #e7e7e7;
    border: 1px solid Black;
    color: black;
    padding: 10px 20px;
    font-size: 15px;
    cursor: pointer;
    transition-duration: 0.7s;
    border-radius: 10px;
    display: inline-block;
}
    
label:hover {
    box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
}
</style>
</head>

    <!-- Form Heading -->
 <body>
    <header>
    <h2 class="replace-text">LangLearn</h2>
    </header>

    <h1 class="replace-text">Upload Form</h1>
    

    <!-- Select & Upload Button -->
<section>
  <form action="upload.php" method="POST">
    <input type="file" id="filebtn" name="f">
    <label for="filebtn">Select</label>
    <input type="submit" class="button button2" id="Uploadfile" href="#">
</form>
    
    <b2> <a class="button button2" id="Uploadfile" href="#">Upload</a> </b2>
</section>
<footer>
    <p><c><a class="button button3" id="Close Window" href="#">Close</a></c></p>
 </footer>
</body>

    <!-- File List -->
    <div id="filelist" class="cb"></div>
 
    <!-- Progress Bar -->
    <div id="progressbar"></div>
 
    <!-- Close After Upload -->
    <div id="closeAfter">
        <span class="checkbox">
            <input type="checkbox" name="checkbox" id="checkbox">
            <label for="checkbox">Close window after upload</label>
        </span>


    </div>

</div>
