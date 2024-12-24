<header class="mini-header">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <nav>
    <ul class="mini-header-nav">
    <li><a class="nav-link" >ARINAS</a></li>
      <li><a class="nav-link" href="index.php?action=home">Home</a></li>
      <li><a class="nav-link" href="index.php?action=addProduct">Add Product</a></li>
      <li><a class="nav-link" href="index.php?action=orders">View Commands</a></li>
      <li><a class="nav-link" href="index.php?action=users">View Users</a></li>
      <li><a class="nav-link" href="index.php?action=categories">View Categories</a></li>
    </ul>
  </nav>
</header>
<style>
/* Mini Header Styling */
.mini-header {
  background-color: rgb(220, 220, 220); /* Light background to blend in */
  padding: 10px 20px; /* Spacing */
  border-bottom: 1px solid #ddd; /* Subtle border */
  font-family: 'Poppins', sans-serif;
}

.mini-header-nav {
  list-style: none;
  display: flex;
  justify-content: space-evenly; /* Equal spacing between links */
  margin: 0;
  padding: 0;
  gap: 110px; /* Add additional spacing between links */
}

.mini-header-nav .nav-link {
  text-decoration: none;
  color: rgb(12, 4, 6); /* Bootstrap primary color */
  font-size: 16px; /* Slightly larger font size for better readability */
  letter-spacing: 1px; /* Add space between letters */
  text-transform: uppercase; /* Make all letters uppercase for uniformity */
  transition: color 0.3s ease;
}

.mini-header-nav .nav-link:hover {
  color: rgb(206, 216, 128); /* Slightly darker hover color */
}

</style>