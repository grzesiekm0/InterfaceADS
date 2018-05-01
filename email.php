<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BMW ADS, OBD i K+DCAN</title>

    <!-- Bootstrap -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
      

      body { padding-top: 70px; height: 100%; }


		  .navbar{
			background-color: #35383D
		  }
		  .container{
			height: 100%;
			width: 500px;

		  }
		  

	  

    </style>
  </head>
  <body>
  
<div class="col-sm-12">
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">
            	<li>
	            <a class="navbar-brand" href="index.html">Start</a></li>
	            <li>
	            <a class="navbar-brand" href="sklep_ads.html">ADS</a></li>
	            <li>
	            <a class="navbar-brand" href="sklep_ads-obd.html">ADS-OBD</a></li>
	            <li>
	            <a class="navbar-brand" href="sklep_obd-usb.html">OBD-USB</a></li>
	            <li>
	            <a class="navbar-brand" href="sklep_k+dcan.html">K+DCAN</a></li>
	        </ul>
	        <ul class="nav navbar-nav navbar-right">
              <li class="koszyk">
                <a href="#" data-toggle="modal" data-target="#myModal">Koszyk (<span class="simpleCart_quantity"></span>)</a></li>
            </ul>
	    	</div>              
        </div><!-- /.container-fluid -->
      </nav>

    </div>
   

   <div class="container" >
 
    
  

<?php
  $to = 'mail@someshop.com';
  $subject = 'Simple Cart Order';
  $content = $_POST;
  $body = '';
  $firstname = 'shipp'; /* extra field variable */
  $grandTotal = 0;

  for($i=1; $i < $content['itemCount'] + 1; $i++) {
  $name = 'item_name_'.$i;
  $quantity =  'item_quantity_'.$i;
  $price = 'item_price_'.$i;
  $body .= '';

  $total = $content[$quantity]*$content[$price]; /* product total price variable (price*quantity) */
$grandTotal = $grandTotal + $total; /* accumulating the total of all items */
$body .= 'Recz#'.$i.': '.$content[$name]."".' --- Ilość '.$content[$quantity].' --- Cena: '.number_format($content[$price], 2, '.', '')."PLN".' --- Razem: '.number_format($total, 2, '.', '')."PLN\n"; /* creating a semantic format for each ordered product */
$body .= ' =================================='."\n";

  }

  $grandTotal = $grandTotal + $content[$firstname];


  /* ending the loop to get all orders from the stored array */
$body .= ' Przesylka:'.number_format($content[$firstname], 2, '.', '')."PLN\n"; 

$body .= ' ================='."\n";


  /* ending the loop to get all orders from the stored array */
$body .= ' Koszt całkowity:'.number_format($grandTotal, 2, '.', '')."PLN"; /* total amount of the order */


//echo $body;
  
  ?>


	


<?php
//--- początek formularza ---
if(empty($_POST['submit'])) {
?>
						<div class="form">
                        <div class="card-header">
                            <h3 class="mb-0">Zamówienie</h3>
                        </div>
						<form action="" method="post">
						<div class="card-body" >
							<div class="form-group" >
                                    <label for="inputName">Imie i nazwisko</label>
                                    <input type="text" class="form-control" name="formName" placeholder="Imie i nazwisko">
                            </div>
							<div class="form-group">
                                    <label for="inputEmail3">Email*</label>
                                    <input type="email" class="form-control" name="formEmail" placeholder="Email" required="">
                            </div>
							<div class="form-group">
                                    <label for="message2" class="mb-0">Dane do wysyłki*</label>
                                    <div class="row mb-1">
                                        <div class="col-lg-12">
                                            <textarea rows="6" name="formText" class="form-control" required=""></textarea>
                                        </div>
                                    </div>
									<div class="content" style="display: none;">
									<textarea rows="6" name="formText2" class="form-control" required=""><?php echo $body; ?></textarea>
									</div>
									
                            </div>
							<div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg float-right" name="submit" value="Wyślij formularz">Złóż zamówienie</button>
                                    
                                </div>
						</div>
						</form>
						</div>

<?php
} else {

//twoje dane
$email = 'interfejsads@gmail.com';

//dane z formularza
$formName = $_POST['formName'];
$formEmail = $_POST['formEmail'];
$formText = $_POST['formText'];
$formText2 = $_POST['formText2'];

if(!empty($formName) && !empty($formEmail) && !empty($formText)) {

//--- początek funkcji weryfikującej adres e-mail ---
function checkMail($checkmail) {
  if(filter_var($checkmail, FILTER_VALIDATE_EMAIL)) {
    if(checkdnsrr(array_pop(explode("@",$checkmail)),"MX")){
        return true;
      }else{
        return false;
      }
  } else {
    return false;
  }
}
//--- koniec funkcji ---
if(checkMail($formEmail)) {
  //dodatkowe informacje: ip i host użytkownika
  $ip = $_SERVER['REMOTE_ADDR'];
  $host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
 
  //tworzymy szkielet wiadomości
  //treść wiadomości
  $mailText = "Treść wiadomości:\n $formText2 \n \n $formText\nOd: $formName, $formEmail ($ip, $host)";
 
  //adres zwrotny
  $mailHeader = "From: $formName <$formEmail>";
 
  //funkcja odpowiedzialna za wysłanie e-maila
  @mail($email, 'Formularz kontaktowy', $mailText, $mailHeader) or die('<div class="container text-center"><h2>Błąd: zamówienie nie zostało wysłane</h2></div>');
 
  //komunikat o poprawnym wysłaniu wiadomości
  echo '<div class="container text-center"><h2>Zamówienie została złożone</h2><a class="btn btn-default" href="index.html">Powrót</a> </div> ';
  
} else {
   echo '<div class="container text-center"><h2>Adres e-mail jest niepoprawny</h2></div>';
}

} else {
  //komunikat w przypadku nie powodzenia
     echo '<div class="container text-center"><h2>Wypełnij wszystkie pola formularza</h2></div>';
}

//--- koniec formularza ---
}

?>



</div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

    <script src="js/simpleCart.js"></script>

  </body>
</html>