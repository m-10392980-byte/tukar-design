<?php
// Header file with modern sidebar navigation layout

function render_header() {
    echo '<header>';
    echo '<nav class="sidebar">';
    // Add navigation links here
    echo '<ul>';
    echo '<li><a href="#">Home</a></li>';
    echo '<li><a href="#">About</a></li>';
    echo '<li><a href="#">Services</a></li>';
    echo '<li><a href="#">Contact</a></li>';
    echo '</ul>';
    echo '</nav>';
    echo '</header>';
}

?>