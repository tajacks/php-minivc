<?php
    require_once(APP_ROOT . "/includes/sampleHeader.php"); ?>

    <main>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Address</th>
                        <th>City</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($data['people'] as $row) {
                        echo("<tr>");
                        echo("<td>" . $row['PersonID'] . "</td>");
                        echo("<td>" . $row['LastName'] . "</td>");
                        echo("<td>" . $row['FirstName'] . "</td>");
                        echo("<td>" . $row['Address'] . "</td>");
                        echo("<td>" . $row['City'] . "</td>");
                        echo("</tr>");
                    }
                ?>
                </tbody>
            </table>
        <br>
        <?php
            echo $data['note'];
        ?>
    </main>

<?php
    require_once(APP_ROOT . "/includes/sampleFooter.php"); ?>