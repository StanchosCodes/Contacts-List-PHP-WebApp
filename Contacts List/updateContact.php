<?php require "./common/common.php" ?>
<?php require "./common/config.php" ?>

<?php

    if (isset($_POST['submit'])) {
        try {
            $connection = new PDO($dsn, $username, $password, $options);

            $contact = [
                "id" => $_POST['Id'],
                "name" => $_POST['Name'],
                "phone" => $_POST['Phone'],
                "nickname" => $_POST['Nickname'],
                "email" => $_POST['Email']
            ];

            $sql = "UPDATE contacts
                    SET name = :name,
                        phone = :phone,
                        nickname = :nickname,
                        email = :email
                    WHERE id = :id";

            $statement = $connection -> prepare($sql);
            $statement -> execute($contact);
?>
    <script type="text/javascript">
        window.location.replace("http://localhost:3000/public/contacts.php");
    </script>
<?php            
        } catch (PDOException $error) {
            echo $error -> getMessage();
        }
    }
?>

<?php
    if (isset($_GET['id'])) {
        try {
            $connection = new PDO($dsn, $username, $password, $options);

            $id = $_GET['id'];
            $sql = "SELECT * FROM contacts WHERE id = :id";

            $statement = $connection -> prepare($sql);
            $statement -> bindValue(':id', $id);
            $statement -> execute();

            $contact = $statement -> fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {
            echo $error -> getMessage();
        }
    } else {
        echo "Failed to update a contact. Please try again.";
        exit;
    }
?>

<?php require "./templates/header.php" ?>

    <h1>Update contact info</h1>

    <div class="form-wrapper">
        <form method="post">
            <?php foreach ($contact as $key => $value) { ?>
                        <?php
                            if ($key != 'IsDeleted') { ?>
                                <label for="<?php echo $key; ?>"> <?php echo $key; ?> </label>
                                <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>"
                                <?php echo ($key === 'Id' ? 'readonly' : null); ?>
                                <?php echo ($key === 'GroupId' ? 'readonly' : null); ?>>
                        <?php } ?>
            <?php } ?>
            
            <div class="submit-wrapper">
                <input type="submit" name="submit" value="Done" class="btn">
            </div>
        </form>
    </div>

    <div class="wrapper">
        <a href="./public/contacts.php" class="btn-nav">Back to all contacts</a>
    </div>

<?php require "./templates/footer.php" ?>