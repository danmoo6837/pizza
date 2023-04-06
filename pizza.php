<!DOCTYPE html>
<html>
<head>
    <title>내가 좋아하는 피자 평가하기</title>
</head>
<body>
    <h1>내가 좋아하는 피자 평가하기</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="name1">피자 1:</label>
        <input type="text" name="name1" id="name1">
        <label for="rating1">평가:</label>
        <input type="number" name="rating1" id="rating1" min="1" max="5"><br>
        
        <label for="name2">피자 2:</label>
        <input type="text" name="name2" id="name2">
        <label for="rating2">평가:</label>
        <input type="number" name="rating2" id="rating2" min="1" max="5"><br>
        
        <label for="name3">피자 3:</label>
        <input type="text" name="name3" id="name3">
        <label for="rating3">평가:</label>
        <input type="number" name="rating3" id="rating3" min="1" max="5"><br>
        
        <label for="name4">피자 4:</label>
        <input type="text" name="name4" id="name4">
        <label for="rating4">평가:</label>
        <input type="number" name="rating4" id="rating4" min="1" max="5"><br>
        
        <label for="name5">피자 5:</label>
        <input type="text" name="name5" id="name5">
        <label for="rating5">평가:</label>
        <input type="number" name="rating5" id="rating5" min="1" max="5"><br>

        <input type="submit" value="평가 제출">
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "pizza";
                
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error){
                    die("Connection failed: ". $conn->connect_error);
                }

                $query_delete = "DELETE FROM favorite_pizza";
                if ($conn->query($query_delete) === TRUE) {
                    // 삭제된 행의 수 출력
                    echo "모든 정보가 삭제되었습니다.";
                } else {
                    echo "삭제 오류: " . $conn->error;
                }

                // POST로 받은 평가할 피자 정보
                $name1 = $_POST['name1'];
                $rating1 = $_POST['rating1'];
                $name2 = $_POST['name2'];
                $rating2 = $_POST['rating2'];
                $name3 = $_POST['name3'];
                $rating3 = $_POST['rating3'];
                $name4 = $_POST['name4'];
                $rating4 = $_POST['rating4'];
                $name5 = $_POST['name5'];
                $rating5 = $_POST['rating5'];

                // MySQL에 평가한 피자 정보 삽입
                $query1 = "INSERT INTO favorite_pizza (pizza_name, rating) VALUES ('$name1', $rating1)";
                $query2 = "INSERT INTO favorite_pizza (pizza_name, rating) VALUES ('$name2', $rating2)";
                $query3 = "INSERT INTO favorite_pizza (pizza_name, rating) VALUES ('$name3', $rating3)";
                $query4 = "INSERT INTO favorite_pizza (pizza_name, rating) VALUES ('$name4', $rating4)";
                $query5 = "INSERT INTO favorite_pizza (pizza_name, rating) VALUES ('$name5', $rating5)";
                
                if($conn->query($query1) === TRUE && $conn->query($query2) === TRUE && $conn->query($query3) === TRUE && $conn->query($query4) === TRUE && $conn->query($query5) === TRUE) {
                    echo "정보가 업로드되었습니다.";
                } else {
                    echo "Error:" . $query . "<br>" . $conn->error;
                }

                // MySQL 연결 종료
                mysqli_close($conn);
                header("Location: pie.php");
            }
        ?>
    </form>
</body>
</html>