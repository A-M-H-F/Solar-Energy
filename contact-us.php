<?php include('partials-front/menu.php'); ?>

<h3 class="contact-title">Contact Us</h3>

<div class="form">

    <form action="" method="post">
        <label for="fname">First Name</label>
        <input type="text" id="fname" name="fname" placeholder="Your name..">

        <label for="lname">Last Name</label>
        <input type="text" id="lname" name="lname" placeholder="Your last name..">

        <label for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="Your Email Address..">

        <label for="subject">Subject</label>
        <input type="text" id="subject" name="subject" placeholder="Subject..">

        <label for="message">Message</label>
        <textarea id="message" name="message" placeholder="Write something.." style="height:200px"></textarea>

        <input type="submit" name="submit" value="Submit">
    </form>

</div>

<?php
if (!empty($_POST['submit'])){

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contact_inquiry (fname, lname, email, subject, message) 
            values ('$fname', '$lname', '$email', '$subject', '$message')";

    if (mysqli_query($conn, $sql)){
        echo "We Will Contact You Soon";
    }else{
        echo "Error : ". $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}

?>

<?php include('partials-front/footer.php'); ?>