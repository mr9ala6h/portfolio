<?php
include 'db.php';

function e($text) {
    return htmlspecialchars((string)$text, ENT_QUOTES, 'UTF-8');
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    if ($name == "" || $message == "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please fill all fields with valid data.";
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO contact (name, email, message) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $message);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("Location: index.php?sent=1#contact");
        exit;
    }
}
$msg = isset($_GET["sent"]) ? "Message sent!" : "";

$about    = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM about LIMIT 1"));
$skills   = mysqli_query($conn, "SELECT * FROM skills");
$projects = mysqli_query($conn, "SELECT * FROM projects");

$photo = basename($about['photo'] ?? '');
if ($photo == "" || !file_exists("images/" . $photo)) {
    $photo = "default.svg";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<nav>
    <div class="logo">Portfolio</div>
    <ul id="menu">
        <li><a href="#home">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#skills">Skills</a></li>
        <li><a href="#projects">Projects</a></li>
        <li><a href="#contact">Contact</a></li>
    </ul>
    <button id="toggleBtn" onclick="toggleMode()">Dark Mode</button>
    <button id="menuBtn" onclick="toggleMenu()" aria-label="Menu">&#9776;</button>
</nav>

<section id="home">
    <img src="images/<?php echo e($photo); ?>" alt="Profile photo" class="profile-img">
    <h1>Welcome to My Portfolio</h1>
    <p class="name"><?php echo e($about['name']); ?></p>
    <p class="job"><?php echo e($about['title']); ?></p>
</section>

<section id="about">
    <h2>About Me</h2>
    <p><?php echo nl2br(e($about['bio'])); ?></p>
</section>

<section id="skills">
    <h2>Skills</h2>
    <ul>
        <?php while ($row = mysqli_fetch_assoc($skills)) { ?>
            <li class="skill-tag"><?php echo e($row['skill_name']); ?></li>
        <?php } ?>
    </ul>
</section>

<section id="projects">
    <h2>Projects</h2>
    <div class="projects-grid">
        <?php while ($row = mysqli_fetch_assoc($projects)) { ?>
            <div class="project-card">
                <h3><?php echo e($row['project_name']); ?></h3>
                <p><?php echo e($row['description']); ?></p>
            </div>
        <?php } ?>
    </div>
</section>

<section id="contact">
    <h2>Contact Me</h2>
    <?php if ($msg != "") { echo "<p class='success'>" . e($msg) . "</p>"; } ?>
    <?php if ($error != "") { echo "<p class='error'>" . e($error) . "</p>"; } ?>
    <form method="POST">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <textarea name="message" placeholder="Your Message" required></textarea>
        <button type="submit">Send</button>
    </form>
</section>

<script src="script.js"></script>
</body>
</html>
