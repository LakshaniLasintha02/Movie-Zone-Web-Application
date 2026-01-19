<?php
// footer.php
?>

<style>
/* Footer Styling */
footer {
    background: rgba(0, 0, 0, 0.95);
    color: #fff;
    text-align: center;
    padding: 20px 0;
    font-size: 14px;
    width: 100%;
    margin-top: auto;
    transition: box-shadow 0.3s ease, background 0.3s ease;
    position: relative;
}

/* Layout fix */
html, body {
    height: 100%;
    margin: 0;
    display: flex;
    flex-direction: column;
}

.main-content {
    flex: 1;
}

/* Social Media Icons */
.footer-social {
    margin: 15px 0;
}

.footer-social a {
    display: inline-block;
    margin: 0 12px;
    transition: transform 0.3s ease;
}

.footer-social img {
    width: 30px;
    height: 30px;
    filter: drop-shadow(0 0 5px #fff);
    transition: filter 0.3s ease, transform 0.3s ease;
}

.footer-social a:hover img {
    filter: drop-shadow(0 0 10px #ffcc00) drop-shadow(0 0 20px #ffcc00);
    transform: scale(1.2);
}

/* Footer Glow Effect when hovering icons */
.footer-social a:hover ~ footer,
.footer-social a:hover {
    box-shadow: 0 0 30px #ffcc00 inset;
    background: rgba(0, 0, 0, 1);
}
</style>

<!-- Footer -->
<footer>
    <p>&copy; <?php echo date("Y"); ?> Movie Zone | All Rights Reserved</p>

    <div class="footer-social">
        <a href="https://facebook.com" target="_blank">
            <img src="img/facebook.png" alt="Facebook">
        </a>
        <a href="https://twitter.com" target="_blank">
            <img src="img/twitter.png" alt="Twitter">
        </a>
        <a href="https://instagram.com" target="_blank">
            <img src="img/instagram.png" alt="Instagram">
        </a>
        <a href="https://youtube.com" target="_blank">
            <img src="img/youtube.png" alt="YouTube">
        </a>
    </div>

    <p>Designed by Lakshani</p>
</footer>
