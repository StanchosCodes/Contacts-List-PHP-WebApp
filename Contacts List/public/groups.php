<?php
    include "../templates/header.php";
    require "../common/config.php";
    require "../common/common.php";
?>

    <h1>Here are all groups</h1>

    <?php
        try {
            $connection = new PDO($dsn, $username, $password, $options);

            $sql = "SELECT * FROM groups";

            $statement = $connection -> prepare($sql);
            $statement -> execute();

            $result = $statement -> fetchAll();

        } catch (PDOException $error) {
            echo $error -> getMessage();
        }
    ?>

    <?php
        if ($result && $statement -> rowCount() > 0) { ?>
            <table>
                <thead>
                    <tr>
                        <th>-></th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $row) { ?>
                        <tr>
                            <td><?php echo escape($row["Id"]); ?></td>
                            <td><?php echo escape($row["Name"]); ?></td>
                            <td><a href="../groupContacts.php?id=<?php echo escape($row["Id"]);?>" class="btn-success">All Contacts</a></td>
                        </tr>
                        <?php } ?>
                </tbody>
            </table>
        <?php } else {
                echo "<p>There are no groups yet!</p>";
            }
        ?>
    <div class="wrapper">
        <a href="index.php" class="btn-nav">Back to home</a>
    </div>

<?php include "../templates/footer.php"; ?>