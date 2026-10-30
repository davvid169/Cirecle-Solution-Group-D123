<?php
session_start();

if (!isset($_SESSION['guestbook_messages'])) {
    $_SESSION['guestbook_messages'] = [];
}

// delate
if (isset($_GET['delete'])) {
    $delete_index = intval($_GET['delete']);
    if (isset($_SESSION['guestbook_messages'][$delete_index])) {
        unset($_SESSION['guestbook_messages'][$delete_index]);
        
        $_SESSION['guestbook_messages'] = array_values($_SESSION['guestbook_messages']);
    }
    header("Location: guestbook.php");
    exit();
}

$message_sent = false;
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name'] ?? '');
    $companyname = trim($_POST['companyname'] ?? '');
    $message = trim($_POST['message'] ?? '');

    $name_pattern = "/^\p{L}+([\s'\p{L}]+)*$/u";
    $company_pattern = "/^[\p{L}0-9\s.,&\-]+$/u";

    if (empty($name) || empty($companyname) || empty($message)) {
        $error_message = "Please fill in all required fields.";
    } elseif (mb_strlen($name) < 2 || mb_strlen($name) > 50) {
        $error_message = "Name must be between 2 and 50 characters long.";
    } elseif (!preg_match($name_pattern, $name)) {
        $error_message = "Name can only contain letters and spaces (no numbers or special characters allowed).";
    } elseif (mb_strlen($companyname) < 3 || mb_strlen($companyname) > 100) {
        $error_message = "Company name must be between 3 and 100 characters long.";
    } elseif (!preg_match($company_pattern, $companyname)) {
        $error_message = "Company name cannot contain forbidden special characters like ?, !, /, \\, {, }, [, ], < >, *, =, %.";
    } elseif (mb_strlen($message) < 10) {
        $error_message = "Your message is too short. Please provide at least 10 characters.";
    } elseif (mb_strlen($message) > 500) {
        $error_message = "Your message cannot exceed 500 characters.";
    } else {
        // Capitalization for name and company name
        $formatted_name = mb_convert_case(mb_strtolower($name, 'UTF-8'), MB_CASE_TITLE, 'UTF-8');
        $formatted_company = mb_convert_case(mb_strtolower($companyname, 'UTF-8'), MB_CASE_TITLE, 'UTF-8');

        $newMessage = [
            'name' => htmlspecialchars($formatted_name),
            'company' => htmlspecialchars($formatted_company),
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
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Guestbook - Circle Solutions</title>

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
<a href="guestbook.php" class="active">Guestbook</a>
<a href="faq.html">FAQ</a>
<br>
	<div class="lang-switch" role="group" aria-label="Language">
		<button class="btn-lang" data-lang="en" type="button">EN</button>
		<button class="btn-lang" data-lang="nl" type="button">NL</button>
	</div>
</nav>
</div>
</header>

<main class="container main-guestbook-layout">

<!-- FORM -->
<div class="guestbook-form-section">
<span class="sub-title2">Guestbook</span>
<h1>Share your experience</h1>
<p class="subtitle-text">Worked with Circle Solutions? Leave a note for our team in the guestbook.</p>

<!-- Success -->
<?php if ($message_sent): ?>
<div style="background-color: #d4edda; color: #155724; padding: 12px; margin-bottom: 20px; border-radius: 5px;">
Thank you! Your message has been successfully posted.
</div>
<?php endif; ?>

<!-- Error -->
<?php if (!empty($error_message)): ?>
<div style="background-color: #f8d7da; color: #721c24; padding: 12px; margin-bottom: 20px; border-radius: 5px;">
<?php echo htmlspecialchars($error_message); ?>
</div>
<?php endif; ?>

<div class="form-back">
<form action="guestbook.php" method="POST">
<div class="form-group">
<label for="name">Your Name :</label>
<br>
<input type="text" id="name" name="name" placeholder="Sarah Klein.."
minlength="2" maxlength="50"
value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
</div>

<div class="form-group">
<label for="companyname">Company Name :</label>
<br>
<input type="text" id="companyname" name="companyname" placeholder="Circle Solutions..."
minlength="2" maxlength="100"
value="<?php echo isset($_POST['companyname']) ? htmlspecialchars($_POST['companyname']) : ''; ?>">
</div>

<div class="form-group">
<label for="message">Your Message (10 - 500 characters):</label>
<br>
<textarea id="message" name="message" placeholder="Share your experience with us..."
minlength="10" maxlength="500"><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
</div>

<button type="submit" class="btn-submit">Sign the guestbook</button>
</form>
</div>
</div>
<br><br>
<hr>
<br>

<!-- response -->
<div class="guestbook-feed-section">
<?php if (empty($messages)): ?>
<div class="empty-state">
<p>No messages yet. Be the first to share your experience!</p>
</div>

<?php else: ?>
<div class="feed-cards-container">
<?php foreach ($messages as $index => $msg): ?>
<div class="guestbook-card">
<div class="card-header">
<div class="details" style="width: 100%; display: flex; justify-content: space-between; align-items: flex-start;">
<div>
<h3><?php echo $msg['name']; ?></h3>
<span class="company-name"><?php echo $msg['company']; ?></span>
</div>
<!-- Unicode  -->
<a href="guestbook.php?delete=<?php echo $index; ?>" 
   onclick="return confirm('Are you sure you want to delete this message?');" 
   style="color: #dc3545; font-size: 18px; text-decoration: none; padding: 2px 6px;">
   🗑️
</a>

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
    
