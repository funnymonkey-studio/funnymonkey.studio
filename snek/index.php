<html>
    <head>
        <link rel="stylesheet" href="../css/snek.css">
        <title>MONKE</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php
            require "../external/header.php"
        ?>
        <meta property="og:site_name" content="Funny Monkey Studio">
        <meta property="og:url" content="https://funnymonkey.studio">
        <meta property="og:title" content="Funny Monkey Studio">
        <meta property="og:description" content="snek for he nintendo 64">
        <meta property="og:type" content="website">
        <meta name="og:image" itemprop="image" content="http://www.funnymonkey.studio/images/head.png">
        <meta name="theme-color" content="#000000">
    </head>
    <body>
     <?php
            require "../external/navbar.php"
        ?>
        <div class="main-center">
            <h1>S N E K .</h1>
            <h3 id="points">Points: 0</h3>
            <div class="grid-container center" id ="grid">    
                
            </div>
        </div>
    </body>
    <script>
        (function() {
            let head = 3
            let prevHead = 0
            let tail = 1
            let body = [2]
            let apple = Math.floor(Math.random() * 101)
            let points = 0;
            let larger = false

            function checkAppleCollision() {
                for (i = 0; i < body.length; i++) {
                    if (apple == body[i]) {
                        return true
                    }
                }
                if (apple == head || apple == tail) {
                    return true
                } else {
                    return false
                }
            }

            function generateApple() {
                apple = Math.floor(Math.random() * 101)
                if (checkAppleCollision() == true) {
                    generateApple()
                } else {
                    let appleElement = document.getElementById(apple.toString())
                    appleElement.firstElementChild.src = "../images/apple.png"
                    appleElement.firstElementChild.alt = "apple"
                }
            }

            var edges = []

            for (i = 1; i < 101; i++) {
                edges[i] = 10 * i
            }

            function generateSnake() {
                for (i = 0; i < body.length; i++) {
                    let bodyElement = document.getElementById(body[i].toString())
                    bodyElement.firstElementChild.src = "../images/body.png"
                    bodyElement.firstElementChild.alt = "body"
                }
                let headElement = document.getElementById(head.toString())
                headElement.firstElementChild.src = "../images/head_3.png"
                headElement.firstElementChild.alt = "head"

                let tailElement = document.getElementById(tail.toString())
                tailElement.firstElementChild.src = "../images/tail.png"
                tailElement.firstElementChild.alt = "tail"

                let appleElement = document.getElementById(apple.toString())
                appleElement.firstElementChild.src = "../images/apple.png"
                appleElement.firstElementChild.alt = "apple"

                document.getElementById("points").innerHTML = "Points: " + points
            }

            function checkCollision() {
                for (i = 0; i < body.length; i++) {
                    if (head == body[i]) {
                        return true
                    }
                }
                if (head < 1 || head > 100 || head == tail) {
                    return true
                } else {
                    return false
                }
            }
            
            function resetSnake() {
                console.log("PAIN")

                for (i = 1; i < 101; i++) {
                    let e = document.getElementById(i)
                    e.firstElementChild.src = "../images/pixel.png"
                }

                head = 3
                prevHead = 0
                tail = 1
                body = [2]
                apple = Math.floor(Math.random() * 101)
                points = 0

                generateSnake()
            }

            for (i = 1; i < 101; i++) {
                let node = document.createElement("div");
                node.id = i
                document.getElementById("grid").appendChild(node);
                let img = document.createElement("img");
                img.className = "snek_img"
                img.src = "../images/pixel.png"
                node.appendChild(img);
                img.alt = ''
            }
            
            function updateSnake() {
                document.getElementById("points").innerHTML = "Points: " + points
                if (checkCollision() == false) {
                    let prevHeadElement = document.getElementById(prevHead.toString())
                    prevHeadElement.firstElementChild.src = "../images/pixel.png"
                    prevHeadElement.firstElementChild.alt = ""

                    for (i = 0; i < body.length; i++) {
                        let bodyElement = document.getElementById(body[i].toString())
                        bodyElement.firstElementChild.src = "../images/body.png"
                        bodyElement.firstElementChild.alt = "body"
                    }
                    let headElement = document.getElementById(head.toString())
                    headElement.firstElementChild.src = "../images/head_3.png"
                    headElement.firstElementChild.alt = "head"

                    let tailElement = document.getElementById(tail.toString())
                    tailElement.firstElementChild.src = "../images/tail.png"
                    tailElement.firstElementChild.alt = "tail"
                } else {
                    resetSnake()
                }
            }

            generateSnake()
            
            document.onkeydown = function (event) {
                switch (event.keyCode) {
                    case 37:
                        head -= 1
                        if (head == apple) {
                            points += 1
                            generateApple()
                            prevHead = tail
                            tail = body[body.length - 1]
                            for (i = body.length; i > 0; i--) {
                                body[i] = body[i - 1]
                            }
                            body[0] = head + 1
                        } else {
                            prevHead = tail
                            tail = body[body.length -1]
                            for (i = body.length - 1; i > 0; i--) {
                                body[i] = body[i-1]
                            }
                            body[0] = head + 1
                        }
                        updateSnake()
                        break;
                    case 38:
                        head -= 10
                        if (head == apple) {
                            points += 1
                            generateApple()
                            prevHead = tail
                            tail = body[body.length - 1]
                            for (i = body.length; i > 0; i--) {
                                body[i] = body[i - 1]
                            }
                            body[0] = head + 10
                        } else {
                            prevHead = tail
                            tail = body[body.length -1]
                            for (i = body.length - 1; i > 0; i--) {
                                body[i] = body[i-1]
                            }
                            body[0] = head + 10
                        }
                        updateSnake()
                        break;
                case 39:
                        head += 1
                        if (head == apple) {
                            points += 1
                            generateApple()
                            prevHead = tail
                            tail = body[body.length - 1]
                            for (i = body.length; i > 0; i--) {
                                body[i] = body[i - 1]
                            }
                            body[0] = head - 1
                        } else {
                            prevHead = tail
                            tail = body[body.length -1]
                            for (i = body.length - 1; i > 0; i--) {
                                body[i] = body[i-1]
                            }
                            body[0] = head - 1
                        }
                        updateSnake()
                        break;
                case 40:
                        head += 10
                        if (head == apple) {
                            points += 1
                            generateApple()
                            prevHead = tail
                            tail = body[body.length - 1]
                            for (i = body.length; i > 0; i--) {
                                body[i] = body[i - 1]
                            }
                            body[0] = head - 10
                        } else {
                            prevHead = tail
                            tail = body[body.length -1]
                            for (i = body.length - 1; i > 0; i--) {
                                body[i] = body[i-1]
                            }
                            body[0] = head - 10
                        }
                        updateSnake()
                        break;
            }
        };
        })();
     </script>
</html>