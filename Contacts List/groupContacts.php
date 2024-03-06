<?php
    include "./templates/header.php";
    require "./common/config.php";
    require "./common/common.php";
?>

    <h1>Here are all contacts in this group</h1>

    <?php
        try {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                $connection = new PDO($dsn, $username, $password, $options);

                $sql = "SELECT * FROM contacts WHERE groupId = :id AND isDeleted = 0";

                $statement = $connection -> prepare($sql);
                $statement -> bindValue(':id', $id);
                $statement -> execute();

                $result = $statement -> fetchAll();
            }

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
                        <th>Phone</th>
                        <th>Nickname</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $row) { ?>
                        <tr>
                            <td><?php echo escape($row["Id"]); ?></td>
                            <td><?php echo escape($row["Name"]); ?></td>
                            <td><?php echo escape($row["Phone"]); ?></td>
                            <td><?php echo escape($row["Nickname"]); ?></td>
                            <td><?php echo escape($row["Email"]); ?></td>
                        </tr>
                        <?php } ?>
                </tbody>
            </table>
        <?php } else {
                echo "<p>There are no contacts in this group!</p>";
            }
        ?>

    <div class="wrapper">
        <a href="./public/groups.php" class="btn-nav" style="margin-right: 2em;">All groups</a>
        <a href="./public/contacts.php" class="btn-nav">All contacts</a>
    </div>

<?php include "./templates/footer.php"; ?>