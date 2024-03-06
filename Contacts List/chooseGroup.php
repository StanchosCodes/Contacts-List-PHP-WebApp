<?php
    include "./templates/header.php";
    require "./common/config.php";
    require "./common/common.php";
    if (isset($_GET['id'])) {
        $contactId = $_GET['id'];
    }
?>

    <h1>Choose a group</h1>

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
                        <th>Add</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $row) { ?>
                        <tr>
                            <td><?php echo escape($row["Id"]); ?></td>
                            <td><?php echo escape($row["Name"]); ?></td>
                            <td><a href="addToGroup.php?groupId=<?php echo escape($row["Id"]);?>&contactId=<?php echo $contactId ?>" class="btn-success">Add To Group</a></td>
                        </tr>
                        <?php } ?>
                </tbody>
            </table>
        <?php } else {
            echo "<p>There are no groups yet!</p>";
        }
        ?>

    <div class="wrapper">
        <a href="./public/contacts.php" class="btn-nav">Back to all contacts</a>
    </div>

<?php include "./templates/footer.php"; ?>