<?php
    if (isset($_POST['submit'])) {
        require "./common/config.php";
        require "./common/common.php";
    
        try {
          $connection = new PDO($dsn, $username, $password, $options);

          $new_contact = array(
            "name" => $_POST['name'],
            "phone" => $_POST['phone'],
            "nickname" => $_POST['nickname'],
            "email" => $_POST['email']
          );

          $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "contacts",
            implode(", ", array_keys($new_contact)),
            ":" . implode(", :", array_keys($new_contact))
          );

          $statement = $connection -> prepare($sql);
          $statement -> execute($new_contact);
        
        } catch(PDOException $error) {
          echo $error -> getMessage();
        }
    
    }
?>

<?php include "./templates/header.php"; ?>

    <?php
      if(isset($_POST['submit']) && $statement) {
        echo $_POST['name'];
        echo "Successfully added!";
      }
    ?>

    <h1>Add Contact</h1>

    <div class="form-wrapper">
      <form method="post">
      	<label for="name">Name</label>
      	<input type="text" name="name" id="name">
      	<label for="phone">Phone</label>
      	<input type="text" name="phone" id="phone">
          <label for="nickname">Nickname</label>
      	<input type="text" name="nickname" id="nickname">
      	<label for="email">Email Address</label>
      	<input type="email" name="email" id="email">
      
        <div class="submit-wrapper">
      	  <input type="submit" name="submit" value="Add" class="btn">
        </div>
      </form>
    </div>


    <div class="wrapper">
      <a href="./public/contacts.php" class="btn-nav">Back to all contacts</a>
    </div>

<?php include "./templates/footer.php"; ?>