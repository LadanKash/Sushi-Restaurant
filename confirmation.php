<!DOCTYPE html>
<html lang="en">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" type="image/png" href="img/icon.png">
  <!-- CSS Libraries -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&display=swap" rel="stylesheet">
 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Custom Styles -->
  <link rel="stylesheet" href="style.css">
  <title>confirmation</title>
<head>
    <meta charset="utf-8">
    <title>Using form to update an external file</title>
   
       <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f6f6;
            margin: 0;
            padding: 0;
             flex-direction: column;
            align-items: center;
        }

        .content{
     text-align: center;
     margin-bottom: 20px;
     padding-bottom: 20px;
    
        }

        h1 {
            color: #333;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 39%;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .error {
            color: red;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

           .social-buttons {
            display: flex;
           /* justify-content: space-around;*/
            margin-bottom: 20px;
            margin-top: 20px;
            margin-left: 460px;
        }

        .social-buttons a {
            text-decoration: none;
            color: #fff;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            width: 25%;
            text-align: center;
            width: 200px;
            height: auto;
        }

        .fb {
            background-color: #3b5998;
            margin-left: 10px;
           
        }

        .google {
            background-color: #dd4b39;
            margin-left: 10px;
        }

    </style>

</head>
<body>

<?php
$name = $email = $phone = $comment = "";
$nameError = $emailError = $phoneError = "";

$confirmationMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    $name = test_input($_POST["name"]);
    if (empty($name)) {
        $nameError = "Name is required";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $nameError = "Only letters and white space allowed";
    }

    // Validate email
    $email = test_input($_POST["email"]);
    if (empty($email)) {
        $emailError = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format";
    }

    // Validate phone with a regular expression
    $phone = test_input($_POST["phone"]);
    if (!empty($phone) && !preg_match("/^[0-9]{10}$/", $phone)) {
        $phoneError = "Invalid phone format";
    }

    $comment = test_input($_POST["comment"]);

    // Append comment to file
    $file = fopen("comments.txt", "a") or die("Unable to open file");
    fwrite($file, "Name: $name\nEmail: $email\nPhone: $phone\nComment: $comment\n\n");
    fclose($file);

    // Set confirmation message
    $confirmationMessage = "Thank you, $name $phone! Your reservation is confirmed. We will contact you at $email.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<script>
function submitForm() {
    // Extract form data
    const name = document.getElementById('ember282').value;
    const phone = document.getElementById('ember283').value;
    const email = document.getElementById('ember284').value;

    // Hide the form and navigation buttons
    document.getElementById('reservation-form').style.display = 'none';
    document.getElementById('back-button').style.display = 'none';
    document.getElementById('next-button').style.display = 'none';

    // Display confirmation message
    const confirmationMessage = document.getElementById('confirmation-message');
    const message = `Thank you, ${name} ${phone}! Your reservation is confirmed. We will contact you at ${email}.`;
    confirmationMessage.innerHTML = message;

    // Show the confirmation message
    confirmationMessage.style.display = 'block';
}
</script>
<div class="content">
    <div class="restaurant-details" >
        <h1 style="margin-right: 14%;">Fauget Sushi</h1>
        <address style="margin-right: 28%;">
            <div class="address">34C - 3237 boul des Sources, QC</div><br>
            <div class="phone">+1 (123) 555-5555</div>
        </address>
    </div>

    <div class="social-buttons">
        <a href="#" class="fb btn"><i class="fa fa-facebook fa-fw"></i> Login with Facebook</a>
        <a href="#" class="google btn"><i class="fa fa-google fa-fw"></i> Login with Google+</a>
    </div>

    <div class="container">


        <!-- Add a div for the confirmation message -->
        <div id="confirmation-message"><?php echo $confirmationMessage; ?></div>

    </div>
</div>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
    <label>Name:</label>
    <input type="text" name="name" value="<?php echo $name; ?>" required>
    <span class="error"><?php echo $nameError; ?></span><br>
    <label>Email:</label>
    <input type="text" name="email" value="<?php echo $email; ?>" required>
    <span class="error"><?php echo $emailError; ?></span><br>
    <label>Phone:</label>
    <input type="text" name="phone" value="<?php echo $phone; ?>" required>
    <span class="error"><?php echo $phoneError; ?></span><br>
     <div class="group">
              <label>Preferred communication channel:</label>
              <label class="ember-radio-button checked ">
                <input aria-checked="true" required="" name="communication-channel" id="email" class="ember-view" type="radio" value="email">
                <span>E-mail</span>
              </label>
              <label class="ember-radio-button  ">
                <input aria-checked="false" name="communication-channel" id="mobile" class="ember-view" type="radio" value="sms">
                <span>Mobile</span>
              </label>
            </div>
    <label>Comment:</label>
    <textarea name="comment" rows="5" cols="40"><?php echo $comment; ?></textarea> <br>

    <button type="submit" name="submit">Submit!</button>
</form>
<a href="reservation.html">
<a href="index.html"><button id="next-button" onclick="submitForm()" style= "float: right;margin-right: 21%;">Next</button></a>
<a href="reservation.html"><button id="back-button" onclick="showForm()" style= "float: right;margin-right: 1%;">Back</button></a>
 <div></div>
 <Footer>Footer</Footer>
</body>
</html>
