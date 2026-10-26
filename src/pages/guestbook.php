<?php
  if (isset($_POST)){
    // do something here //

  }

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Circle Solutions - Guestbook </title>
   
    <link rel="stylesheet" href="../css/guest.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- NAVBAR -->
     <header class="navbar">
<div class="nav-container">
<a href="pages/index.html" class="logo">
    <img src="../images/LOGO.png" alt="" class="logo-img">
</a>

    <nav class="nav-links">
        <a href="../index.html" class="active">Home</a>
        <a href="../pages/about.html">About us</a>
        <a href="solutions.html">Solutios</a>
        <a href="../pages/contact.html">Contact</a>
        <a href="../pages/guestbook.php">Guestpage</a>
        <a href="../pages/faq.html">FAQ</a>
        <br>
        <button class="btn-lang"> NL | EN </button>
</nav>
</div>
     </header>









    <!-- Form -->

      <?php if ($message_sent): ?>
                    
                <div class="alert">
                        Thank you for subscribing! Your details have been sent successfully.
                </div>


    
        <span class="sub-title2">Guestbook</span>
        <h1>Share your experinece</h1>
        <p>Worked with Circle Solutions? Leave a note for our team in the guestbook.
</p>
        <div class="container-php">
        <form action="guestbook.php" method="POST">

            <div class="form-group">
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" placeholder="Sarah Klein..">
            </div>

            <div class="form-group">
    <label for="companyname">Company Name:</label>
    <input type="text" id="companyname" name="companyname" placeholder="Circle Solutions...">
</div>

<div class="form-group">
    <label for="message">Your Message:</label>
    <textarea id="message" name="message" placeholder="Share your experience with us..."></textarea>
</div>

             <button type="submit">Sign the guestbook</button>
        </form>
</div>



   <BR></BR>
    <!-- FOOTER --> 

 <footer class="footer">
    <div class="container footer-grid">
      <div class="footer-brand">
        <div class="logo light">
          <span class="logo-icon"></span><img src="../images/LOGO.png" alt="">
        </div>
        <p>Custom software for logistics, healthcare, and education. <br>Founded in amersfoort, 2005.</p>
      </div>
      <div class="footer-col">
        <h4>Company</h4>
        <ul>
          <li><a href="pages/index.html">Home</a></li>
          <li><a href="pages/about.html">About us</a></li>
          <li><a href="pages/solutions.html">Solutions</a></li>
          <li><a href="pages/guestpage.html">Guestpage</a></li>
          <li><a href="pages/contact.html">Contact</a></li>
          <li><a href="pages/faq.html">FAQ</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Sector</h4>
        <ul>
          <li><a href="pages/solutions.html">Logistics</a></li>
          <li><a href="pages/solutions.html">Healthcare</a></li>
          <li><a href="pages/solutions.html">Education</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Get in touch</h4>
        <p>info@circlesolutions.com</p>
        <p>+31 0 12 34 56 78</p>
        <p>Amersfoort, Netherlands</p>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container flex-between">
        <p>&copy; 2026 Circle Solutions B.V. — Amersfoort, Netherlands</p>
        <div class="legal-links">
          <a href="pages/privacy.html">Privacy</a>
          <a href="pages/terms.html">Terms & Conditions</a>
        </div>
      </div>
    </div>
  </footer>

</body>
</html>