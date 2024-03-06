<?php require "./common/common.php" ?>
<?php require "./common/config.php" ?>

<?php
        try {
            if (isset($_GET['groupId']) && isset($_GET['contactId'])) {
                $connection = new PDO($dsn, $username, $password, $options);

                $groupId = $_GET['groupId'];
                $contactId = $_GET['contactId'];

                $sql = "UPDATE contacts
                        SET groupId = :groupId
                        WHERE id = :contactId";

                $statement = $connection -> prepare($sql);
                $statement -> bindValue(':groupId', $groupId);
                $statement -> bindValue(':contactId', $contactId);
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