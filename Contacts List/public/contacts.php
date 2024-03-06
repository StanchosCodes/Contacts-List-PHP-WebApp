<?php
    include "../templates/header.php";
    require "../common/config.php";
    require "../common/common.php";
?>

    <h1>Here are all contacts</h1>

    <h3>You can filter them by group</h3>

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
            <div class="dropdown">
              <button class="dropbtn">Groups Filter</button>
              <div class="dropdown-content">
                <?php foreach ($result as $row) { ?>
                    <a href="../groupContacts.php?id=<?php echo escape($row["Id"]);?>"><?php echo escape($row['Name']); ?></a>
                <?php } ?>
              </div>
            </div>
    <?php } ?>

    <?php
        try {
            $connection = new PDO($dsn, $username, $password, $options);

            $sql = "SELECT * FROM contacts WHERE IsDeleted = 0";

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
                        <th>Phone</th>
                        <th>Nickname</th>
                        <th>Email</th>
                        <th>Edit</th>
                        <th>Add to group</th>
                        <th>Delete</th>
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
                            <td><a href="../updateContact.php?id=<?php echo escape($row["Id"]);?>" class="btn-warning">Update</a></td>
                            <td><a href="../chooseGroup.php?id=<?php echo escape($row["Id"]);?>" class="btn-success">Add To Group</a></td>
                            <td><a href="../deleteContact.php?id=<?php echo escape($row["Id"]);?>" onclick="return confirm('Are you sure you want to delete this contact?')" class="btn-danger">Delete</a></td>
                        </tr>
                        <?php } ?>
                </tbody>
            </table>
        <?php } else {
            echo "<p>There are no contacts yet!</p>";
        }
        ?>

    <div class="wrapper">
        <a href="../addContact.php" class="btn-nav" style="margin-right: 2em;"><strong>Add Contact</strong></a>
        <a href="index.php" class="btn-nav">Back to home</a>
    </div>

<?php include "../templates/footer.php"; ?>