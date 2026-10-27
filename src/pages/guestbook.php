<?php
session_start();

if (!isset($_SESSION['guestbook_messages'])) {
    $_SESSION['guestbook_messages'] = [];
}

$message_sent = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name'] ?? '');
    $companyname = trim($_POST['companyname'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (!empty($name) && !empty($companyname) && !empty($message)) {
        $newMessage = [
            'name' => htmlspecialchars($name),
            'company' => htmlspecialchars($companyname),
            'message' => htmlspecialchars($message)
        ];

        array_unshift($_SESSION['guestbook_messages'], $newMessage);

        header("Location: guestbook.php?success=1");
        exit();
    }
}

if (isset($_GET['success']) && $_GET['success'] == 1) {
    $message_sent = true;
}

$messages = $_SESSION['guestbook_messages'];
?>




<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Circle Solutions - Guestbook</title>
    
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/guestbook.css">
</head>

<body>
    <header class="navbar">
        <div class="nav-container">
            <a href="../index.html" class="logo">
                <img src="../images/LOGO.png" alt="Logo" class="logo-img">
            </a>

            <nav class="nav-links">
                <a href="../index.html">Home</a>
                <a href="about.html">About us</a>
                <a href="solutions.html">Solutions</a>
                <a href="contact.html">Contact</a>
                <a href="guestbook.php" class="active">Guestpage</a>
                <a href="faq.html">FAQ</a>
                <br>
                <button class="btn-lang"> NL | EN </button>
            </nav>
        </div>
    </header>

    <!-- MAIN CONTAINER -->
    <main class="container main-guestbook-layout">
        
        <?php if ($message_sent): ?>
            <div class="alert success-alert">
                <p>Thank you! Your message has been sent successfully.</p>
            </div>
        <?php endif; ?>

        <!-- FORM ALANI -->
        <div class="guestbook-form-section">
            <span class="sub-title2">Guestbook</span>
            <h1>Share your experience</h1>
            <p class="subtitle-text">Worked with Circle Solutions? Leave a note for our team in the guestbook.</p>

            <div class="form-back">
                <form action="guestbook.php" method="POST">
                    <div class="form-group">
                        <label for="name">Your Name:</label>
                        <input type="text" id="name" name="name" placeholder="Sarah Klein.." required>
                    </div>

                    <div class="form-group">
                        <label for="companyname">Company Name:</label>
                        <input type="text" id="companyname" name="companyname" placeholder="Circle Solutions..." required>
                    </div>

                    <div class="form-group">
                        <label for="message">Your Message:</label>
                        <textarea id="message" name="message" placeholder="Share your experience with us..." required></textarea>
                    </div>

                    <button type="submit" class="btn-submit">Sign the guestbook</button>
                </form>
            </div>
        </div>
<BR></BR>
        <hr>
        <br>




        <!-- RESPONSE -->
         
        <div class="guestbook-feed-section">
            
            <?php if (empty($messages)): ?>
                <div class="empty-state">
                    <p>No messages yet. Be the first to share your experience!</p>
                </div>
            <?php else: ?>

                <div class="feed-cards-container">
                    <?php foreach ($messages as $msg): ?>
                        <div class="guestbook-card">
                            <div class="card-header">
                                <div class="details">
                                    <h3><?php echo $msg['name']; ?></h3>
                                    <span class="company-name"><?php echo $msg['company']; ?></span>
                                </div>
                            </div>


                            <div class="card-body">
                                <p>"<?php echo nl2br($msg['message']); ?>"</p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

    </main>





    <!-- FOOTER --> 
    <footer class="footer">
        <div class="container footer-grid">
            <div class="footer-brand">
                <div class="logo light">
                    <span class="logo-icon"></span><img src="../images/LOGO.png" alt="">
                </div>
                <p>Custom software for logistics, healthcare, and education. <br>Founded in Amersfoort, 2005.</p>
            </div>
            <div class="footer-col">
                <h4>Company</h4>
                <ul>
                    <li><a href="../index.html">Home</a></li>
                    <li><a href="about.html">About us</a></li>
                    <li><a href="solutions.html">Solutions</a></li>
                    <li><a href="guestbook.php">Guestpage</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="faq.html">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Sector</h4>
                <ul>
                    <li><a href="solutions.html">Logistics</a></li>
                    <li><a href="solutions.html">Healthcare</a></li>
                    <li><a href="solutions.html">Education</a></li>
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
                    <a href="privacy.html">Privacy</a>
                    <a href="terms.html">Terms & Conditions</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>