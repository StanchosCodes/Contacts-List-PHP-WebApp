<?php require "./common/common.php" ?>
<?php require "./common/config.php" ?>

<?php
        try {
            if (isset($_GET['id'])) {
                $connection = new PDO($dsn, $username, $password, $options);

                $id = $_GET['id'];

                $sql = "UPDATE contacts
                        SET isDeleted = 1
                        WHERE id = :id";

                $statement = $connection -> prepare($sql);
                $statement -> bindValue(':id', $id);
                $statement -> execute();

?>

<script type="text/javascript">
    window.location.replace("http://localhost:3000/public/contacts.php");
</script>

<?php       
            }

        } catch (PDOException $error) {
            echo $error -> getMessage();
        }
?>