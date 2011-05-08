<form enctype="multipart/form-data" action="http://localhost/nextgen/api.php" method="post">
Username: <input type="text" name="username"><br />
Device: <input type="text" name="galleryselect"><br />
Image <input type="file" name="imagefiles[]"><br />
<input type="checkbox" name="auto_fb" value="auto_fb" /> Upload to Facebook<br />
<input type="submit" name="submit">
</form>